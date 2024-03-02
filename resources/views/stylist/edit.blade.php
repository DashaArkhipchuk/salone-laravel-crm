@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Stylist</h1>

    <form action="{{ route('stylist.update', $stylist->id) }}" method="post">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="first_name">First Name</label>
            <input type="text" id="first_name" name="first_name" value="{{ $stylist->first_name }}"
                class="form-control">
        </div>

        <div class="mb-3">
            <label for="last_name">Last Name</label>
            <input type="text" id="last_name" name="last_name" value="{{ $stylist->last_name }}" class="form-control">
        </div>

        <div class="mb-3">
            <label for="contact_phone">Contact Phone</label>
            <input type="text" id="contact_phone" name="contact_phone" value="{{ $stylist->contact_phone }}"
                class="form-control">
        </div>

        <div class="mb-3">
            <label for="contact_email">Contact Email</label>
            <input type="email" id="contact_email" name="contact_email" value="{{ $stylist->contact_email }}"
                class="form-control">
        </div>

        <div class="form-group">
            <label for="salons">Salons Worked At:</label>
            <select name="salons[]" id="salons" class="form-control" multiple>
                @foreach($allSalons as $salon)
                <option value="{{ $salon->id }}" {{ in_array($salon->id, $currentSalons) ? 'selected' : '' }}>
                    {{ $salon->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="user">Select an associated user:</label>
            <select name="user_id" id="user" class="form-control">
                @foreach($allUsers as $user)
                <option value="{{ $user->id }}" {{ $user->id == $stylist->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection