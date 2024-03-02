<!-- resources/views/appointments/edit.blade.php -->

@extends($layout)

@section('content')
<div class="container">
    <h1>Edit Appointment</h1>

    <form action="{{ route('appointment.update', $appointment->id) }}" method="post">
        @csrf
        @method('put')

        @php
        $appointmentId = Route::current()->parameter('id');
        @endphp

        @if($layout=='layouts.customer')
        <div class="mb-3" hidden>
            <label for="customer_id" class="form-label">Customer</label>
            <select id="customer_id" name="customer_id" class="form-control" required>
                <option value="{{ $customers->id }}" selected></option>
            </select>
        </div>
        @endif
        @if($layout!='layouts.customer')
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer</label>
            <select id="customer_id" name="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}" {{ $customer->id == $appointment->customer_id ? 'selected' : ''
                    }}>{{ $customer->first_name}} {{ $customer->last_name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        <div class="mb-3">
            <label for="service_id" class="form-label">Service</label>
            <select id="service_id" name="service_id" class="form-control" required>
                @foreach($services as $service)
                <option value="{{ $service->id }}" {{ $service->id == $appointment->service_id ? 'selected' : '' }}>{{
                    $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="salone_id" class="form-label">Salon</label>
            <select id="salon_id" name="salon_id" class="form-control" required>
                <option value="" selected disabled>Select a salon</option>
                @foreach($salons as $salon)
                <option value="{{ $salon->id }}" {{ $salon->id == $appointment->salon_id ? 'selected' : '' }}>{{
                    $salon->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="stylist_id" class="form-label">Stylist</label>
            <select id="stylist_id" name="stylist_id" class="form-control" required>

            </select>
        </div>



        <div class="mb-3">
            <label for="schedule_id" class="form-label">Schedule</label>
            <select id="schedule_id" name="schedule_id" class="form-control" required>

            </select>
        </div>


        <button type="button" class="btn btn-sm mb-3 btn-secondary" onclick="resetValues()">Reset to original schedule</button>


        <br>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <script>
        var appointmentId = {{ $appointmentId }};
        console.log(appointmentId);

        function resetValues() {
            fetch('/get-appointment-details/' + appointmentId, {
                method: 'GET'
            })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('salon_id').value = data.salon.id;
                    var salonId = document.getElementById('salon_id').value;

            // Use fetch to make an AJAX request`
            fetch('/get-available-stylists/' + salonId, {
                method: 'GET'
            })
                .then(response => response.json())
                .then(stylists => {
                    // Update the stylists dropdown with the fetched data
                    var stylistsDropdown = document.getElementById('stylist_id');
                    stylistsDropdown.innerHTML = ''; // Clear existing options



                    stylists.forEach(function (stylist) {
                        console.log(stylist);
                        var option = document.createElement('option');
                        option.text = stylist.first_name + ' ' + stylist.last_name;
                        option.value = stylist.id;
                        option.id = stylist.id;
                        if (stylist.id == data.salon_id) {
                            option.selected = true;
                        }
                        stylistsDropdown.appendChild(option);
                        //console.log(option);
                    });
                    stylistsDropdown.value=data.stylist.id;

                    fetch('/get-available-schedules/' + data.stylist.id + '/' + data.salon_id+'/'+appointmentId, {
                method: 'GET'
            })
                .then(response => response.json())
                .then(data => {
                    // Update the schedules dropdown with the fetched data
                    var schedulesDropdown = document.getElementById('schedule_id');
                    schedulesDropdown.innerHTML = ''; // Clear existing options


                    data.forEach(function (schedule) {
                        console.log(schedule);
                        var option = document.createElement('option');
                        option.value = schedule.id;
                        option.id = schedule.id;
                        option.text = schedule.date + ' - ' + schedule.start_hour + ' to ' + schedule.end_hour;
                        schedulesDropdown.appendChild(option);
                    });

                    if (data.length == 0) {
                        var option = document.createElement('option');
                        option.value = '';
                        option.text = 'No available schedules';
                        schedulesDropdown.appendChild(option);
                    }

                })
                .catch(error => {
                    console.error('Error fetching schedules:', error);
                });

                })
                .catch(error => {
                    console.error('Error fetching stylists:', error);

                });
                })
                .catch(error => {
                    console.error('Error:', error);
                })
        }


        document.getElementById('stylist_id').addEventListener('change', function () {
            fetchAvailableSchedules();
            console.log('updated');
        });

        document.getElementById('salon_id').addEventListener('change', function () {
            fetchAvailableStylists();
            fetchAvailableSchedules();
            console.log('updated');
        });

        function fetchAvailableStylists(this_stylist_id = 0) {
            var salonId = document.getElementById('salon_id').value;

            // Use fetch to make an AJAX request`
            fetch('/get-available-stylists/' + salonId, {
                method: 'GET'
            })
                .then(response => response.json())
                .then(data => {
                    // Update the stylists dropdown with the fetched data
                    var stylistsDropdown = document.getElementById('stylist_id');
                    stylistsDropdown.innerHTML = ''; // Clear existing options

                    var defaultOption = document.createElement('option');
                    defaultOption.text = 'Select stylist';
                    defaultOption.id = 'select-stylist';
                    stylistsDropdown.addEventListener('change', function () {
                        document.getElementById('select-stylist').disabled = true;
                    })
                    stylistsDropdown.appendChild(defaultOption);



                    data.forEach(function (stylist) {
                        console.log(stylist);
                        var option = document.createElement('option');
                        option.text = stylist.first_name + ' ' + stylist.last_name;
                        option.value = stylist.id;
                        option.id = stylist.id;
                        if (stylist.id == this_stylist_id && this_stylist_id != 0) {
                            option.selected = true;
                        }
                        stylistsDropdown.appendChild(option);
                        //console.log(option);
                    });
                    fetchAvailableSchedules();
                })
                .catch(error => {
                    console.error('Error fetching stylists:', error);

                });
        }

        function fetchAvailableSchedules() {
            let stylistId = document.getElementById('stylist_id').value;
            let salonId = document.getElementById('salon_id').value;

            fetch('/get-available-schedules/' + stylistId + '/' + salonId, {
                method: 'GET'
            })
                .then(response => response.json())
                .then(data => {
                    // Update the schedules dropdown with the fetched data
                    var schedulesDropdown = document.getElementById('schedule_id');
                    schedulesDropdown.innerHTML = ''; // Clear existing options


                    data.forEach(function (schedule) {
                        console.log(schedule);
                        var option = document.createElement('option');
                        option.value = schedule.id;
                        option.id = schedule.id;
                        option.text = schedule.date + ' - ' + schedule.start_hour + ' to ' + schedule.end_hour;
                        schedulesDropdown.appendChild(option);
                    });

                    if (data.length == 0) {
                        var option = document.createElement('option');
                        option.value = '';
                        option.text = 'No available schedules';
                        schedulesDropdown.appendChild(option);
                    }

                })
                .catch(error => {
                    console.error('Error fetching schedules:', error);
                });
        }


        // Initial fetch when the page loads
        fetchAvailableStylists();
        fetchAvailableSchedules();
    </script>
</div>
@endsection