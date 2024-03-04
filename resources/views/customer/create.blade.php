@extends($layout)

@section('content')
    <div class="container mt-4">
        <h1>Create New Customer</h1>

        <form action="{{ route('customer.store') }}" method="post">
            @csrf
            <div class="mb-3">
                <label for="first_name">First Name</label>
                <input type="text" id="first_name" name="first_name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="last_name">Last Name</label>
                <input type="text" id="last_name" name="last_name" class="form-control">
            </div>

            <div class="mb-3">
                <label for="contact_phone">Contact Phone</label>
                <input type="text" id="contact_phone" name="contact_phone" class="form-control">
            </div>

            <div class="mb-3">
                <label for="contact_email">Contact Email</label>
                <input type="email" id="contact_email" name="contact_email" class="form-control">
            </div>

            <div class="form-group">
            <label for="user">Select an associated user:</label>
            <select name="user_id" id="user" class="form-control">
                @foreach($allUsers as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection

