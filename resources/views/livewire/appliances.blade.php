<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appliances') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex items-center justify-end mb-2">
                <x-jet-button wire:click="create" wire:loading.attr="disabled">Create</x-jet-button>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Name
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Type
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                ODO
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Last Job
                                            </th>
                                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Last Checked
                                            </th>
                                            <th scope="col" class="relative px-6 py-3">
                                                <span class="sr-only">Edit</span>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($appliances as $appliance)
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $appliance->name }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ Str::of($appliance->type)->title() }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{$appliance->currentOdometer}} km
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($appliance->lastLogTimeIn)
                                                {{ $appliance->lastLogTimeIn->diffForHumans() }}
                                                <div x-data x-text="moment.utc('{{ $appliance->lastLogTimeIn->toIso8601String()}}').local().format('Do MMM HH:mm')"
                                                    class="text-xs text-gray-500"></div>
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if($appliance->lastChecked)
                                                {{ $appliance->lastChecked->diffForHumans() }}
                                                <div x-data x-text="moment.utc('{{ $appliance->lastChecked->toIso8601String()}}').local().format('Do MMM HH:mm')"
                                                    class="text-xs text-gray-500"></div>
                                                @else
                                                N/A
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <x-jet-secondary-button wire:click="edit({{ $appliance->id }})" wire:loading.attr="disabled">
                                                    Edit
                                                </x-jet-secondary-button>

                                                <x-jet-secondary-button wire:click="editChecklist({{ $appliance->id }})" wire:loading.attr="disabled">
                                                    Checklist
                                                </x-jet-secondary-button>
                                            </td>
                                        </tr>
                                        @empty 
                                        <tr class="bg-white">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            None found. Create an appliance to get started.
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
        </div>
    </div>

    {{-- Modals --}}
    <form wire:submit.prevent="save">
        <x-jet-dialog-modal wire:model="showEditModal">
            <x-slot name="title">
                Edit Appliance
            </x-slot>
        
            <x-slot name="content">
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <div class="mt-1">
                        <input type="text" name="name" wire:model="editing.name" id="name" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="TM51">
                        <x-jet-input-error for="editing.name"/>
                    </div>
                </div>

                <div>
                    <label for="type" class="block text-sm font-medium text-gray-700">Type</label>
                        <select id="type" name="type" wire:model="editing.type" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value=''>Please Select...</option>
                            @foreach(App\Models\Appliance::TYPES as $type)
                            <option value="{{ $type }}">{{ Str::of($type)->title() }}</option>
                            @endforeach
                        </select>
                    <x-jet-input-error for="editing.type"/>
                </div>

                <div>
                    <label for="make" class="block text-sm font-medium text-gray-700">Make</label>
                        <select id="make" name="make" wire:model="editing.make" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                            <option value=''>Please Select...</option>
                            @foreach(App\Models\Appliance::MAKES as $make)
                            <option value="{{ $make }}">{{ Str::of($make)->title() }}</option>
                            @endforeach
                        </select>
                    <x-jet-input-error for="editing.make"/>
                </div>

                <div>
                    <label for="model" class="block text-sm font-medium text-gray-700">Model</label>
                    <div class="mt-1">
                        <input type="text" name="model" wire:model="editing.model" id="model" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="NPS 300">
                        <x-jet-input-error for="editing.model"/>
                    </div>
                </div>

                <div>
                    <label for="year" class="block text-sm font-medium text-gray-700">Year</label>
                    <div class="mt-1">
                        <input type="date" name="year" wire:model="editing.year" id="year" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="NPS 300">
                        <x-jet-input-error for="editing.year"/>
                    </div>
                </div>

                <div>
                    <label for="seats" class="block text-sm font-medium text-gray-700">Seats</label>
                    <div class="mt-1">
                        <input type="number" name="seats" wire:model="editing.seats" id="seats" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="3">
                        <x-jet-input-error for="editing.seats"/>
                    </div>
                </div>

                <div>
                    <label for="vin" class="block text-sm font-medium text-gray-700">VIN</label>
                    <div class="mt-1">
                        <input type="text" name="vin" wire:model="editing.VIN" id="vin" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="1HGBH41JXMN109186">
                        <x-jet-input-error for="editing.VIN"/>
                    </div>
                </div>

                <div>
                    <label for="fleet_number" class="block text-sm font-medium text-gray-700">Fleet #</label>
                    <div class="mt-1">
                        <input type="text" name="fleet_number" wire:model="editing.fleet_number" id="fleet_number" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="RF5304">
                        <x-jet-input-error for="editing.fleet_number"/>
                    </div>
                  </div>
            </x-slot>
        
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showEditModal')" wire:loading.attr="disabled">
                    Cancel
                </x-jet-secondary-button>
        
                <x-jet-button class="ml-2" wire:loading.attr="disabled">
                    Save
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>

    <form wire:submit.prevent="saveChecklist">
        <x-jet-dialog-modal wire:model="showEditChecklistModal">
            <x-slot name="title">
                Edit Appliance Checklist
            </x-slot>
        
            <x-slot name="content">
                @foreach($inputs as $key => $value)
                <div wire:key="checklist-row-{{$key}}" >
                    <div class="flex justify-between items-end space-x-2">
                        <div>
                            <label for="checklist-item-{{$key}}" class="block text-sm font-medium text-gray-700">Item</label>
                            <div class="mt-1">
                                <input type="text" name="item" wire:model="checklistItems.{{$key}}.item" id="checklist-item-{{$key}}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="T Cards">
                                <x-jet-input-error for="checklistItems.{{$key}}.item"/>
                            </div>
                        </div>
                        
                        <div>
                            <label for="checklist-quantity-{{$key}}" class="block text-sm font-medium text-gray-700">Quantity</label>
                            <div class="mt-1">
                                <input type="text" name="quantity" wire:model="checklistItems.{{$key}}.quantity" id="checklist-quantity-{{$key}}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" placeholder="3">
                                <x-jet-input-error for="checklistItems.{{$key}}.quantity"/>
                            </div>
                        </div>

                        <div>
                            <label for="checklist-location-{{$key}}" class="block text-sm font-medium text-gray-700">Location</label>
                                <select id="checklist-location-{{$key}}" name="location" wire:model="checklistItems.{{$key}}.location" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                                    <option value=''>Please Select...</option>
                                    @foreach(App\Models\ApplianceChecklist::LOCATIONS as $location)
                                    <option value="{{ $location }}">{{ Str::of($location)->title() }}</option>
                                    @endforeach
                                </select>
                            <x-jet-input-error for="checklistItems.{{$key}}.location"/>
                        </div>

              
                        <div class="w-1/6">
                        <x-jet-danger-button class="w-full" wire:click.prevent="remove({{$key}})">Delete</x-jet-danger-button>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="mt-2">
                    <x-jet-secondary-button wire:click.prevent="add({{$i}})">Add</x-jet-secondary-button>
                </div>
            </x-slot>
        
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('showEditChecklistModal')" wire:loading.attr="disabled">
                    Cancel
                </x-jet-secondary-button>
        
                <x-jet-button class="ml-2" wire:loading.attr="disabled">
                    Save
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>
