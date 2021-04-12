<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appliance extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'year' => 'date:Y-m-d',
    ];

    const TYPES = [
        'light',
        'medium',
        'heavy',
        'support',
        'control'
    ];

    const MAKES = [
        'Isuzu',
        'Hino',
        'Ford',
        'Nissan',
        'Toyota',
        'Iveco',
        'Man',
        'Scania',
    ];

    public function logs()
    {
        return $this->hasMany(ApplianceLog::class);
    }

    public function checklist()
    {
        return $this->hasMany(ApplianceChecklist::class);
    }

    public function checklistLogs()
    {
        return $this->hasMany(ApplianceChecklistLog::class);
    }

    public function getCurrentOdometerAttribute()
    {
        return number_format($this->logs()->orderBy('odometer_in', 'DESC')->first()->odometer_in ?? 0);
    }

    public function getlastLogTimeInAttribute()
    {
        return $this->logs()->orderBy('time_in', 'DESC')->first()->time_in ?? null;
    }

    public function getlastCheckedAttribute()
    {
        return $this->checklistLogs()->orderBy('created_at', 'DESC')->first()->created_at ?? null;
    }
}
