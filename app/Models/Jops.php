<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jops extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'experience',
        'years_of_experience',
    ];

    protected $casts = [
        'experience' => 'boolean',
    ];


}
