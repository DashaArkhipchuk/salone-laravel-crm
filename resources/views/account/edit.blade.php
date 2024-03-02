@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Account</h1>

        <form action="{{ route('account.update', $account->id) }}" method="post">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="user_id" class="form-label">User</label>
                <select id="user_id" name="user_id" class="form-control" required>
                    @foreach($users as $userId => $userName)
                        <option value="{{ $userId }}" {{ $userId == $account->user_id ? 'selected' : '' }}>
                            {{ $userName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Role</label>
                <select id="role_id" name="role_id" class="form-control" required>
                    @foreach($roles as $roleId => $roleName)
                        <option value="{{ $roleId }}" {{ $roleId == $account->role_id ? 'selected' : '' }}>
                            {{ $roleName }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
