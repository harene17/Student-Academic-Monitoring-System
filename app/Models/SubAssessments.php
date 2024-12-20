<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubAssessments extends Model
{
    use HasFactory;
    protected $primaryKey = 'SubAssessment_id';
    protected $fillable = ['subject_id'	,'assessment_id', 'subAssessmentName', 'total_mark', 'obtained_mark'];

    public function assessments():BelongsTo
    {
        return $this->belongsTo(Assessments::class, 'assessment_id'); // one sub assessment belongs to one assessment
    }

    public function subjects():BelongsTo
    {
        return $this->belongsTo(Subjects::class, 'subject_id'); // one sub assessment belongs to one subject
    }

}
