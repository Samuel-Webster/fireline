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
                <div>{{ $appliance->name }} - {{ $appliance->type }}</div>
                @empty 
                No Appliances
                @endforelse
            </div>
        </div>
    </div>
</div>
