@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $address->street }} Details</h1>

        <a href="{{ route('address.index') }}" class="btn btn-primary mb-3">Back to Addresses</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Address Information</h5>
                <p><strong>Salon:</strong> {{ ($address->salon!=null) ?$address->salon->name:'Unknown Salon' }}</p>
                <p><strong>Region:</strong> {{ $address->region }}</p>
                <p><strong>District:</strong> {{ $address->district }}</p>
                <p><strong>City:</strong> {{ $address->city }}</p>
                <p><strong>Street:</strong> {{ $address->street }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('address.edit', $address->id) }}" class="btn btn-warning">Edit Address</a>

            <form action="{{ route('address.destroy', $address->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Address</button>
            </form>
        </div>
    </div>
@endsection

