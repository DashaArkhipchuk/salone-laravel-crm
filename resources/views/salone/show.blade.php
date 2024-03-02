@extends($layout)

@section('content')

<div class="container">
    <h1>{{ $salone->name }} Details</h1>

    <a href="{{ route('salone.index') }}" class="btn btn-primary mb-3">Back to Salons</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Salon Information</h5>
            <p><strong>Name:</strong> {{ $salone->name }}</p>
            <p><strong>Description:</strong> {{ $salone->description }}</p>
            <p><strong>Managers:</strong>
                @foreach($salone->salonManager as $manager)
                {{ $manager->first_name }} {{ $manager->last_name }}
                @endforeach
            </p>
            <p><strong>Stylists:</strong>
                @foreach($salone->salonStylist as $stylist)
                {{ $stylist->first_name }} {{ $stylist->last_name }}
                @endforeach
            </p>

            <p> <strong>Address:</strong>
                {{$salone->salonAddress->city}} {{$salone->salonAddress->street}}
            </p>
            <p><strong>Contact Phone:</strong> {{ $salone->contact_phone }}</p>
            <p><strong>Contact Email:</strong> {{ $salone->contact_email }}</p>
        </div>
    </div>

    @if($layout == 'layouts.app')
    <div class="mt-3">
        <a href="{{ route('salone.edit', $salone->id) }}" class="btn btn-warning">Edit Salon</a>

        <form action="{{ route('salone.destroy', $salone->id) }}" method="post" style="display: inline-block;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete Salon</button>
        </form>
    </div>
    @endif
</div>

@endsection