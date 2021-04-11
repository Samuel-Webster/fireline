<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Jobs extends Component
{
    public function getJobsProperty()
    {
        return auth()->user()->currentTeam->jobs;
    }

    public function render()
    {
        return view('livewire.jobs',[
            'jobs' => $this->jobs,
        ]);
    }
}
