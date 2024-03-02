@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Create new Account</h1>

        <form action="{{ route('account.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select id="user_id" name="user_id" class="form-select" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select id="role_id" name="role_id" class="form-select" required>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
