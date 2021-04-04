<?php

namespace App\Http\Livewire;

use App\Models\Appliance;
use Livewire\Component;

class Appliances extends Component
{
    public $showEditModal = false;
    public ?Appliance $editing;

    protected $rules = [
        'editing.name' => 'required|min:3',
        'editing.type' => 'required',
        'editing.team_id' => 'required',
    ];

    public function create()
    {
        $this->resetValidation();
        
        $this->editing = Appliance::make([
            'team_id' => auth()->user()->currentTeam->id
        ]);

        $this->showEditModal = true;
    }

    public function edit(Appliance $appliance)
    {
        $this->resetValidation();

        $this->editing = $appliance;

        $this->showEditModal = true;
    }

    public function save()
    {
        $this->validate();

        $this->editing->save();

        $this->showEditModal = false;
    }

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
