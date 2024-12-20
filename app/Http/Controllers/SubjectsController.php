<?php

namespace App\Http\Controllers;

use App\Models\Subjects;
use App\Models\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SubjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($studentId = Auth::id()) {
            $studentId = Auth::id(); // Get the logged-in user's ID
            $selectedSemesterProgram = $request->input('semester_program'); // Get the selected semester and program from the request

            // Retrieve semesters registered under the specific student ID
            $semesters = Semester::where('student_id', $studentId)->get();

            // Initialize variables for selected semester ID and program
            $selectedSemesterId = null;
            $selectedProgram = null;

            // Parse the selected semester ID and program from the combined value
            if ($selectedSemesterProgram) {
                [$selectedSemesterId, $selectedProgram] = explode('_', $selectedSemesterProgram);
            }

            // Start building the query to get subjects
            $query = Subjects::with('semesters')->where('student_id', $studentId);

            // If a specific semester is selected, filter subjects by the selected semester ID
            if ($selectedSemesterId) {
                $query->where('semester_id', $selectedSemesterId);
            }

            // If a specific program is selected, filter subjects by the selected program
            if ($selectedProgram) {
                $query->where('program', $selectedProgram);
            }

            // Execute the query and get the subjects related to the selected semester and program
            $subjects = $query->get();

            return view('subject.index', compact('subjects', 'semesters'));
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
            $studentId = Auth::id(); //student id is same as logged in user id
            $semesters = Semester::where('student_id', $studentId)->get(); // get semesters registered under the specific student id
            return view('subject.create', ['sem' => $semesters]);
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
            'semester_program' =>'required|string|max:255',
            //'subject_code' =>'required|string|max:255',
            //'semester_id' => 'required|exists:semesters,sem_id',
            'sub_name' =>'required|string|max:255',
            'total_credit_hr' => 'required|numeric',
            'target_grade' => 'required|string|max:255',
        ]);

        // Split the combined value into semester ID and program
        [$semester_id, $program] = explode('_', $request->semester_program);

        $subjects = new Subjects;
        $subjects->student_id = $studentId;
        $subjects->program = $program;
        $subjects->semester_id = $semester_id;
        //$subjects->subject_code = $request->subject_code;
        $subjects->sub_name = $request->sub_name;
        $subjects->total_credit_hr = $request->total_credit_hr;
        $subjects->target_grade = $request->target_grade;
        $subjects->save();

        return redirect()->route('subject.index')
            ->withSuccess('New subject record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Subjects $subjects)
    {
        if($studentId = Auth::id()) {
        $assessments = $subjects->assessments; // get assessments that belongs to the selected subject
        //Retrieve all sub-assessments associated with the assessments.
        $subAssessments = $assessments->flatMap(function ($assessment) {
            return $assessment->subAssessments ?? [];
        });
        return view('subject.show', compact('subjects', 'assessments', 'subAssessments'));
        }
        else{
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Subjects $subjects)
    {
        $studentId = Auth::id();
        $semesters = Semester::where('student_id', $studentId)->get();
        return view('subject.edit', compact('subjects', 'semesters'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Subjects $subjects)
    {
        $studentId = Auth::id();
        $validated = $request->validate([
            //'subject_code' =>'required|string|max:255',
            'sub_name' =>'required|string|max:255',
            'total_credit_hr' => 'required|numeric',
            'target_grade' => 'required|string|max:255',
        ]);

        // Use the existing semester_id and program from the subject
        $semester_id = $subjects->semester_id;
        $program = $subjects->program;

        $subjects->student_id = $studentId;
        $subjects->update([
            'program'=> $program,
           // 'subject_code' => $request->subject_code,
            'semester_id' => $semester_id,
            'sub_name'  => $request->sub_name,
            'total_credit_hr' => $request->total_credit_hr,
            'target_grade' => $request->target_grade,
        ]);

        return redirect()->route('subject.index')
            ->withSuccess('Subject record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Subjects $subjects)
    {
        $subjects->delete();
        return redirect()->route('subject.index')
            ->withSuccess('Subject record deleted successfully.');
    }
}
