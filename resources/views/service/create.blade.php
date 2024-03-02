@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Create New Service</h1>

        <form action="{{ route('service.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="description">Description</label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection

