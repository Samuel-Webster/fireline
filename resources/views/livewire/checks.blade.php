<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @forelse($appliances as $appliance)
            <h2 class="text-2xl mb-2 font-black text-warm-gray-700">{{ $appliance->name }}</h2>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-12">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Person
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                When
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Passed
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appliance->checklistLogs as $log)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $log->user->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $log->created_at->diffForHumans() }}
                                                <div x-data x-text="moment.utc('{{ $log->created_at->toIso8601String() }}').local().format('Do MMM HH:mm')"
                                                    class="text-xs text-gray-500"></div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($log->passed)
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-100 text-green-800">
                                                    Yes
                                                  </span>
                                                @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-red-100 text-red-800">
                                                    No - {{ $log->failedCount }} {{ Str::plural('problem', $log->failedCount) }}
                                                </span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <x-jet-secondary-button wire:click="view({{ $log->id }})" wire:loading.attr="disabled">
                                                    View
                                                </x-jet-secondary-button>
                                            </td>
                                        </tr>
                                        @empty 
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            None found, complete a checklist to get started.
                                            </td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty 
            None found...
            @endforelse
        </div>
    </div>

    {{-- Modals --}}
    <x-jet-dialog-modal wire:model="showChecklistModal">
        <x-slot name="title">
            View Checklist
        </x-slot>
    
        <x-slot name="content">
            @if($selectedChecklist)
            <div class="rounded-md bg-blue-50 p-4 mb-2">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                        </svg>
                    </div>

                    <div class="ml-3 flex-1 md:flex md:justify-between">
                        <p class="text-sm text-blue-700">
                            Completed by <b>{{ $selectedChecklist->user->name }}</b> {{ $selectedChecklist->created_at->diffForHumans() }}
                            <b x-data x-text="moment.utc('{{ $selectedChecklist->created_at->toIso8601String() }}').local().format('Do MMM HH:mm')"></b>
                        </p>
                    </div>
                </div>
            </div>
            <div class="flex text-center w-full justify-between items-center font-medium border border-b-0 divide-x rounded-t-md bg-warm-gray-100">
                <div class="p-1 w-2/6">
                    Item
                </div>

                <div class="p-1 w-1/6">
                    Quantity
                </div>

                <div class="p-1 w-2/6">
                    Location
                </div>

                <div class="p-1 w-1/6">
                    Checked
                </div>
            </div>

            <div class="border divide-y rounded-b-md bg-warm-gray-50">
                @forelse($selectedChecklist->checklist as $key => $item)
                <div class="flex w-full justify-between items-center divide-x">
                    <div class="p-1 w-2/6">
                        {{$item['item']}}
                    </div>

                    <div class="p-1 w-1/6 text-center">
                        {{$item['quantity']}}
                    </div>

                    <div class="p-1 w-2/6">
                        {{Str::of($item['location'])->title()}}
                    </div>

                    <div class="p-1 w-1/6 text-center">
                        @if($item['completed'])
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-green-100 text-green-800">
                            Pass
                        </span>
                        @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-sm font-medium bg-red-100 text-red-800">
                            Fail
                        </span>
                        @endif
                    </div>
                </div>
                @empty
                No checklist for this appliance.
                @endforelse
            </div>
            @endif
        </x-slot>
    
        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$toggle('showChecklistModal')" wire:loading.attr="disabled">
                Close
            </x-jet-secondary-button>
        </x-slot>
    </x-jet-dialog-modal>

</div>
