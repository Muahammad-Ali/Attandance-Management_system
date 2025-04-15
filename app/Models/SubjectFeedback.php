<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectFeedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'cr_id',
        'subject_id',
        'teacher_id',
        'semester_id',
        'feedback',
        'rating',
        'is_anonymous'
    ];

    public function cr()
    {
        return $this->belongsTo(Cr::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }
} 