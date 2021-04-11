<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Jobs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    @forelse($jobs as $job)
                    <li>
                        <div class="px-4 py-4 sm:px-6">
                            <div class="flex items-center justify-between">
                                <p class="text-xl font-medium text-orange-500 truncate">
                                    {{$job->name}}
                                </p>
                                <div class="ml-2 flex-shrink-0 flex">
                                    <p class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-amber-100 text-amber-800">
                                        {{$job->type}}
                                    </p>
                                </div>
                            </div>
                            <div class="mt-2 sm:flex sm:justify-between">
                                <div class="sm:flex">
                                    <p class="flex items-center text-sm text-gray-500">
                                        <!-- Heroicon name: solid/users -->
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                                          </svg>
                                          {{$job->area_burnt}}
                                      </p>
                                      <p class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0 sm:ml-6">
                                        <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                                        </svg>
                                        {{$job->address}}
                                    </p>
                                </div>
                                <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                    <svg class="flex-shrink-0 mr-1.5 h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd" />
                                    </svg>
                                    <p>
                                        <time x-data x-text="moment.utc('{{ $job->created_at }}').local().format('YYYY-MM-DD HH:mm')"></time>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-4 p-4 text-left bg-warm-gray-100">
                            <div>
                                <h3 class="text-warm-gray-700">Action Taken</h3>
                                <p class="text-sm text-warm-gray-500">{{ $job->action_taken }}</p>
                            </div>

                            <div>
                                <h3 class="text-warm-gray-700">Comments</h3>
                                <p class="text-sm text-warm-gray-500">{{ $job->comments }}</p>
                            </div>
                        </div>

                        <div class="text-left bg-warm-gray-200 flex justify-between divide-x divide-warm-gray-300">
                            @forelse($job->applianceLogs as $log)
                            <div class="p-4 flex-1">
                                <div class="text-warm-gray-700">{{ $log->appliance->name }}</div>
                                <div class="text-warm-gray-700 text-xs pb-2">Out for {{ round($log->time_out->floatDiffInHours($log->time_in), 1) }} hr</div>
                                <div class="space-y-2">
                                    @forelse($log->users as $user)
                                    <div class="text-warm-gray-500">
                                        <div class="text-xs uppercase tracking-widest text-gray-500">@if($user->pivot->is_driver) Driver @elseif($user->pivot->is_crew_leader) Crew Leader @else Crew Member @endif </div>
                                        <div class="text-sm">{{ $user->name }}</div>
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
                    <div class="rounded-md bg-blue-50 p-4">
                        <div class="flex">
                          <div class="flex-shrink-0">
                            <!-- Heroicon name: solid/information-circle -->
                            <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                            </svg>
                          </div>
                          <div class="ml-3 flex-1 md:flex md:justify-between">
                            <p class="text-sm text-blue-700">
                              No jobs yet, log one to get started!
                            </p>
                          </div>
                        </div>
                      </div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

</div>