<!-- resources/views/prices/show.blade.php -->

@extends($layout)

@section('content')
    <div class="container mt-4">
        <h1>Price Details</h1>

        <a href="{{ route('price.index') }}" class="btn btn-primary mb-3">Back to Prices</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Price Information</h5>
                <p><strong>Service:</strong> {{ $price->service->name }}</p>
                <p><strong>Stylist:</strong> {{ $price->stylist->first_name }} {{ $price->stylist->last_name }}</p>
                <p><strong>Currency:</strong> {{ $price->currency->name }} ({{ $price->currency->code}})</p>
                <p><strong>Value:</strong> {{ $price->value }}</p>
            </div>
        </div>

        @if($layout == 'layouts.app')
        <div class="mt-3">
            <a href="{{ route('price.edit', $price->id) }}" class="btn btn-warning">Edit Price</a>

            <form action="{{ route('price.destroy', $price->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Price</button>
            </form>
        </div>
        @endif
    </div>
@endsection
