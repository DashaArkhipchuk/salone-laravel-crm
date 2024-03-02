@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ $currency->name }} Details</h1>

        <a href="{{ route('currency.index') }}" class="btn btn-primary mb-3">Back to Currencies</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Currency Information</h5>
                <p><strong>Name:</strong> {{ $currency->name }}</p>
                <p><strong>Code:</strong> {{ $currency->code }}</p>
                <p><strong>Value:</strong> {{ $currency->value }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('currency.edit', $currency->id) }}" class="btn btn-warning">Edit Currency</a>

            <form action="{{ route('currency.destroy', $currency->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Currency</button>
            </form>
        </div>
    </div>
@endsection
