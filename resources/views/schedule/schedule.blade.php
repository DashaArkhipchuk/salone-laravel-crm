 <!-- resources/views/schedules/index.blade.php -->

 @extends($layout)

 @section('content')
 <div class="m-5">
     <h1>Schedules</h1>



     @if($layout == 'layouts.app'||$layout == 'layouts.stylist')
     <a href="{{ route('schedule.create') }}" class="btn btn-primary mb-3">Create Schedule</a>
     @endif


     <form action="{{ route('schedule.index') }}" method="get" class="mb-3">
         @csrf
         <div class="row">
             <div class="col-md-3">
                 <label for="salon_id">Salon:</label>
                 <select name="salon_id" class="form-control">
                     <option value="">Select Salon</option>
                     <!-- Populate options dynamically based on your salon data -->
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
                     <!-- Populate options dynamically based on your stylist data -->
                     @foreach($stylists as $stylist)
                     <option value="{{ $stylist->id }}" {{ $stylist_id == $stylist->id ? 'selected' : '' }}>{{ $stylist->first_name }} {{ $stylist->last_name }}</option>
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

             <div class="col-md-3 mt-3">
                 <button type="submit" class="btn btn-primary">Apply Filters</button>
             </div>
             <div class="col-md-3 mt-3">
                 <a href="{{ route('schedule.index') }}" class="btn btn-secondary">Reset Filters</a>
             </div>
         </div>
     </form>

     <table class="table">
         <thead>
             <tr>
                 <th>Salon</th>
                 @if($layout != 'layouts.stylist')
                 <th>Stylist</th>
                 @endif
                 <th>Date</th>
                 <th>Start Hour</th>
                 <th>End Hour</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
             @foreach($schedules as $schedule)
             <tr>
                 <td>{{ $schedule->salon->name }}</td>
                 @if($layout != 'layouts.stylist')
                 <td>{{ $schedule->stylist->first_name}} {{ $schedule->stylist->last_name }}</td>
                 @endif
                 <td>{{ $schedule->date }}</td>
                 <td>{{ $schedule->start_hour }}</td>
                 <td>{{ $schedule->end_hour }}</td>
                 <td>
                     @if($layout == 'layouts.app'||$layout == 'layouts.stylist')
                     <a href="{{ route('schedule.edit', $schedule->id) }}" class="btn btn-warning btn-sm">Edit</a>
                     @endif
                     <a href="{{ route('schedule.show', $schedule->id) }}" class="btn btn-info btn-sm">Show</a>

                     @if($layout == 'layouts.app' || $layout == 'layouts.stylist')
                     <form action="{{ route('schedule.destroy', $schedule->id) }}" method="post" style="display: inline-block;">
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