@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create new Address</h1>

    <form action="{{ route('address.update', $address->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="salo_id">Salon:</label>
            <select id="salon_id" name="salon_id" class="form-control">
                <option value="" selected disabled>Select Salon</option>
                @foreach($salons as $id => $name)
                <option value="{{ $id }}" {{ $address->salone_id == $id ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="region">Region:</label>
            <input type="text" id="region" name="region" class="form-control" value="{{ $address->region }}" required>
        </div>

        <div class="form-group">
            <label for="district">District:</label>
            <input type="text" id="district" name="district" class="form-control" value="{{ $address->district }}"
                required>
        </div>

        <div class="form-group">
            <label for="city">City:</label>
            <input type="text" id="city" name="city" class="form-control" value="{{ $address->city }}" required>
        </div>

        <div class="form-group">
            <label for="street">Street:</label>
            <input type="text" id="street" name="street" class="form-control" value="{{ $address->street }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>

    </form>
</div>
@endsection