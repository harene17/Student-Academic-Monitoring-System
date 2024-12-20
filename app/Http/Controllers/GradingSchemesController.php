<?php

namespace App\Http\Controllers;

use App\Models\GradingSchemes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class GradingSchemesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($studentId = Auth::id()){
            return view('grading.index');
        }
        else{
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if($studentId = Auth::id()) { /*logged in user id is same with student id in grading scheme tabl*/
            return view('grading.create');
        }
        else{
            abort(403);
        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $studentId = Auth::id();
        $validated = $request->validate([
            'program' =>'required|string|max:255',
            'startMark' =>'required|numeric',
            'endMark'=>'required|numeric',
            'grade' => 'required|string|max:2',
            'gpa' => 'required|numeric',
        ]);

        // Ensure end mark is larger than start mark
        if ($request->endMark <= $request->startMark) {
            return redirect()->back()
                ->withErrors(['endMark' => 'End mark must be larger than start mark.'])
                ->withInput();
        }

        $gradingSchemes = new GradingSchemes;
        $gradingSchemes->student_id = $studentId;
        $gradingSchemes->program = $request ->program;
        $gradingSchemes->startMark = $request->startMark;
        $gradingSchemes->endMark = $request->endMark;
        $gradingSchemes->grade = $request->grade;
        $gradingSchemes->gpa = $request->gpa;
        $gradingSchemes->save();

        return redirect()->route('grading.index')
            ->withSuccess('New grading record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($studentId, Request $request)
    {
        if($studentId = Auth::id()){
            $studentId = Auth::id();//student id is same as logged in user id
            $program = $request->input('program'); // Get the selected program from the request

            // Query to fetch grading schemes based on the logged-in user ID and selected program
            $gradingSchemes = GradingSchemes::where('student_id', $studentId)
                ->where('program', $program)
                ->get();

            return view('grading.show', compact('gradingSchemes','program'));
        }
        else{
            abort(403);
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(GradingSchemes $gradingSchemes)
    {
        return view('grading.edit', compact('gradingSchemes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, GradingSchemes $gradingSchemes)
    {
        $studentId = Auth::id();
        $validated = $request->validate([
            'program' =>'required|string|max:255',
            'startMark' =>'required|numeric',
            'endMark'=>'required|numeric',
            'grade' => 'required|string|max:2',
            'gpa' => 'required|numeric',
        ]);

        if ($request->endMark <= $request->startMark) {
            return redirect()->back()
                ->withErrors(['endMark' => 'End mark must be larger than start mark.'])
                ->withInput();
        }

        $gradingSchemes->student_id = $studentId;
        $gradingSchemes->update([
            'program'=> $request->program,
            'startMark' => $request->startMark,
            'endMark' => $request->endMark,
            'grade' => $request->grade,
            'gpa' => $request->gpa,
        ]);

        return redirect()->route('grading.index')
            ->withSuccess('Grading record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(GradingSchemes $gradingSchemes)
    {
        $gradingSchemes->delete();
        return redirect()->route('grading.index')
            ->withSuccess('Grading record deleted successfully.');
    }
}
