@extends('layouts.app')

@section('content')
<div class="m-5">
    <h1>Managers</h1>

    <a href="{{ route('manager.create') }}" class="btn btn-primary mb-3">Create Manager</a>

    <table class="table">
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Contact Phone</th>
                <th>Contact Email</th>
                <th>Salons</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($managers as $manager)
            <tr>
                <td>{{ $manager->first_name }}</td>
                <td>{{ $manager->last_name }}</td>
                <td>{{ $manager->contact_phone }}</td>
                <td>{{ $manager->contact_email }}</td>
                <td> @foreach($manager->salons as $salon)
                    {{ $salon->name }}
                    @endforeach
                </td>
                <td>
                    <a href="{{ route('manager.edit', $manager->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <a href="{{ route('manager.show', $manager->id) }}" class="btn btn-info btn-sm">Show</a>

                    <form action="{{ route('manager.destroy', $manager->id) }}" method="post"
                        style="display: inline-block;">
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