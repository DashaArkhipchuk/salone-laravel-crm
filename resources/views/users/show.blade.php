@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ $user->name }} Details</h1>

        <a href="{{ route('user.index') }}" class="btn btn-primary mb-3">Back to Users</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">User Information</h5>
                <p><strong>Name:</strong> {{ $user->name }}</p>
                <p><strong>Email:</strong> {{ $user->email }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('user.edit', $user->id) }}" class="btn btn-warning">Edit User</a>

            <form action="{{ route('user.destroy', $user->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete User</button>
            </form>
        </div>
    </div>
@endsection
