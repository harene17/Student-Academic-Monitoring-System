<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($studentId = Auth::id()) {
            $studentId = Auth::id(); // Get the logged-in user's ID
            $selectedSemesterProgram = $request->input('semester_program'); // Get the selected semester and program from the request

            // Retrieve semesters registered under the specific student ID
            $semesters = Semester::where('student_id', $studentId)->get();

            // Initialize variables for selected semester ID and program
            $selectedSemesterId = null;
            $selectedProgram = null;

            // Retrieve the selected semester ID and program from the combined value
            if ($selectedSemesterProgram) {
                [$selectedSemesterId, $selectedProgram] = explode('_', $selectedSemesterProgram);
            }

            // query to get subjects
            $query = Subjects::with('assessments')->where('student_id', $studentId);

            // If specific semester is selected, filter subjects by the selected semester ID
            if ($selectedSemesterId) {
                $query->where('semester_id', $selectedSemesterId);
            }

            // If a specific program is selected, filter subjects by the selected program
            if ($selectedProgram) {
                $query->where('program', $selectedProgram);
            }

            // Execute the query and get the subjects related to the selected semester and program
            $subjects = $query->get();

            return view('dashboard.index', compact('subjects', 'semesters', 'selectedSemesterId', 'selectedProgram'));
        } else {
            abort(403);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
