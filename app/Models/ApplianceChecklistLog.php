<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplianceChecklistLog extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'checklist' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPassedAttribute()
    {
        return collect($this->checklist)->filter(function($item) {
            return $item['completed'] == false;
        })->isEmpty();
    }

    public function getFailedCountAttribute()
    {
        return collect($this->checklist)->filter(function($item) {
            return $item['completed'] == false;
        })->count();
    }
}
