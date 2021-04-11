<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Logs extends Component
{
    public function getAppliancesProperty()
    {
        return auth()->user()->currentTeam->appliances()->with('logs')->get();
    }

    public function render()
    {
        return view('livewire.logs',[
            'appliances' => $this->appliances,
        ]);
    }
}
