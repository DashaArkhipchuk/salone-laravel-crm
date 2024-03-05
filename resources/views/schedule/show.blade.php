@extends($layout)

@section('content')
    <div class="container mt-4">
        <h1>Schedule Details</h1>

        <a href="{{ route('schedule.index') }}" class="btn btn-primary mb-3">Back to Schedules</a>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Schedule Information</h5>
                <p><strong>Salon:</strong> {{ $schedule->salon->name }}</p>
                <p><strong>Stylist:</strong> {{ $schedule->stylist->first_name}} {{ $schedule->stylist->last_name }}</p>
                <p><strong>Date:</strong> {{ $schedule->date }}</p>
                <p><strong>Start Hour:</strong> {{ $schedule->start_hour }}</p>
                <p><strong>End Hour:</strong> {{ $schedule->end_hour }}</p>
            </div>
        </div>

        @if($layout=='layouts.app')
        <div class="mt-3">
            <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-warning">Edit Schedule</a>

            <form action="{{ route('schedule.destroy', $schedule->id) }}" method="post" style="display: inline-block;">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete Schedule</button>
            </form>
        </div>
        @endif
    </div>
@endsection

