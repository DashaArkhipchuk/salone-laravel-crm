@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1>Edit Price</h1>

        <form action="{{ route('price.update', $price->id) }}" method="post">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="service_id">Service</label>
                <select id="service_id" name="service_id" class="form-control">
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" {{ $price->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            @if($layout != 'layouts.stylist')
            <div class="mb-3">
                <label for="stylist_id">Stylist</label>
                <select id="stylist_id" name="stylist_id" class="form-control">
                    @foreach($stylists as $stylist)
                        <option value="{{ $stylist->id }}" {{ $price->stylist_id == $stylist->id ? 'selected' : '' }}>{{ $stylist->first_name }} {{ $stylist->last_name }}</option>
                    @endforeach
                </select>
            </div>
            @endif
            @if($layout == 'layouts.stylist')
            <div class="mb-3" hidden>
                <label for="stylist_id">Stylist</label>
                <select id="stylist_id" name="stylist_id" class="form-control">
                    <option value="{{ $stylists->id }}"></option>
                </select>
            </div>
            @endif

            <div class="mb-3">
                <label for="currency_id">Currency</label>
                <select id="currency_id" name="currency_id" class="form-control">
                    @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}" {{ $price->currency_id == $currency->id ? 'selected' : '' }}>{{ $currency->name }} ({{$currency->code}})</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="value">Value</label>
                <input type="text" id="value" name="value" value="{{ $price->value }}" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
