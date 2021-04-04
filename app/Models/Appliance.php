<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
    use HasFactory;

    protected $guarded = [];

    const TYPES = [
        'light',
        'medium',
        'heavy',
        'support',
        'control'
    ];
}
