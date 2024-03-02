@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Create New Stylist</h1>

    <form action="{{ route('stylist.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" id="first_name" name="first_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" id="last_name" name="last_name" class="form-control">
        </div>

        <div class="mb-3">
            <label for="contact_phone" class="form-label">Contact Phone</label>
            <input type="text" id="contact_phone" name="contact_phone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="contact_email" class="form-label">Contact Email</label>
            <input type="email" id="contact_email" name="contact_email" class="form-control">
        </div>

        <div class="form-group">
            <label for="salons">Works at salons:</label>
            <select name="salons[]" id="salons" class="form-control" multiple>
                @foreach($allSalons as $salon)
                <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user">Select an associated user:</label>
            <select name="user_id" id="user" class="form-control">
                @foreach($allUsers as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection