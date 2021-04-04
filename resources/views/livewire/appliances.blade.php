<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appliances') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-jet-button wire:click="create" wire:loading.attr="disabled">Create</x-jet-button>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @forelse($appliances as $appliance)
                <div>
                    {{ $appliance->name }} - {{ $appliance->type }}
                    <x-jet-secondary-button wire:click="edit({{ $appliance->id }})" wire:loading.attr="disabled">
                        Edit
                    </x-jet-secondary-button>
                </div>
                @empty 
                No Appliances
                @endforelse
            </div>
        </div>
    </div>

    {{-- Modals --}}
    <form wire:submit.prevent="save">>
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
            </x-slot>
        
            <x-slot name="footer">
                <x-jet-secondary-button wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    Cancel
                </x-jet-secondary-button>
        
                <x-jet-button class="ml-2" wire:loading.attr="disabled">
                    Save
                </x-jet-button>
            </x-slot>
        </x-jet-dialog-modal>
    </form>
</div>
