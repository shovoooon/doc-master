<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Traveller extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'passport_no',
        'passport_issued',
        'passport_expiry',
        'spouse_name',
        'spouse_passport_no',
    ];

    public function children()
    {
        return $this->hasMany(Child::class);
    }

}
