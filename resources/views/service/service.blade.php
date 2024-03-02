 <!-- resources/views/services/index.blade.php -->

 @extends($layout)

 @section('content')
 <div class="m-5">
     <h1>Services</h1>

     @if($layout=='layouts.app')
     <a href="{{ route('service.create') }}" class="btn btn-primary mb-3">Create Service</a>
     @endif

     <table class="table">
         <thead>
             <tr>
                 <th>Name</th>
                 <th>Description</th>
                 <th>Action</th>
             </tr>
         </thead>
         <tbody>
             @foreach($services as $service)
             <tr>
                 <td>{{ $service->name }}</td>
                 <td>{{ $service->description }}</td>
                 <td>
                     @if($layout=='layouts.app')
                     <a href="{{ route('service.edit', $service->id) }}" class="btn btn-warning btn-sm">Edit</a>
                     @endif
                     <a href="{{ route('service.show', $service->id) }}" class="btn btn-info btn-sm">Show</a>

                     @if($layout=='layouts.app')
                     <form action="{{ route('service.destroy', $service->id) }}" method="post" style="display: inline-block;">
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