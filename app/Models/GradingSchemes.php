<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GradingSchemes extends Model
{
    use HasFactory;
    protected $primaryKey = 'grade_id';
    protected $fillable = ['program', 'startMark', 'endMark', 'grade', 'gpa', 'student_id'];

    public function users():BelongsTo
    {
        return $this->belongsTo(User::class); // one grading scheme belongs to one user
    }
}
