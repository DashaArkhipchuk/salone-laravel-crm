<!-- resources/views/payments/index.blade.php -->

@extends($layout)

@section('content')
    <div class="m-5">
        <h1>Payments</h1>

        @if ($layout == 'layouts.app')
        <a href="{{ route('payment.create') }}" class="btn btn-primary mb-3">Create Payment</a>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>Currency</th>
                    <th>Customer</th>
                    <th>Service</th>
                    @if($layout == 'layouts.app')
                    <th>Stylist</th>
                    @endif
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($payments as $payment)
                    <tr>
                        <td>{{ $payment->currency->name }}</td>
                        <td>{{ $payment->customer->first_name }} {{ $payment->customer->last_name }}</td>
                        <td>{{ $payment->service->name}}</td>
                        @if($layout == 'layouts.app')
                        <td>{{ $payment->stylist->first_name }} {{ $payment->stylist->last_name }}</td>
                        @endif
                        <td>{{ $payment->value }}</td>
                        <td>
                            @if($layout == 'layouts.app')
                            <a href="{{ route('payment.edit', $payment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif
                            <a href="{{ route('payment.show', $payment->id) }}" class="btn btn-info btn-sm">Show</a>

                            @if($layout == 'layouts.app')
                            <form action="{{ route('payment.destroy', $payment->id) }}" method="post" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
