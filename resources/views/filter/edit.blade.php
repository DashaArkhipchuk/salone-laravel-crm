@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Filter</h1>

        <form action="{{ route('filter.update', $filter->id) }}" method="post">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="filter_name" class="form-label">Filter Name</label>
                <input type="text" id="filter_name" name="filter_name" value="{{ $filter->filter_name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="service_id" class="form-label">Service</label>
                <select id="service_id" name="service_id" class="form-control" required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ $service->id == $filter->service_id ? 'selected' : '' }}>{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <br>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
