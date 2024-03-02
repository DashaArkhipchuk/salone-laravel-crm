@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>{{ $manager->first_name }} {{ $manager->last_name }} Details</h1>

        <a href="{{ route('manager.index') }}" class="btn btn-primary mb-3">Back to Managers</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Manager Information</h5>
                <p><strong>First Name:</strong> {{ $manager->first_name }}</p>
                <p><strong>Last Name:</strong> {{ $manager->last_name }}</p>
                <p><strong>Contact Phone:</strong> {{ $manager->contact_phone }}</p>
                <p><strong>Contact Email:</strong> {{ $manager->contact_email }}</p>

                <p><strong>Salons Managed:</strong>
                @if(count($manager->salons) === 0)
                    None
                @endif  
                    @foreach ($manager->salons as $salon)
                        <a href="{{ route('salone.show', $salon->id) }}">{{ $salon->name }}</a>
                    @endforeach
                </p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('manager.edit', $manager->id) }}" class="btn btn-warning">Edit Manager</a>

            <form action="{{ route('manager.destroy', $manager->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Manager</button>
            </form>
        </div>
    </div>
@endsection
