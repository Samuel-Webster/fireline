<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(auth()->user()->currentTeam->personal_team)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                Switch into your brigade or ask your brigade to add you to their team to get started.
                </div>
                @else 
                <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @forelse(auth()->user()->currentTeam->appliances as $appliance)
                    <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="flex-1 flex flex-col p-8">
                        <h3 class="mt-6 text-gray-900 text-4xl font-medium">{{$appliance->name}}</h3>
                        <dl class="mt-1 flex-grow flex flex-col justify-between">
                            <dd class="text-gray-500 text-sm">{{$appliance->make}} {{$appliance->model}}</dd>
                            <dd class="mt-3">
                                <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">{{Str::of($appliance->type)->title()}}</span>
                            </dd>
                        </dl>
                    </div>

                    <div>
                        <div class="-mt-px flex divide-x divide-gray-200">
                            <div class="w-0 flex-1 flex">
                                <button class="relative -mr-px w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-bl-lg hover:text-gray-500 hover:bg-gray-200">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                    </svg>
                                    <span class="ml-3">Check</span>
                                </button>
                            </div>

                            <div class="-ml-px w-0 flex-1 flex">
                                <button wire:click="createLog('{{ $appliance->id }}')" class="relative w-0 flex-1 inline-flex items-center justify-center py-4 text-sm text-gray-700 font-medium border border-transparent rounded-br-lg hover:text-gray-500 hover:bg-gray-200">
                                    <svg class="w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <span class="ml-3">Log</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    </li>
                    @empty 
                    No appliances found...
                    @endforelse
                </ul>
                @endif

        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(auth()->user()->currentTeam->personal_team)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                Switch into your brigade or ask your brigade to add you to their team to get started.
                </div>
                @else 
                <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @forelse(auth()->user()->currentTeam->appliances as $appliance)
                    <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="flex-1 flex flex-col p-8">
                        <h3 class="mt-6 text-gray-900 text-4xl font-medium">{{$appliance->name}}</h3>
                        <dl class="mt-1 flex-grow flex flex-col justify-between">
                            <dd class="text-gray-500 text-sm">{{$appliance->make}} {{$appliance->model}}</dd>
                            <dd class="mt-3">
                                <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">{{Str::of($appliance->type)->title()}}</span>
                            </dd>
                        </dl>
                    </div>

                    <div class="space-y-4 p-4 text-left">
                        @forelse($appliance->logs->sortByDesc('odometer_in') as $log)
                        <div>
                            <div>In: {{ $log->odometer_in }} km</div>
                            <div>
                                Crew: 
                                @forelse($log->users as $user)
                                <div>
                                    {{ $user->name }} 
                                    <span class="text-xs uppercase tracking-widest text-gray-500">@if($user->pivot->is_driver) Driver @elseif($user->pivot->is_crew_leader) Crew Leader @endif </span>
                                </div>
                                @empty 
                                @endforelse
                            </div>
                        </div>
                        @empty 
                        @endforelse
                    </div>

                    </li>
                    @empty 
                    No appliances found...
                    @endforelse
                </ul>
                @endif

        </div>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @if(auth()->user()->currentTeam->personal_team)
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                Switch into your brigade or ask your brigade to add you to their team to get started.
                </div>
                @else 
                <ul class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @forelse(auth()->user()->currentTeam->jobs as $job)
                    <li class="col-span-1 flex flex-col text-center bg-white rounded-lg shadow divide-y divide-gray-200">
                    <div class="flex-1 flex flex-col p-8">
                        <h3 class="mt-6 text-gray-900 text-xl font-medium">{{$job->name}}</h3>
                        <dl class="mt-1 flex-grow flex flex-col justify-between">
                            <dd class="text-gray-500 text-sm">{{$job->type}} {{$job->address}}</dd>
                            <dd class="mt-3">
                                <span class="px-2 py-1 text-green-800 text-xs font-medium bg-green-100 rounded-full">Burnt: {{ $job->area_burnt }}</span>
                            </dd>
                        </dl>
                    </div>

                    <div class="space-y-4 p-4 text-left">
                        @forelse($job->applianceLogs as $log)
                        <div>
                            <div>{{ $log->appliance->name }}</div>
                            <div>
                                Crew: 
                                @forelse($log->users as $user)
                                <div>
                                    {{ $user->name }} 
                                    <span class="text-xs uppercase tracking-widest text-gray-500">@if($user->pivot->is_driver) Driver @elseif($user->pivot->is_crew_leader) Crew Leader @endif </span>
                                </div>
                                @empty 
                                @endforelse
                            </div>
                        </div>
                        @empty 
                        @endforelse
                    </div>

                    </li>
                    @empty 
                    No appliances found...
                    @endforelse
                </ul>
                @endif

        </div>
    </div>

    {{-- Modals --}}
    <form wire:submit.prevent="saveLog">
        @if($selectedAppliance)
        <x-jet-dialog-modal wire:model="showLogModal">
            <x-slot name="title">
                {{ $selectedAppliance->name }} Log
            </x-slot>
        
            <x-slot name="content">
                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="job-name" class="block text-sm font-medium text-gray-700">Job Name</label>
                        <div class="mt-1">
                            <input type="text" name="job-name" wire:model="job.name" id="job-name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="e.g. Training or House Fire Long Road">
                            <x-jet-input-error for="job.name"/>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <label for="job-type" class="block text-sm font-medium text-gray-700">Type</label>
                            <select id="job-type" name="job-type" wire:model="job.type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value=''>Please Select...</option>
                                @foreach(App\Models\Job::TYPES as $type)
                                <option value="{{ $type }}">{{ Str::of($type)->title() }}</option>
                                @endforeach
                            </select>
                        <x-jet-input-error for="job.type"/>
                    </div>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="job-address" class="block text-sm font-medium text-gray-700">Address</label>
                        <div class="mt-1">
                            <input type="text" name="job-address" wire:model="job.address" id="job-address" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="123 Something St, Spring Valley">
                            <x-jet-input-error for="job.address"/>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <label for="job-area-burnt" class="block text-sm font-medium text-gray-700">Area Burnt</label>
                        <div class="mt-1">
                            <input type="text" name="job-area-burnt" wire:model="job.area_burnt" id="job-area-burnt" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="1 ha">
                            <x-jet-input-error for="job.area_burnt"/>
                        </div>
                    </div>
                </div>

                <div>
                    <label for="job-action-taken" class="block text-sm font-medium text-gray-700">
                        Action Taken
                    </label>
                    <div class="mt-1">
                        <textarea id="job-action-taken" name="job-action_taken" wire:model="job.action_taken" rows="2" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                        <x-jet-input-error for="job.action_taken"/>
                    </div>
                </div>

                <div>
                    <label for="job-comments" class="block text-sm font-medium text-gray-700">
                        Comments/Issues:
                    </label>
                    <div class="mt-1">
                        <textarea id="job-comments" name="job-comments" wire:model="job.comments" rows="3" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                        <x-jet-input-error for="job.comments"/>
                    </div>
                    <p class="mt-2 text-sm text-gray-500">E.g. vehicle damage; recurring issues; injuries; first-aid; </p>
                </div>

                <h2 class="border-b font-medium text-lg py-2 mb-2">Appliance</h2>

                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="odometer_out" class="block text-sm font-medium text-gray-700">Odometer Out</label>
                        <div class="mt-1">
                            <input @if($selectedAppliance->logs()->orderBy('odometer_in', 'DESC')->first()) disabled @endif type="number" name="odometer_out" wire:model="log.odometer_out" id="odometer_out" class="@if($selectedAppliance->logs()->orderBy('odometer_in', 'DESC')->first()) cursor-not-allowed @endif shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <x-jet-input-error for="log.odometer_out"/>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <label for="odometer_in" class="block text-sm font-medium text-gray-700">Odometer In</label>
                        <div class="mt-1">
                            <input type="number" name="odometer_in" wire:model="log.odometer_in" id="odometer_in" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <x-jet-input-error for="log.odometer_in"/>
                        </div>
                    </div>
                </div>

                <div class="flex space-x-4 mb-4">
                    <div class="w-1/2">
                        <label for="time_out" class="block text-sm font-medium text-gray-700">Time Out</label>
                        <div x-data="{time_out: @entangle('log.time_out')}" class="mt-1">
                            <input type="datetime-local" name="time_out" wire:model="log.time_out" x-bind:value="moment.utc(time_out).local().format('YYYY-MM-DD[T]HH:mm')" x-on:change="time_out = moment($event.target.value).utc()" placeholder="yyyy/mm/dd hh:mm" id="time_out" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <x-jet-input-error for="log.time_out"/>
                        </div>
                    </div>

                    <div class="w-1/2">
                        <label for="time_in" class="block text-sm font-medium text-gray-700">Time In</label>
                        <div x-data="{time_in: @entangle('log.time_in')}" class="mt-1">
                            <input type="datetime-local" name="time_in" x-bind:value="moment.utc(time_in).local().format('YYYY-MM-DD[T]HH:mm')" x-on:change="time_in = moment($event.target.value).utc()" placeholder="yyyy/mm/dd hh:mm" id="time_in" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            <x-jet-input-error for="log.time_in"/>
                        </div>
                    </div>
                </div>

                <h2 class="border-b font-medium text-lg py-2 mb-2">Crewing</h2>

                <div class="flex flex-wrap">
                    @foreach(range(1, $selectedAppliance->seats) as $seat)
                    <div class="w-1/2 flex-shrink-0 py-1 @if($loop->odd) pr-4 @endif">
                        <label for="seat-{{ $seat }}" class="block text-sm font-medium text-gray-700">@if($loop->index == 0) Crew Leader @elseif($loop->index == 1) Driver @else Crew Member #{{$seat}} @endif</label>
                            <select id="seat-{{ $seat }}" name="seat-{{ $seat }}" wire:model="attachedUsers.{{$seat}}" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                <option value=''>Please Select...</option>
                                @foreach(auth()->user()->currentTeam->allUsers() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        <x-jet-input-error for="editing.type"/>
                    </div>
                    @endforeach
                </div>
            </x-slot>
        
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showLogModal')" wire:loading.attr="disabled">
                    Cancel
                </x-jet-secondary-button>
        
                <x-jet-button class="ml-2" wire:loading.attr="disabled">
                    Save
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
        @endif
    </form>

</div>
