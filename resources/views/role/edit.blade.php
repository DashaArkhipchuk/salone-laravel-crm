@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit role</h1>

        <form action="{{ route('role.update', $role->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $role->name }}">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Edit</button>
        </form>
    </div>
@endsection
