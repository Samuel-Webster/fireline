<?php

namespace App\Http\Livewire;

use App\Models\Appliance;
use App\Models\ApplianceLog;
use App\Models\ApplianceChecklistLog;
use App\Models\Job;
use Livewire\Component;

class Dashboard extends Component
{
    public $showLogModal = false;
    public ?Appliance $selectedAppliance;
    public ApplianceLog $log;
    public Job $job;
    public $attachedUsers;
    public $existingJob;
    
    // Checklist
    public $showChecklistModal = false;
    public ApplianceChecklistLog $checklist;
    public $checklistItems;

    protected $rules = [
        'log.odometer_out' => 'required|numeric',
        'log.odometer_in' => 'required|numeric|gt:log.odometer_out',
        'log.time_out' => 'required',
        'log.time_in' => 'required',
        'log.appliance_id' => 'required',
        'log.user_id' => 'required',
        'job.id' => 'sometimes',
        'job.team_id' => 'sometimes',
        'job.name' => 'required',
        'job.type' => 'required',
        'job.address' => 'required',
        'job.area_burnt' => 'required',
        'job.action_taken' => 'required',
        'job.comments' => 'required',
        'checklist.user_id' => 'required',
        'checklist.appliance_id' => 'required',
        'checklistItems.*.completed' => 'sometimes',
    ];

    public function updatedExistingJob($value)
    {
        $job = Job::find($value);

        if($job) $this->job = $job;
    }

    public function createLog(Appliance $appliance)
    {
        $this->resetValidation();

        $this->existingJob = null;

        $this->selectedAppliance = $appliance;

        $this->log = ApplianceLog::make([
            'user_id' => auth()->user()->id,
            'appliance_id' => $appliance->id,
            'time_in' => now()->format('Y-m-d\TH:i'),
            'time_out' => now()->subHours(2)->format('Y-m-d\TH:i'),
            'odometer_out' => $appliance->logs()->orderBy('odometer_in', 'DESC')->first()->odometer_in ?? null
        ]);
        
        $this->job = Job::make([
            'team_id' => auth()->user()->currentTeam->id
        ]);

        $this->showLogModal = true;
    }

    public function saveLog()
    {
        $this->validate();

        $this->log->save();

        $this->job->save();

        $this->job->applianceLogs()->attach($this->log);

        collect($this->attachedUsers)->map(function($user, $key) {
            if($key == 1) return $this->log->users()->attach([$user => ['is_crew_leader' => true, 'is_driver' => false]]); // Crew Leader
            if($key == 2) return $this->log->users()->attach([$user => ['is_crew_leader' => false, 'is_driver' => true]]); // Driver
            return $this->log->users()->attach([$user => ['is_crew_leader' => false, 'is_driver' => false]]);
            
        });

        $this->showLogModal = false;
    }

    public function createChecklist(Appliance $appliance)
    {
        $this->resetValidation();

        $this->selectedAppliance = $appliance;

        $this->checklistItems = $this->selectedAppliance->checklist->sortBy('location')->map(function($item) {
            $item->completed = false;
            return $item;
        });

        $this->checklist = ApplianceChecklistLog::make([
            'user_id' => auth()->user()->id,
            'appliance_id' => $appliance->id
        ]);

        $this->showChecklistModal = true;
    }

    public function saveChecklist()
    {
        $this->checklist->checklist = $this->checklistItems->map(function($item) {
            $item = [
                'item' => $item->item, 
                'quantity' => $item->quantity,
                'location' => $item->location,
                'completed' => $item->completed,
            ];
            return $item;
        });

        $this->checklist->save();

        $this->showChecklistModal = false;
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
