@extends('layouts.app')

@section('content')
    <div class="m-5">
        <h1>Currencies</h1>

        <a href="{{ route('currency.create') }}" class="btn btn-primary mb-3">Create Currency</a>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($currencies as $currency)
                    <tr>
                        <td>{{ $currency->name }}</td>
                        <td>{{ $currency->code }}</td>
                        <td>{{ $currency->value }}</td>
                        <td>
                            <a href="{{ route('currency.edit', $currency->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('currency.show', $currency->id) }}" class="btn btn-info btn-sm">Show</a>

                            <form action="{{ route('currency.destroy', $currency->id) }}" method="post" style="display: inline-block;">
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

