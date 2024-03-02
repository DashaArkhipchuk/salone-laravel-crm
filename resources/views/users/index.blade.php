<!-- resources/views/users/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="m-5">
        <h1>Users</h1>
        <a href="{{ route('user.create') }}" class="btn btn-success">Create New User</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.show', $user->id) }}" class="btn btn-info btn-sm">Show</a>

                            <form action="{{ route('user.destroy', $user->id) }}" method="post" style="display: inline-block;">
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
