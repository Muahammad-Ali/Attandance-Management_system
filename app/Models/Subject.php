<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_name',
        'subject_code',
        'description',
        'credits',
        'semester_id'
    ];

    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    public function teachers()
    {
        return $this->belongsToMany(Teacher::class, 'subject_teacher');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function feedbacks()
    {
        return $this->hasMany(SubjectFeedback::class);
    }
} 