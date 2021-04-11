<?php

namespace App\Http\Livewire;

use App\Models\Appliance;
use App\Models\ApplianceChecklist;
use Livewire\Component;

class Appliances extends Component
{
    public $showEditModal = false;
    public ?Appliance $editing;

    // Checklist Specific
    public $showEditChecklistModal = false;
    public $checklistItems = [];
    public $inputs = [];
    public $i = -1;

    protected $rules = [
        'editing.name' => 'required|min:3',
        'editing.type' => 'required',
        'editing.make' => 'required',
        'editing.model' => 'required',
        'editing.seats' => 'required',
        'editing.year' => 'required',
        'editing.VIN' => 'required',
        'editing.fleet_number' => 'required',
        'editing.team_id' => 'required',
    ];

    protected $validationAttributes = [
        'checklistItems.*.item' => 'item',
        'checklistItems.*.quantity' => 'quantity',
        'checklistItems.*.location' => 'location',
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

    public function editChecklist(Appliance $appliance)
    {
        $this->resetValidation();

        $this->editing = $appliance;

        $this->checklistItems = ApplianceChecklist::where('appliance_id', $this->editing->id)->get()->toArray();
        $this->inputs = collect($this->checklistItems)->values()->keys()->toArray();

        $this->showEditChecklistModal = true;
    }

    public function saveChecklist()
    {
        $this->validate([
            'checklistItems.*.item' => 'required',
            'checklistItems.*.quantity' => 'required',
            'checklistItems.*.location' => 'required',
        ]);

        foreach ($this->checklistItems as $key => $value) {

            $checklistItem = ApplianceChecklist::updateOrCreate(
                [
                    'id' => $this->checklistItems[$key]['id'] ?? null,
                    'appliance_id' => $this->editing->id,
                ],[
                    'item' => $this->checklistItems[$key]['item'], 
                    'quantity' => $this->checklistItems[$key]['quantity'],
                    'location' => $this->checklistItems[$key]['location'],
                ]
            );
        }
    
        $this->resetInputFields();

        $this->showEditChecklistModal = false;
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
    }
        
    public function remove($i)
    {
        if($checklistItem = $this->editing->checklist()->find($this->checklistItems[$i]['id'] ?? null)) {
            $checklistItem->delete();
        }

        unset($this->checklistItems[$i]);
        unset($this->inputs[$i]);
    }

    private function resetInputFields(){
        $this->checklistItems = [];
        $this->inputs = [];
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
