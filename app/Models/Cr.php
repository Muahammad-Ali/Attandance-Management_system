<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cr extends Model
{
    use HasFactory;

    protected $fillable = [
        'cr_name', 'cr_email', 'reg_no', 'section', 'semester','password'
    ];
    protected $hidden = ['password'];
}
