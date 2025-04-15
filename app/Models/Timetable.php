<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Timetable extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'semester_id',
        'subject_id',
        'teacher_id',
        'cr_id',
        'day',
        'start_time',
        'end_time',
        'classroom',
        'notes'
    ];
    
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    
    /**
     * Get the semester this timetable entry belongs to
     */
    public function semester(): BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }
    
    /**
     * Get the subject for this timetable entry
     */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(AssignedSubject::class, 'subject_id');
    }
    
    /**
     * Get the teacher for this timetable entry
     */
    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }
    
    /**
     * Get the CR for this timetable entry
     */
    public function cr(): BelongsTo
    {
        return $this->belongsTo(Cr::class);
    }
}
