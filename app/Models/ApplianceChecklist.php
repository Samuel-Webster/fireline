<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplianceChecklist extends Model
{
    use HasFactory;

    protected $guarded = [];

    const LOCATIONS = [
        'front cabin',
        'appliance rear',
        'near side - front locker',
        'near side - centre locker',
        'near side - rear locker',
        'offside - front locker',
        'offside - centre locker',
        'offside - rear locker',
    ];
}
