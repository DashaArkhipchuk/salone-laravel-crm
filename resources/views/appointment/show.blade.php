@extends($layout)

@section('content')
    <div class="container mt-4">
        <h1>Appointment Details</h1>

        <a href="{{ route('appointment.index') }}" class="btn btn-primary mb-3">Back to Appointments</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Appointment Information</h5>
                <p><strong>Customer:</strong> {{ $customer->first_name}} {{$customer->last_name}}</p>
                <p><strong>Service:</strong> {{ $service->name }}</p>
                <p><strong>Stylist:</strong> {{ $stylist->first_name}} {{$stylist->last_name}}</p>
                <p><strong>Salon:</strong> {{ $salon->name }}</p>
                <p><strong>Schedule:</strong> {{ $schedule->date }} {{$schedule->start_hour}}-{{$schedule->end_hour}}</p>
            </div>
        </div>

        <div class="mt-3">
            <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-warning">Edit Appointment</a>

            <form action="{{ route('appointment.destroy', $appointment->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Appointment</button>
            </form>
        </div>
    </div>
@endsection

