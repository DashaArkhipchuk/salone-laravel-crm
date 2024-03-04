@extends($layout)

@section('content')
    <div class="m-5">
        <h1>Prices</h1>

        @if($layout == 'layouts.app'||$layout == 'layouts.stylist')
        <a href="{{ route('price.create') }}" class="btn btn-primary mb-3">Create Price</a>
        @endif

        <form action="{{ route('price.index') }}" method="get" class="mb-3">
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <label for="service_id">Service:</label>
                    <select name="service_id" class="form-control">
                        <option value="">Select Service</option>
                        @foreach($services as $service)
                            <option value="{{ $service->id }}" {{ $service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
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
                    <label for="currency_id">Currency:</label>
                    <select name="currency_id" class="form-control">
                        <option value="">Select Currency</option>
                        @foreach($currencies as $currency)
                            <option value="{{ $currency->id }}" {{ $currency_id == $currency->id ? 'selected' : '' }}>{{ $currency->code }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-3">
    <label for="value_from">Value From:</label>
    <input type="number" step="0.01" name="value_from" class="form-control" value="{{ $value_from }}">
</div>

<div class="col-md-3">
    <label for="value_to">Value To:</label>
    <input type="number" step="0.01" name="value_to" class="form-control" value="{{ $value_to }}">
</div>

                <div class="col-md-3 mt-4">
                    <button type="submit" class="btn btn-primary">Apply Filters</button>
                </div>

                <div class="col-md-3 mt-4">
                    <a href="{{ route('price.index') }}" class="btn btn-secondary">Reset Filters</a>
                </div>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr>
                    <th>Service</th>
                    <th>Stylist</th>
                    <th>Currency</th>
                    <th>Value</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prices as $price)
                    <tr>
                        <td>{{ $price->service->name }}</td>
                        <td>{{ $price->stylist->first_name }} {{ $price->stylist->last_name }}</td>
                        <td>{{ $price->currency->code }}</td>
                        <td>{{ $price->value }}</td>
                        <td>
                            @if($layout=='layouts.app'||$layout=='layouts.stylist')
                            <a href="{{ route('price.edit', $price->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            @endif
                            <a href="{{ route('price.show', $price->id) }}" class="btn btn-info btn-sm">Show</a>

                            @if($layout=='layouts.app' || $layout=='layouts.stylist')
                            <form action="{{ route('price.destroy', $price->id) }}" method="post" style="display: inline-block;">
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
