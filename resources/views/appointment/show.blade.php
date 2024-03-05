@extends($layout)

@section('content')
    <div class="container mt-4">
        <h1>Appointment Details</h1>

        <a href="{{ route('appointment.index') }}" class="btn btn-primary mb-3">Back to Appointments</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Appointment Information</h5>
                <p><strong>Customer:</strong> {{ $appointment->customer->first_name}} {{$appointment->customer->last_name}}</p>
                <p><strong>Service:</strong> {{ $appointment->service->name }}</p>
                <p><strong>Stylist:</strong> {{ $appointment->stylist->first_name}} {{$appointment->stylist->last_name}}</p>
                <p><strong>Salon:</strong> {{ $appointment->salon->name }}</p>
                <p><strong>Schedule:</strong> {{ $appointment->schedule->date }} {{$appointment->schedule->start_hour}}-{{$appointment->schedule->end_hour}}</p>
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

