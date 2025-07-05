<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'traveller_id',
        'name',
        'gender',
        'passport_no',
        'relationship',
        'passport_issued',
        'passport_expiry',
    ];

    public function traveller()
    {
        return $this->belongsTo(Traveller::class);
    }
}
