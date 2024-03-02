@extends($layout)

@section('content')
    <div class="m-5">
        <h1>Customers</h1>

        <a href="{{ route('customer.create') }}" class="btn btn-primary mb-3">Create Customer</a>

        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact Phone</th>
                    <th>Contact Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($customers as $customer)
                    <tr>
                        <td>{{ $customer->first_name }}</td>
                        <td>{{ $customer->last_name }}</td>
                        <td>{{ $customer->contact_phone }}</td>
                        <td>{{ $customer->contact_email }}</td>
                        <td>
                            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-info btn-sm">Show</a>

                            @if($layout=='layouts.app')
                            <form action="{{ route('customer.destroy', $customer->id) }}" method="post" style="display: inline-block;">
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

