<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignedSubject extends Model
{
    // 🔐 Allow these fields to be mass assigned
    protected $fillable = [
        'subject_name',
        'teacher_id',
        'cr_id',
        'section',
        'semester',
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function cr()
    {
        return $this->belongsTo(Cr::class);
    }
}
