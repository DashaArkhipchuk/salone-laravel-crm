<!-- resources/views/services/show.blade.php -->

@extends($layout)

@section('content')
<div class="container mt-4">
    <h1>{{ $service->name }} Details</h1>

    <a href="{{ route('service.index') }}" class="btn btn-primary mb-3">Back to Services</a>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Service Information</h5>
            <p><strong>Name:</strong> {{ $service->name }}</p>
            <p><strong>Description:</strong> {{ $service->description }}</p>
        </div>
    </div>

    @if($layout=='layouts.app')
    <div class="mt-3">
        <a href="{{ route('service.edit', $service->id) }}" class="btn btn-warning">Edit Service</a>

        <form action="{{ route('service.destroy', $service->id) }}" method="post" style="display: inline-block;">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Delete Service</button>
        </form>
    </div>
    @endif

</div>
@endsection