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
}
