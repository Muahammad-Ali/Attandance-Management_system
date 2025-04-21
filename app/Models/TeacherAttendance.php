<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeacherAttendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'subject_id',
        'semester_id',
        'date',
        'day',
        'start_time',
        'end_time',
        'status',
        'remarks',
        'recorded_by'
    ];

    protected $casts = [
        'date' => 'date',
        'start_time' => 'datetime:H:i',
        'end_time' => 'datetime:H:i',
    ];

    /**
     * Get the teacher for this attendance record
     */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    /**
     * Get the subject for this attendance record
     */
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    /**
     * Get the semester for this attendance record
     */
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    /**
     * Get the CR who recorded this attendance
     */
    public function recordedBy()
    {
        return $this->belongsTo(Cr::class, 'recorded_by');
    }
} 