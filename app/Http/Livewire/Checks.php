<?php

namespace App\Http\Livewire;

use App\Models\ApplianceChecklistLog;
use Livewire\Component;

class Checks extends Component
{
    public $showChecklistModal = false;
    public ApplianceChecklistLog $selectedChecklist;

    public function view(ApplianceChecklistLog $log)
    {
        $this->selectedChecklist = $log;
        
        $this->showChecklistModal = true;
    }

    public function getAppliancesProperty()
    {
        return auth()->user()->currentTeam->appliances()->with('checklistLogs')->get();
    }

    public function render()
    {
        return view('livewire.checks',[
            'appliances' => $this->appliances,
        ]);
    }
}
