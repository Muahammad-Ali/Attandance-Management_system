<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\AssignedSubject;

class Teacher extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function assignedSubjects(): HasMany
    {
        return $this->hasMany(AssignedSubject::class);
    }
    
    /**
     * Get the subjects assigned to this teacher
     */
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'subject_teacher')
            ->withTimestamps();
    }
    
    /**
     * Get the attendance records for this teacher
     */
    public function attendances(): HasMany
    {
        return $this->hasMany(TeacherAttendance::class);
    }
}
