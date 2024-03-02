 <!-- resources/views/stylists/index.blade.php -->

@extends($layout)

@section('content')
    <div class="m-5">
        <h1>Stylists</h1>

        @if($layout == 'layouts.app')
        <a href="{{ route('stylist.create') }}" class="btn btn-primary mb-3">Create Stylist</a>
        @endif

        <table class="table">
            <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Contact Phone</th>
                    <th>Contact Email</th>
                    <th>Salons</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stylists as $stylist)
                    <tr>
                        <td>{{ $stylist->first_name }}</td>
                        <td>{{ $stylist->last_name }}</td>
                        <td>{{ $stylist->contact_phone }}</td>
                        <td>{{ $stylist->contact_email }}</td>
                        <td> @foreach($stylist->salons as $salon)
                            {{ $salon->name }}
                            @endforeach
                        </td>
                        <td>
                        @if($layout == 'layouts.app')
                            <a href="{{ route('stylist.edit', $stylist->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif
                            <a href="{{ route('stylist.show', $stylist->id) }}" class="btn btn-info btn-sm">Show</a>

                            @if($layout == 'layouts.app')
                            <form action="{{ route('stylist.destroy', $stylist->id) }}" method="post" style="display: inline-block;">
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

