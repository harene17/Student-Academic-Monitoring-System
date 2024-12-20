<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Assessments extends Model
{
    use HasFactory;
    protected $primaryKey = 'assessment_id';
    protected $fillable = ['subject_id'	,'assessmentName', 'total_percentage', 'obtained_percentage'];


    public function subjects():BelongsTo
    {
        return $this->belongsTo(Subjects::class, 'subject_id'); // one assessment belongs to one subject
    }

    public function SubAssessments():HasMany
    {
        return $this->hasMany(SubAssessments::class, 'assessment_id'); // one assessment has many sub assessments
    }
}
