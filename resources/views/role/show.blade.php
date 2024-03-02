 
@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $role->name }} Details</h1>

        <a href="{{ route('role.index') }}" class="btn btn-primary mb-3">Back to Roles</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Role Information</h5>
                <p><strong>Name:</strong> {{ $role->name }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('role.edit', $role->id) }}" class="btn btn-warning">Edit Role</a>

            <form action="{{ route('role.destroy', $role->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Role</button>
            </form>
        </div>
    </div>
@endsection
