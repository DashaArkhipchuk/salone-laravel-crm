@extends('layouts.app')

@section('content')
    <div class="m-5">
        <h1>Addresses</h1>

        <a href="{{ route('address.create') }}" class="btn btn-primary mb-3">Create Address</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Salon</th>
                    <th>Region</th>
                    <th>District</th>
                    <th>City</th>
                    <th>Street</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($addresses as $address)
                    <tr>
                        <td>
                            {{ $address->salon->name }}
                        </td>
                        <td>{{ $address->region }}</td>
                        <td>{{ $address->district }}</td>
                        <td>{{ $address->city }}</td>
                        <td>{{ $address->street }}</td>
                        <td>
                            <a href="{{ route('address.edit', $address->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('address.show', $address->id) }}" class="btn btn-info btn-sm">Show</a>

                            <form action="{{ route('address.destroy', $address->id) }}" method="post" style="display: inline-block;">
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
