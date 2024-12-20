<?php

namespace App\Http\Controllers;

use App\Models\Assessments;
use App\Models\SubAssessments;
use App\Models\Subjects;
use Illuminate\Http\Request;

class SubAssessmentsController extends Controller
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
        $subject = Subjects::findOrFail($subject_id); // get the subject to add sub assessment for the specified subject, display 404 error if not found
        $assessments = Assessments::where('subject_id', $subject_id)->get(); // get assessment that belongs to the specific subject
        return view('subAssessment.create', compact('subject', 'assessments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subAssessmentName' =>'required|string|max:255',
            'subject_id' => 'required|exists:subjects,sub_id',
            'assessment_id' => 'required|exists:assessments,assessment_id',
            'total_mark' => 'required|numeric',
            'obtained_mark' => 'required|numeric',
        ]);

        $subAssessments = new SubAssessments;
        $subAssessments->subAssessmentName = $request->subAssessmentName;
        $subAssessments->subject_id = $request->subject_id;
        $subAssessments->assessment_id = $request->assessment_id;
        $subAssessments->total_mark = $request->total_mark;
        $subAssessments->obtained_mark = $request->obtained_mark;
        $subAssessments->save();



        return redirect()->route('subject.index')
            ->withSuccess('New sub assessment record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SubAssessments $subAssessments, $subject_id)
    {
        $subject = Subjects::findOrFail($subject_id);
        $subAssessments = SubAssessments::where('subject_id', $subject_id)->get();
        return view('subject.show', compact('subject', 'subAssessments'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($SubAssessment_id)
    {
        $subAssessments = SubAssessments::findOrFail($SubAssessment_id);
        $subjects = $subAssessments->subjects; // each sub assessment belongs to a subject
        $assessments = $subAssessments->assessments; // each sub assessment belongs to assessment
        return view('subAssessment.edit', compact('subAssessments', 'subjects', 'assessments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $SubAssessment_id)
    {
        $validated = $request->validate([
            'subAssessmentName' =>'required|string|max:255',
            'total_mark' => 'required|numeric',
            'obtained_mark' => 'required|numeric',
        ]);

        $subAssessments = SubAssessments::findOrFail($SubAssessment_id); // get the sub assessment using the sub assessment id
        $subAssessments->update([
            'subAssessmentName' => $request->subAssessmentName,
            'total_mark'  => $request->total_mark,
            'obtained_mark'  => $request->obtained_mark,
        ]);

        return redirect()->route('subject.index')
            ->withSuccess('Sub Assessment record updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubAssessments $subAssessment)
    {
        $subAssessment->delete();
        return redirect()->route('subject.index')
            ->withSuccess('Sub Assessment record deleted successfully.');
    }

}
