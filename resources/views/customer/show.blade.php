@extends($layout)

@section('content')
    <div class="container mt-4">
        <h1>{{ $customer->first_name }} {{ $customer->last_name }} Details</h1>

        <a href="{{ route('customer.index') }}" class="btn btn-primary mb-3">Back to Customers</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Customer Information</h5>
                <p><strong>First Name:</strong> {{ $customer->first_name }}</p>
                <p><strong>Last Name:</strong> {{ $customer->last_name }}</p>
                <p><strong>Contact Phone:</strong> {{ $customer->contact_phone }}</p>
                <p><strong>Contact Email:</strong> {{ $customer->contact_email }}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning">Edit Customer</a>

            @if($layout=='layouts.app')
            <form action="{{ route('customer.destroy', $customer->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Customer</button>
            </form>
            @endif
        </div>
    </div>
@endsection
