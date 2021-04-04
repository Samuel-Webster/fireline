<div>
    Appliances

    @forelse($appliances as $appliance)
    <div>{{ $appliance->name }} - {{ $appliance->type }}</div>
    @empty 
    No Appliances
    @endforelse
</div>
