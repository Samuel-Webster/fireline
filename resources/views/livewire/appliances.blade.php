<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Appliances') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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
                <x-jet-input type="text" wire:model="editing.name"/>
                <x-jet-input-error for="editing.name"/>
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
