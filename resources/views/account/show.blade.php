@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Account Details</h1>

        <a href="{{ route('account.index') }}" class="btn btn-primary mb-3">Back to Accounts</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Account Information</h5>
                <p><strong>User:</strong> {{ $user->name }}</p>
                <p><strong>Role:</strong> {{ $role->name}}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('account.edit', $account->id) }}" class="btn btn-warning">Edit Account</a>

            <form action="{{ route('account.destroy', $account->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </form>
        </div>
    </div>
@endsection
