@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ $filter->filter_name }} Details</h1>

        <a href="{{ route('filter.index') }}" class="btn btn-primary mb-3">Back to Filters</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Filter Information</h5>
                <p><strong>Filter Name:</strong> {{ $filter->filter_name }}</p>
                <p><strong>Service:</strong> {{ $service->name }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('filter.edit', $filter->id) }}" class="btn btn-warning">Edit Filter</a>

            <form action="{{ route('filter.destroy', $filter->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Filter</button>
            </form>
        </div>
    </div>
@endsection
