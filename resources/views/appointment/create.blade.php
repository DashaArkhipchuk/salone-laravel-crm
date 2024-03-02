<!-- resources/views/appointments/create.blade.php -->

@extends($layout)

@section('content')
<div class="container">
    <h1>Create new Appointment</h1>

    <form action="{{ route('appointment.store') }}" method="post">
        @csrf

        @if ($layout == 'layouts.customer')
        <div class="mb-3" hidden>
            <label for="customer_id" class="form-label">Customer</label>
            <select id="customer_id" name="customer_id" class="form-control" required>
                <option value="{{ $customers->id }}"></option>
            </select>
        </div>
        @endif
        @if($layout != 'layouts.customer')
        <div class="mb-3">
            <label for="customer_id" class="form-label">Customer</label>
            <select id="customer_id" name="customer_id" class="form-control" required>
                @foreach($customers as $customer)
                <option value="{{ $customer->id }}">{{ $customer->first_name}} {{ $customer->last_name }}</option>
                @endforeach
            </select>
        </div>
        @endif

        
        <div class="mb-3">
            <label for="salon_id" class="form-label">Salon</label>
            <select id="salon_id" name="salon_id" class="form-control" required>
                @foreach($salons as $salon)
                <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="stylist_id" class="form-label">Stylist</label>
            <select id="stylist_id" name="stylist_id" class="form-control" required>
                
                </select>
            </div>
            
            <div class="mb-3">
                <label for="service_id" class="form-label">Service</label>
                <select id="service_id" name="service_id" class="form-control" required>
                    
                </select>
            </div>

        <div class="mb-3">
            <label for="schedule_id" class="form-label">Schedule</label>
            <select id="schedule_id" name="schedule_id" class="form-control" required>

            </select>
        </div>



        <br>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>


    <script>

        document.getElementById('salon_id').addEventListener('change', function () {
            fetchAvailableStylists();
            fetchAvailableSchedules();
            console.log('updated');
        });

        document.getElementById('stylist_id').addEventListener('change', function () {
    fetchAvailableServices();
    fetchAvailableSchedules();
    console.log('updated');
});

function fetchAvailableServices() {
    var stylistId = document.getElementById('stylist_id').value;
    console.log('stylistId for services: ' + stylistId);

    if (stylistId === "") {
        console.warn('Stylist not selected. Cannot fetch services without a selected stylist.');
        return;
    }

    // Use fetch to make an AJAX request
    fetch('/get-available-services/' + stylistId, {
        method: 'GET'
    })
        .then(response => response.json())
        .then(data => {
            // Update the services dropdown with the fetched data
            var servicesDropdown = document.getElementById('service_id');
            servicesDropdown.innerHTML = ''; // Clear existing options

            var defaultOption = document.createElement('option');
            defaultOption.value = '';
            defaultOption.text = 'Select Service';
            defaultOption.selected = true;
            servicesDropdown.appendChild(defaultOption);

            data.forEach(function (service) {
                var option = document.createElement('option');
                option.text = service.name;
                option.value = service.id;
                servicesDropdown.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error fetching services:', error);
        });
}

        function fetchAvailableStylists() {
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
                    defaultOption.id='select-stylist';
                    stylistsDropdown.addEventListener('change', function () {
                        document.getElementById('select-stylist').disabled = true;
                    })
                    defaultOption.value = '';
                    defaultOption.text = 'Select Stylist';
                    defaultOption.selected = true;
                    stylistsDropdown.appendChild(defaultOption);

                    data.forEach(function (stylist) {
                        var option = document.createElement('option');
                        option.text = stylist.first_name + ' ' + stylist.last_name;
                        option.value = stylist.id;
                        stylistsDropdown.appendChild(option);
                        //console.log(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching stylists:', error);

                });
        }

        function fetchAvailableSchedules() {
            var stylistId = document.getElementById('stylist_id').value;
            console.log('stylistId: ' + stylistId);
            if (stylistId === "") {
                console.warn('Stylist not selected. Cannot fetch schedules without a selected stylist.');
                return;
            }
            var salonId = document.getElementById('salon_id').value;

            // Use fetch to make an AJAX request
            fetch('/get-available-schedules/' + stylistId + '/' + salonId, {
                method: 'GET'
            })
                .then(response => response.json())
                .then(data => {
                    // Update the schedules dropdown with the fetched data
                    var schedulesDropdown = document.getElementById('schedule_id');
                    schedulesDropdown.innerHTML = ''; // Clear existing options

                    data.forEach(function (schedule) {
                        var option = document.createElement('option');
                        option.value = schedule.id;
                        option.text = schedule.date + ' - ' + schedule.start_hour + ' to ' + schedule.end_hour;
                        schedulesDropdown.appendChild(option);
                    });
                    if (data.length == 0) {
                        schedulesDropdown.innerHTML = '<option value="">No available schedules</option>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching schedules:', error);
                });
        }

        // Initial fetch when the page loads
        fetchAvailableStylists();
        fetchAvailableServices();
        fetchAvailableSchedules();
    </script>
</div>
@endsection