<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SemesterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($studentId = Auth::id()){
            return view('semester.index');
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
        if($studentId = Auth::id()) {
            return view('semester.create');
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
            //'academic_year' =>'required|string|max:255',
            'semester'=>'required|numeric',
            'total_credit_hr' => 'required|numeric',
            'target_gpa' => 'required|numeric',
        ]);

        $semester = new Semester;
        $semester->student_id = $studentId;
        $semester->program = $request ->program;
       // $semester->academic_year = $request->academic_year;
        $semester->semester = $request->semester;
        $semester->total_credit_hr = $request->total_credit_hr;
        $semester->target_gpa = $request->target_gpa;
        $semester->save();

        return redirect()->route('semester.index')
            ->withSuccess('New semester record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show($studentId,Request $request)
    {
        if($studentId = Auth::id()) {
            $studentId = Auth::id(); //student id is same as logged in user id
            $program = $request->input('program'); // Get the selected program from the request

            // Query to fetch grading schemes based on the logged-in user ID and selected program
            $semester = Semester::where('student_id', $studentId)
                ->where('program', $program)
                ->get();
            return view('semester.show', compact('semester', 'program'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semester $semester)
    {
        return view('semester.edit', compact('semester'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Semester $semester)
    {
        $studentId = Auth::id();
        $validated = $request->validate([
            'program' =>'required|string|max:255',
            //'academic_year' =>'required|string|max:255',
            'semester'=>'required|numeric',
            'total_credit_hr' => 'required|numeric',
            'target_gpa' => 'required|numeric',
        ]);

        $semester->student_id = $studentId;
        $semester->update([
            'program'=> $request->program,
            //'academic_year' => $request->academic_year,
            'semester' => $request->semester,
            'total_credit_hr' => $request->total_credit_hr,
            'target_gpa' => $request->target_gpa,
        ]);

        return redirect()->route('semester.index')
            ->withSuccess('Semester record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semester $semester)
    {
        //
    }
}
