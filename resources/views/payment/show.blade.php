@extends($layout)

@section('content')
    <div class="container mt-4">
        <h1>Payment Details</h1>

        <a href="{{ route('payment.index') }}" class="btn btn-primary mb-3">Back to Payments</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Payment Information</h5>
                <p><strong>Customer:</strong> {{ $payment->customer->first_name }} {{ $payment->customer->last_name }}</p>
                <p><strong>Stylist:</strong> {{ $payment->stylist->first_name }} {{ $payment->stylist->last_name }}</p>
                <p><strong>Service:</strong> {{ $payment->service->name }}</p>
                <p><strong>Value:</strong> {{ $payment->value }}</p>
                <p><strong>Currency:</strong> {{ $payment->currency->name }}</p>
            </div>
        </div>

        @if($layout=='layouts.app')
        <div class="mt-3">
            <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-warning">Edit Payment</a>

            <form action="{{ route('payment.destroy', $payment->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Payment</button>
            </form>
        </div>
        @endif
    </div>
@endsection
