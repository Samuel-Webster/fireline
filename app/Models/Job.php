<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    const TYPES = [
        'Hazard Reduction Burn',
        'Escaped Hazard Reduction Burn',
        'Bushfire',
        'Grass Fire',
        'Scrub Fire',
        'Structural Fire',
        'Road Crash Rescue',
        'Hazardous Material',
        'QAS Assist',
        'Assist Other Agencies',
        'Other Incidents',
        'Training',
        'Brigade Business',
    ];

    public function applianceLogs()
    {
        return $this->belongsToMany(ApplianceLog::class);
    }
}
