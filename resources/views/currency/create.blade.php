@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Create new Currency</h1>

        <form action="{{ route('currency.store') }}" method="post" class="mt-3">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="code" class="form-label">Code</label>
                <input type="text" id="code" name="code" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Value</label>
                <input type="text" id="value" name="value" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
