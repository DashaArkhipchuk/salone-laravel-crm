@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create new instance</h1>

    <form action="{{ route('salone.store') }}" method="post">
        @csrf
        <h2>Salon Information</h2>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control"></textarea>
            @error('description')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contact_phone">Contact Phone:</label>
            <input type="text" id="contact_phone" name="contact_phone" class="form-control">
            @error('contact_phone')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="contact_email">Contact Email:</label>
            <input type="email" id="contact_email" name="contact_email" class="form-control">
            @error('contact_email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <h2>Address Information</h2>

        <div class="form-group">
            <label for="region">Region:</label>
            <input type="text" name="region" id="region" value="{{ old('region') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="district">District:</label>
            <input type="text" name="district" id="district" value="{{ old('district') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" name="city" id="city" value="{{ old('city') }}" class="form-control">
        </div>

        <div class="form-group">
            <label for="street">Street:</label>
            <input type="text" name="street" id="street" value="{{ old('street') }}" class="form-control">
        </div>

        <h2>Attach managers (optional)</h2>
        <div class="form-group">
            <label for="managers">Managers:</label>
            <select name="managers[]" id="managers" class="form-control" multiple>
                @foreach($managers as $manager)
                <option value="{{ $manager->id }}">{{ $manager->first_name }} {{ $manager->last_name }}</option>
                @endforeach
            </select>
        </div>

        <h2>Attach stylists (optional)</h2>
        <div class="form-group">
            <label for="stylists">Stylists:</label>
            <select name="stylists[]" id="stylists" class="form-control" multiple>
                @foreach($allStylists as $stylist)
                    <option value="{{ $stylist->id }}">{{ $stylist->first_name }} {{ $stylist->last_name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection