<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'registration_no',
        'registration_code',
        'logo',
        'signature',
        // Add any other fields you want to be mass assignable
    ];
}
