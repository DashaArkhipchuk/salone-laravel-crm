@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Payment</h1>

        <form action="{{ route('payment.update', $payment->id) }}" method="post">
            @csrf
            @method('put')

            <div class="mb-3">
                <label for="customer_id" class="form-label">Customer</label>
                <select id="customer_id" name="customer_id" class="form-control" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @if($payment->customer_id == $customer->id) selected @endif>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="stylist_id" class="form-label">Stylist</label>
                <select id="stylist_id" name="stylist_id" class="form-control" required>
                    @foreach($stylists as $stylist)
                        <option value="{{ $stylist->id }}" @if($payment->stylist_id == $stylist->id) selected @endif>{{ $stylist->first_name }} {{ $stylist->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="service_id" class="form-label">Service</label>
                <select id="service_id" name="service_id" class="form-control" required>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}" @if($payment->service_id == $service->id) selected @endif>{{ $service->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="value" class="form-label">Value</label>
                <input type="number" step="0.01" id="value" name="value" value="{{ $payment->value }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="currency_id" class="form-label">Currency</label>
                <select id="currency_id" name="currency_id" class="form-control" required>
                    @foreach($currencies as $currency)
                        <option value="{{ $currency->id }}" @if($payment->currency_id == $currency->id) selected @endif>{{ $currency->name }} ({{ $currency->code }} )</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
