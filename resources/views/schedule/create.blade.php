@extends($layout)

@section('content')
<div class="container">
    <h1>Create new Schedule</h1>

    <form action="{{ route('schedule.store') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="salon_id" class="form-label">Salon</label>
            <select id="salon_id" name="salon_id" class="form-control" required>
                @foreach($salons as $salon)
                <option value="{{ $salon->id }}">{{ $salon->name }}</option>
                @endforeach
            </select>
        </div>

        @if($layout=='layouts.stylist')
        <div class="mb-3" hidden>
            <label for="stylist_id" class="form-label">Stylist</label>
            <select id="stylist_id" name="stylist_id" class="form-control" required>
                <option value="{{ $stylists->id }}" selected></option>
            </select>
        </div>
        @endif
        @if($layout!='layouts.stylist')
        <div class="mb-3" >
            <label for="stylist_id" class="form-label">Stylist</label>
            <select id="stylist_id" name="stylist_id" class="form-control" required>

            </select>
        </div>
        @endif

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" id="date" name="date" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="start_hour" class="form-label">Start Hour</label>
            <input type="number" id="start_hour" name="start_hour" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="end_hour" class="form-label">End Hour</label>
            <input type="number" id="end_hour" name="end_hour" class="form-control" required>
        </div>

        <br>
        <button type="submit" class="btn btn-primary">Create</button>
        <script>
            document.getElementById('salon_id').addEventListener('change', function () {
                if ($layout != 'layouts.stylist') {
                    fetchAvailableStylists();
                    console.log('updated');
                    
                }
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
                    })
                    .catch(error => {
                        console.error('Error fetching stylists:', error);

                    });
            }
            if ($layout != 'layouts.stylist') {
                fetchAvailableStylists();
                
            }
        </script>
    </form>
</div>
@endsection