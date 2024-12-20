<?php

namespace App;

use App\Models\Assessments;
use App\Models\SubAssessments;

class Calculation
{
    public static function calculateObtainedPercentage($assessment_id, $subject_id)
    {
        // get all sub-assessments related to the specific assessment and subject
        $subAssessments = SubAssessments::where('assessment_id', $assessment_id)
            ->where('subject_id', $subject_id)
            ->get();

        // calculate total mark and obtained mark from sub-assessments
        $total_mark = $subAssessments->sum('total_mark');
        $obtained_mark = $subAssessments->sum('obtained_mark');

        // find the assessment
        $assessment = Assessments::find($assessment_id);

        // check if the assessment exists
        if (!$assessment) {
            return null;
        }

        // get the total percentage from the assessment
        $total_percentage = $assessment->total_percentage;

        // calculate obtained percentage
        $obtained_percentage = ($total_mark > 0) ? round(($obtained_mark / $total_mark) * $total_percentage, 2) : 0;

        return $obtained_percentage;
    }
}
