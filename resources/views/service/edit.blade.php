@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Service</h1>

        <form action="{{ route('service.update', $service->id) }}" method="post">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ $service->name }}" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control">{{ $service->description }}</textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
