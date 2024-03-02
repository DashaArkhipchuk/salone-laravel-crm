@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Currency</h1>

        <form action="{{ route('currency.update', $currency->id) }}" method="post" class="mt-3">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" value="{{ $currency->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" id="code" name="code" value="{{ $currency->code }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Value</label>
                <input type="number" id="value" name="value" value="{{ $currency->value }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection
