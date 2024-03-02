@extends('layouts.app')

@section('content')
    <div class="m-5">
        <h1>Filters</h1>

        <a href="{{ route('filter.create') }}" class="btn btn-primary mb-3">Create Filter</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Filter Name</th>
                    <th>Service</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($filters as $filter)
                    <tr>
                        <td>{{ $filter->filter_name }}</td>
                        <td>{{ $service[$filter->service_id]}}</td>
                        <td>
                            <a href="{{ route('filter.edit', $filter->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('filter.show', $filter->id) }}" class="btn btn-info btn-sm">Show</a>

                            <form action="{{ route('filter.destroy', $filter->id) }}" method="post" style="display: inline-block;">
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
