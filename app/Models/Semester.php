<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Semester extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'department_id',
        'semester_number',
        'name',
        'start_date',
        'end_date',
        'is_active'
    ];
    
    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];
    
    /**
     * Get the department this semester belongs to
     */
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    
    /**
     * Get the timetable entries for this semester
     */
    public function timetables(): HasMany
    {
        return $this->hasMany(Timetable::class);
    }

    /**
     * Get the CRs assigned to this semester
     */
    public function crs(): BelongsToMany
    {
        return $this->belongsToMany(Cr::class, 'semester_crs')
            ->withTimestamps();
    }
}
