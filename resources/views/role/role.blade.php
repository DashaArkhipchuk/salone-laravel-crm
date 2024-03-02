@extends('layouts.app')

@section('content')
    <div class="m-5">
        <h1>Roles</h1>

        <a href="{{ route('role.create') }}" class="btn btn-primary mb-3">Create</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($roles as $modeldata)
                    <tr>
                        <td>{{ $modeldata->name }}</td>
                        <td>
                            <a href="{{ route('role.edit', $modeldata->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('role.show', $modeldata->id) }}" class="btn btn-info btn-sm">Show</a>

                            <form action="{{ route('role.destroy', $modeldata->id) }}" method="post" style="display: inline-block;">
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
