<?php

namespace App\Http\Controllers;

use App\Models\Assessments;
use App\Models\SubAssessments;
use App\Models\Subjects;
use Illuminate\Http\Request;
use App\Calculation;


class AssessmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($subject_id)
    {
        $subject = Subjects::findOrFail($subject_id); // get the subject to add assessment for the specified subject, display 404 error if not found
        return view('assessment.create', compact('subject'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'assessmentName' =>'required|string|max:255',
            'subject_id' => 'required|exists:subjects,sub_id',
            'total_percentage' => 'required|numeric',
        ]);

        $assessments = new Assessments;
        $assessments->assessmentName = $request->assessmentName;
        $assessments->subject_id = $request->subject_id;
        $assessments->total_percentage = $request->total_percentage;
        $assessments->save();

        return redirect()->route('subject.index')
            ->withSuccess('New assessment record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assessments $assessments, $subject_id)
    {
        $subject = Subjects::findOrFail($subject_id);
        $assessments = Assessments::where('subject_id', $subject_id)->get(); //assessments that belongs to the specific subject
        return view('subject.show', compact('subject', 'assessments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($assessment_id)
    {
        $assessments = Assessments::findOrFail($assessment_id); // find the specified assessment id to edit the assessment info
        $subjects = $assessments->subjects; // each assessment belongs to a subject
        return view('assessment.edit', compact('assessments', 'subjects'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $assessment_id)
    {
        $validated = $request->validate([
            'assessmentName' =>'required|string|max:255',
            'total_percentage' => 'required|numeric',
        ]);

        $assessments = Assessments::findOrFail($assessment_id); // get the assessment using the assessment id
        $assessments->update([
            'assessmentName' => $request->assessmentName,
            'total_percentage'  => $request->total_percentage,
        ]);

        return redirect()->route('subject.index')
            ->withSuccess('Assessment record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assessments $assessments)
    {
        $assessments->delete();
        return redirect()->route('subject.index')
            ->withSuccess('Assessment record deleted successfully.');
    }

}
