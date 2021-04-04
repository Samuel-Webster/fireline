<?php

namespace App\Http\Livewire;

use App\Models\Appliance;
use Livewire\Component;

class Appliances extends Component
{
    public function getAppliancesProperty()
    {
        return Appliance::all();
    }
    
    public function render()
    {
        return view('livewire.appliances',[
            'appliances' => $this->appliances
        ]);
    }
}
