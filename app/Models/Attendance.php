<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = [
        'cr_id',
        'subject_id',
        'date',
        'status',
        'remarks'
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function cr()
    {
        return $this->belongsTo(Cr::class, 'cr_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
} 