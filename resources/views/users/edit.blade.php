<!-- resources/views/users/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="mt-4">Edit User</h1>

        <form action="{{ route('user.update', $user->id) }}" method="post" class="mt-3">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">New Password</label>
                <input type="password" id="password" name="password" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
