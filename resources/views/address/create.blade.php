@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create new Address</h1>

        <form action="{{ route('address.store') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="salon_id">Salon:</label>
                <select id="salon_id" name="salon_id" class="form-control">
                    <option value="0" selected disabled>Select Salon</option>
                    @foreach($salons as $salon)
                        <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                    @endforeach
                </select>
                @error('salon_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="region">Region:</label>
                <input type="text" id="region" name="region" class="form-control @error('region') is-invalid @enderror" required>
                @error('region')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="district">District:</label>
                <input type="text" id="district" name="district" class="form-control @error('district') is-invalid @enderror" required>
                @error('district')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" required>
                @error('city')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="street">Street:</label>
                <input type="text" id="street" name="street" class="form-control @error('street') is-invalid @enderror" required>
                @error('street')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection

