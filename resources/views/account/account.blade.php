@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Accounts</h1>

        <a href="{{ route('account.create') }}" class="btn btn-primary mb-3">Create Account</a>

        <table class="table">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($accounts as $account)
                    <tr>
                        <td>{{ $users[$account->user_id] }}</td>
                        <td>{{ $roles[$account->role_id] }}</td>
                        <td>
                            <a href="{{ route('account.edit', $account->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('account.show', $account->id) }}" class="btn btn-info btn-sm">Show</a>

                            <form action="{{ route('account.destroy', $account->id) }}" method="post" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
