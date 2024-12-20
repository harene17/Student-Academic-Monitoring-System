<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Semester extends Model
{
    use HasFactory;
    protected $primaryKey = 'sem_id';
    protected $fillable = ['program', 'semester', 'total_credit_hr', 'target_gpa', 'achieve_gpa', 'student_id'];

    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class); // one semester belongs to one user
    }

    public function subjects(): HasMany
    {
        return $this->hasMany(Subjects::class); // one semester belongs to many subjects
    }
}
