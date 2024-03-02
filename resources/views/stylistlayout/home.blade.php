@extends('layouts.stylist')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <h3 class="mt-5">Upcoming Appointments</h3>

            <div class="list-group mt-3">
                @foreach($appointments as $appointment)
                    <div class="list-group-item list-group-item-action">
                        <h5 class="mb-1">{{ $appointment->service->name }}</h5>
                        <p class="mb-1"><strong>Customer:</strong> {{ $appointment->customer->first_name }} {{ $appointment->customer->last_name }}</p>
                        <p class="mb-1"><strong>Stylist:</strong> {{ $appointment->stylist->first_name }} {{ $appointment->stylist->last_name }}</p>
                        <p class="mb-1"><strong>Date:</strong> {{ $appointment->schedule->date }}</p>
                        <p class="mb-1"><strong>Time:</strong> {{ $appointment->schedule->start_hour }}:00 - {{ $appointment->schedule->end_hour }}:00</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
