 <!-- resources/views/appointments/index.blade.php -->

 @extends($layout)

 @section('content')
 <div class="m-5">
     <h1>Appointments</h1>

     @if($layout == 'layouts.app'||$layout=='layouts.manager'||$layout=='layouts.customer')
     <a href="{{ route('appointment.create') }}" class="btn btn-primary mb-3">Create Appointment</a>
     @endif

     <form action="{{ route('appointment.index') }}" method="get" class="mb-3">
         @csrf
         <div class="row">
             <div class="col-md-3">
                 <label for="salon_id">Salon:</label>
                 <select name="salon_id" class="form-control">
                     <option value="">Select Salon</option>
                     @foreach($salons as $salon)
                     <option value="{{ $salon->id }}" {{ $salon_id == $salon->id ? 'selected' : '' }}>{{ $salon->name }}</option>
                     @endforeach
                 </select>
             </div>

             @if($layout != 'layouts.stylist')
             <div class="col-md-3">
                 <label for="stylist_id">Stylist:</label>
                 <select name="stylist_id" class="form-control">
                     <option value="">Select Stylist</option>
                     @foreach($stylists as $stylist)
                     <option value="{{ $stylist->id }}" {{ $stylist_id == $stylist->id ? 'selected' : '' }}>{{ $stylist->first_name }} {{ $stylist->last_name }}</option>
                     @endforeach
                 </select>
             </div>
             @endif

             <div class="col-md-3">
                 <label for="service_id">Service:</label>
                 <select name="service_id" class="form-control">
                     <option value="">Select Service</option>
                     @foreach($services as $service)
                     <option value="{{ $service->id }}" {{ $service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                     @endforeach
                 </select>
             </div>

             @if($layout != 'layouts.customer')
             <div class="col-md-3">
                 <label for="customer_id">Customer:</label>
                 <select name="customer_id" class="form-control">
                     <option value="">Select Customer</option>
                     @foreach($customers as $customer)
                     <option value="{{ $customer->id }}" {{ $customer_id == $customer->id ? 'selected' : '' }}>{{ $customer->first_name }} {{ $customer->last_name }}</option>
                     @endforeach
                 </select>
             </div>
             @endif


             <div class="col-md-3">
                 <label for="start_date">Start Date:</label>
                 <input type="date" name="start_date" class="form-control" value="{{ $start_date }}">
             </div>

             <div class="col-md-3">
                 <label for="end_date">End Date:</label>
                 <input type="date" name="end_date" class="form-control" value="{{ $end_date }}">
             </div>

             <div class="col-md-3 mt-4">
                 <button type="submit" class="btn btn-primary">Apply Filters</button>
             </div>
             <div class="col-md-3 mt-4">
                 <a href="{{ route('appointment.index') }}" class="btn btn-secondary">Reset Filters</a>
             </div>
         </div>
     </form>

     <table class="table">
         <thead>
             <tr>
                 <th>Customer</th>
                 <th>Service</th>
                 @if($layout != 'layouts.stylist')
                 <th>Stylist</th>
                 @endif
                 <th>Salon</th>
                 <th>Schedule</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
             @foreach($appointments as $appointment)
             <tr>
                 <td>{{ $appointment->customer->first_name}} {{ $appointment->customer->last_name }}</td>
                 <td>{{ $appointment->service->name }}</td>
                 @if($layout != 'layouts.stylist')
                 <td>{{ $appointment->stylist->first_name}} {{$appointment->stylist->last_name}}</td>
                 @endif
                 <td>{{ $appointment->salon->name }}</td>
                 <td>{{ $appointment->schedule->date }} {{$appointment->schedule->start_hour}}-{{$appointment->schedule->end_hour}}</td>

                 <td>
                     @if($layout != 'layouts.stylist')
                     <a href="{{ route('appointment.edit', $appointment->id) }}" class="btn btn-warning btn-sm">Edit</a>
                     @endif
                     <a href="{{ route('appointment.show', $appointment->id) }}" class="btn btn-info btn-sm">Show</a>

                     @if($layout != 'layouts.stylist')
                     <form action="{{ route('appointment.destroy', $appointment->id) }}" method="post" style="display: inline-block;">
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