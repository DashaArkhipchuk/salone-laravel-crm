<!-- resources/views/stylists/show.blade.php -->

@extends($layout)

@section('content')
    <div class="container mt-4">
        <h1>{{ $stylist->first_name }} {{ $stylist->last_name }} Details</h1>

        <a href="{{ route('stylist.index') }}" class="btn btn-primary mb-3">Back to Stylists</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Stylist Information</h5>
                <p><strong>First Name:</strong> {{ $stylist->first_name }}</p>
                <p><strong>Last Name:</strong> {{ $stylist->last_name }}</p>
                <p><strong>Contact Phone:</strong> {{ $stylist->contact_phone }}</p>
                <p><strong>Contact Email:</strong> {{ $stylist->contact_email }}</p>
                <p><strong>Salons:</strong>
                    @if(count($stylist->salons) === 0)
                    None
                    @endif

                    @if($layout== 'layouts.app')
                    @foreach ($stylist->salons as $salon)
                        <a href="{{ route('salone.show', $salon->id) }}">{{ $salon->name }}</a>
                    @endforeach
                    @endif 

                    @if($layout != 'layouts.app')
                    @foreach ($stylist->salons as $salon)
                        {{ $salon->name }}
                    @endforeach
                    @endif
            </div>
        </div>


        @if($layout == 'layouts.app')
        <div class="mt-3">
            <a href="{{ route('stylist.edit', $stylist->id) }}" class="btn btn-warning">Edit Stylist</a>

            <form action="{{ route('stylist.destroy', $stylist->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Stylist</button>
            </form>
        </div>
        @endif


    </div>
@endsection
