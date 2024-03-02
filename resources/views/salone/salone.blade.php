@extends($layout)

@section('content')
<div class="m-5">
    <h1>Salons</h1>

    @if($layout == 'layouts.app')
        <a href="{{ route('salone.create') }}" class="btn btn-primary mb-3">Create</a>
    @endif

    <form action="{{ route('salone.index') }}" method="get" class="mb-3">
    @csrf
    <div class="row">
        <!-- Existing filters for salon -->
        <div class="col-md-3">
            <label for="city">City:</label>
            <select name="city" class="form-control">
                <option value="">Select City</option>
                @foreach($cities as $cityOption)
                    <option value="{{ $cityOption }}" {{ $city == $cityOption ? 'selected' : '' }}>{{ $cityOption }}</option>
                @endforeach
            </select>
        </div>

        <div class="col-md-3">
            <label for="stylist_id">Stylist:</label>
            <select name="stylist_id" class="form-control">
                <option value="">Select Stylist</option>
                @foreach($stylists as $stylist)
                    <option value="{{ $stylist->id }}" {{ $stylist_id == $stylist->id ? 'selected' : '' }}>{{ $stylist->first_name }} {{ $stylist->last_name }}</option>
                @endforeach
            </select>
        </div>

        <!-- Add other filter selects here -->

        <div class="col-md-3 mt-4">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
        </div>
        <div class="col-md-3 mt-4">
            <a href="{{ route('salone.index') }}" class="btn btn-secondary">Reset Filters</a>
        </div>
    </div>
</form>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th> 
                <th>Description</th>
                <th>Manager</th>
                <th>Address</th>
                <th>Stylists</th>
                <th>Contact Phone</th>
                <th>Contact Email</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($salone as $modeldata)
            <tr>
                <td>{{ $modeldata->name }}</td>
                <td>{{ $modeldata->description }}</td>
                <td>
                    @foreach($modeldata->salonManager as $manager)
                        {{ $manager->first_name }} {{ $manager->last_name }}
                    @endforeach
                </td>

                <td>
                    {{$modeldata->salonAddress->city}} {{$modeldata->salonAddress->street}} {{$modeldata->salonAddress->number}} 
                </td>
                <td>
                    @foreach($modeldata->salonStylist as $stylist)
                        {{ $stylist->first_name }} {{ $stylist->last_name }} {{', '}}
                    @endforeach
                </td>
                <td>{{ $modeldata->contact_phone }}</td>
                <td>{{ $modeldata->contact_email }}</td>
                <td>
                    @if($layout=='layouts.app'||$layout=='layouts.manager')
                    <a href="{{ route('salone.edit', $modeldata->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    @endif
                    <a href="{{ route('salone.show', $modeldata->id) }}" class="btn btn-info btn-sm">Show</a>
                    @if($layout=='layouts.app')
                    <form action="{{ route('salone.destroy', $modeldata->id) }}" method="post" style="display: inline-block;">
                        @csrf
                        @method('delete')
                        <button type="submit" class="btn btn-danger btn-sm mt-2">Delete</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
