<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subjects extends Model
{
    use HasFactory;
    protected $primaryKey = 'sub_id';
    protected $fillable = ['program','subject_code','student_id', 'semester', 'sub_name', 'total_credit_hr', 'target_grade',
                           'achieve_grade', 'remaining_percentage',	'total_points', 'subject_gpa'];

    public function semesters():BelongsTo
    {
        return $this->belongsTo(Semester::class, 'semester_id'); // one subject belongs to one semester
    }

    public function assessments(): HasMany
    {
        return $this->hasMany(Assessments::class, 'subject_id'); // one subject has many assessments
    }

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class); //one subject belongs to one user
    }

    public function SubAssessments(): HasMany
    {
        return $this->hasMany(SubAssessments::class, 'subject_id', 'assessment_id');
        //one subject has many sub assessments
    }
}
