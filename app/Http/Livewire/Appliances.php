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
    ];

    public function edit(Appliance $appliance)
    {
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
