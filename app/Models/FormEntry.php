<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormEntry extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'data', 'template_type'];
    protected $casts = [
        'data' => 'array',
    ];
}
