<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'code',
        'description'
    ];
    
    /**
     * Get the semesters associated with this department
     */
    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }
}
