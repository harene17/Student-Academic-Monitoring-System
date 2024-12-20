<?php

namespace App\Http\Controllers;

use App\Models\GradingSchemes;
use App\Models\Semester;
use App\Models\Subjects;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Calculation;

class ProgressController extends Controller
{
    public function index(Request $request)
    {
        $studentId = Auth::id();
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

        // Get the target GPA for the selected semester
        $targetGPA = null;
        if ($selectedSemesterId && $selectedProgram) {
            $selectedSemester = Semester::find($selectedSemesterId); // Get the semester with the selected semester ID
            if ($selectedSemester && $selectedProgram) {
                $targetGPA = $selectedSemester->target_gpa; // Get the target GPA for the selected semester if the semester exists
            }
        }

        // Get grading schemes based on the logged-in user and the program selected by the user
        $gradingSchemes = GradingSchemes::where('student_id', $studentId)
            ->where('program', $selectedProgram)
            ->get();

        // Calculate current GPA for the selected semester using the grading schemes
        $currentGPA = $this->calculateCurrentGPA($selectedSemesterId, $studentId, $gradingSchemes);

        return view('progress.index', compact('subjects', 'semesters', 'targetGPA', 'currentGPA'));
    }

    public function show(Subjects $subjects)
    {
        $assessments = $subjects->assessments; // get assessments belongs to the subject

        $totalObtainedPercentage = 0; // set total obtained percentage as 0

        // iterate through each assessment and calculate obtained percentage
        foreach ($assessments as $assessment) {
            $totalObtainedPercentage += Calculation::calculateObtainedPercentage($assessment->assessment_id, $subjects->sub_id); // get obtained percentage of each assessment and sum it
        }

        // Get grading schemes based on the logged-in user and the program of the subject
        $gradingSchemes = GradingSchemes::where('student_id', Auth::id())
            ->where('program', $subjects->program)
            ->get();

        // check whether the grading scheme exists
        if ($gradingSchemes->isEmpty()) {
            // display error message if no grading scheme is found
            return redirect()->route('progress.index')->withError('No grading scheme found for the selected program. Please add grading scheme.');
        }

        // get the target grade from subjects table
        $targetGrade = $subjects->target_grade;

        // calculate grade and GPA based on the total obtained percentage and the specific grading scheme
        $grade = $this->calculateGrade($totalObtainedPercentage, $gradingSchemes);
        $gpa = $this->calculateGPA($totalObtainedPercentage, $gradingSchemes);

        // calculate remaining marks needed to achieve target grade
        $remainingMarksNeeded = $this->calculateRemainingMarksNeeded($targetGrade, $gradingSchemes, $totalObtainedPercentage);

        // Calculate the difference and get study tips
        $difference = $remainingMarksNeeded;
        $studyTips = $this->getStudyTips($difference);

        return view('progress.show', compact('subjects', 'totalObtainedPercentage', 'grade', 'remainingMarksNeeded', 'gpa', 'studyTips'));
    }

    private function calculateGrade($percentage, $gradingScheme)
    {
        $closestGrade = null; // set the variable to store the closest grade
        $closestDifference = PHP_INT_MAX; // set the variable to store the closest difference between the percentage and grade marks //php_int_max

        foreach ($gradingScheme as $grade) {
            // check whether the percentage is within the mark range,
            // if yes then display the corresponding grade
            if ($percentage >= $grade->startMark && $percentage <= $grade->endMark) {
                return $grade->grade;
            }

            //for percentage in decimal
            // Check difference with the startMark and endMark, find the closest.
            $diffWithStart = abs($grade->startMark - $percentage);
            $diffWithEnd = abs($grade->endMark - $percentage);
            $minDiff = min($diffWithStart, $diffWithEnd); //Find minimum difference

            // update the closest grade and difference if the current grade is closer to the percentage
            if ($minDiff < $closestDifference) {
                $closestDifference = $minDiff;
                $closestGrade = $grade->grade;
            }
        }

        return $closestGrade; // Return the grade that is closest to the percentage
    }

    private function calculateGPA($percentage, $gradingScheme)
    {
        $closestGPA = null;
        $closestDifference = PHP_INT_MAX;

        foreach ($gradingScheme as $grade) {
            if ($percentage >= $grade->startMark && $percentage <= $grade->endMark) {
                return $grade->gpa;
            }

            // check difference with the startMark and endMark, find the closest.
            $diffWithStart = abs($grade->startMark - $percentage);
            $diffWithEnd = abs($grade->endMark - $percentage);
            $minDiff = min($diffWithStart, $diffWithEnd);

            if ($minDiff < $closestDifference) {
                $closestDifference = $minDiff;
                $closestGPA = $grade->gpa;
            }
        }

        return $closestGPA; // Return the GPA that is closest to the percentage
    }

    private function calculateRemainingMarksNeeded($targetGrade, $gradingScheme, $totalObtainedPercentage)
    {
        // find the grading scheme that corresponding to the target grade
        $targetGradeScheme = $gradingScheme->where('grade', $targetGrade)->first();

        if ($targetGradeScheme) {
            // Subtract the total obtained percentage from the start mark of the target grade
            $remainingMarksNeeded = $targetGradeScheme->startMark - $totalObtainedPercentage;

            // Check if remaining marks needed is negative or equal to 0
            if ($remainingMarksNeeded <= 0) {
                // If negative, return a congratulatory message
                return 'Congrats, You have achieved the target';
            }

            return $remainingMarksNeeded;
        }

        return null; // if no grading scheme entry is found for the target grade
    }

    private function calculateCurrentGPA($semesterId, $studentId, $gradingSchemes)
    {
        $semesterSubjects = Subjects::where('student_id', $studentId) // get subjects that belong to the logged-in user and specific semester
        ->where('semester_id', $semesterId)
            ->get();

        if ($semesterSubjects->isEmpty()) {
            return null; // When no subjects are found
        }

        $totalPoints = 0;
        $totalCreditHours = 0;

        foreach ($semesterSubjects as $subject) {
            $totalObtainedPercentage = 0;

            // Calculate total obtained percentage for each subject
            foreach ($subject->assessments as $assessment) {
                $totalObtainedPercentage += Calculation::calculateObtainedPercentage($assessment->assessment_id, $subject->sub_id);
            }

            // Calculate GPA for the subject
            $gpa = $this->calculateGPA($totalObtainedPercentage, $gradingSchemes);

            // Calculate total points to calculate semester GPA
            if ($gpa !== null) {
                $totalPoints += $gpa * $subject->total_credit_hr;
                $totalCreditHours += $subject->total_credit_hr;
            }
        }

        if ($totalCreditHours > 0) {
            return round($totalPoints / $totalCreditHours, 2); // calculate and return the current GPA
        }

        return 0; // return 0 if no credit hours are found to avoid division by zero
    }
    private function getStudyTips($difference)
    {
        // Ensure $difference is treated as a number
        $difference = (float)$difference;

        if ($difference >= 40) {
            return " -You need to improve significantly.<br> -Consider creating a detailed study plan <br> -Seek help from online tutorials, lecturers, and participate in study groups.";
        } elseif ($difference < 40 && $difference >= 30) {
            return " -Focus on key areas where you lost marks.<br> -Review your lecture notes and textbooks regularly. <br> -Improve your study plan";
        } elseif ($difference < 30 && $difference >= 20) {
            return " -You're getting there! Spend extra time on practice questions and revise the chapters. <br> -Practice taking notes for each chapters";
        } elseif ($difference < 20 && $difference > 0) { // Changed from $difference >= 1 to $difference > 0
            return " -Almost there! Fine-tune your knowledge and ensure you understand all core concepts. <br> -Implement active recalling method";
        } elseif ($difference <= 0) { // This now correctly handles zero and negative values
            return " -You've achieved your target <br> -Keep It Up !!!!";
        }
        return "";
    }
}
