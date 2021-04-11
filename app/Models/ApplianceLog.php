<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplianceLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    public $dates = [
        'time_in',
        'time_out',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('is_crew_leader', 'is_driver');
    }

    public function appliance()
    {
        return $this->belongsTo(Appliance::class);
    }
}
