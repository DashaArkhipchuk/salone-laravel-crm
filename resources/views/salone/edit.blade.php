@extends($layout)

@section('content')
<div class="container">
    <h1>Edit instance</h1>

    <form action="{{ route('salone.update', $salone->id) }}" method="post">
        @csrf
        @method('PUT')

        @if($layout!='layouts.app')
        <div class="form-group" hidden>
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $salone->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endif
        @if ($layout=='layouts.app')
        <div class="form-group" >
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" class="form-control" value="{{ $salone->name }}">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @endif

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control">{{$salone->description}}</textarea>
            @error('description')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        @if($layout!='layouts.app')
        <div class="form-group" hidden>
            <label for="contact_phone">Contact Phone:</label>
            <input type="text" id="contact_phone" name="contact_phone" class="form-control" value="{{ $salone->contact_phone }}">
            @error('contact_phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        

        <div class="form-group" hidden>
            <label for="contact_email">Contact Email:</label>
            <input type="email" id="contact_email" name="contact_email" class="form-control" value="{{ $salone->contact_email }}"> 
            @error('contact_email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <h2 hidden>Address Information</h2>

        <div class="form-group" hidden>
            <label for="region">Region:</label>
            <input type="text" name="region" id="region" value="{{ $salone->salonAddress->region }}" class="form-control">
            @error('region')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" hidden>
            <label for="district">District:</label>
            <input type="text" name="district" id="district" value="{{ $salone->salonAddress->district }}" class="form-control">
            @error('district')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" hidden>
            <label for="city">City:</label>
            <input type="text" name="city" id="city" value="{{ $salone->salonAddress->city }}" class="form-control">
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" hidden>
            <label for="street">Street:</label>
            <input type="text" name="street" id="street" value="{{ $salone->salonAddress->street }}" class="form-control">
            @error('street')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <h2 hidden>Attach managers </h2>

        <div class="form-group" hidden>
            <label for="managers">Managers:</label>
            <select name="managers[]" id="managers" class="form-control" multiple>
                @foreach($allManagers as $manager)
                    <option value="{{ $manager->id }}" {{ in_array($manager->id, $currentManagers) ? 'selected' : '' }}>
                        {{ $manager->first_name }} {{ $manager->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        @endif

        @if($layout=='layouts.app')
        <div class="form-group" >
            <label for="contact_phone">Contact Phone:</label>
            <input type="text" id="contact_phone" name="contact_phone" class="form-control" value="{{ $salone->contact_phone }}">
            @error('contact_phone')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        

        <div class="form-group" >
            <label for="contact_email">Contact Email:</label>
            <input type="email" id="contact_email" name="contact_email" class="form-control" value="{{ $salone->contact_email }}"> 
            @error('contact_email')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <h2>Address Information</h2>

        <div class="form-group">
            <label for="region">Region:</label>
            <input type="text" name="region" id="region" value="{{ $salone->salonAddress->region }}" class="form-control">
            @error('region')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="district">District:</label>
            <input type="text" name="district" id="district" value="{{ $salone->salonAddress->district }}" class="form-control">
            @error('district')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" >
            <label for="city">City:</label>
            <input type="text" name="city" id="city" value="{{ $salone->salonAddress->city }}" class="form-control">
            @error('city')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group" >
            <label for="street">Street:</label>
            <input type="text" name="street" id="street" value="{{ $salone->salonAddress->street }}" class="form-control">
            @error('street')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>


        <h2>Attach managers </h2>

        <div class="form-group">
            <label for="managers">Managers:</label>
            <select name="managers[]" id="managers" class="form-control" multiple>
                @foreach($allManagers as $manager)
                    <option value="{{ $manager->id }}" {{ in_array($manager->id, $currentManagers) ? 'selected' : '' }}>
                        {{ $manager->first_name }} {{ $manager->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        @endif

        <h2>Attach stylists</h2>

        <div class="form-group">
            <label for="stylists">Stylists:</label>
            <select name="stylists[]" id="stylists" class="form-control" multiple>
                @foreach($allStylists as $stylist)
                    <option value="{{ $stylist->id }}" {{ in_array($stylist->id, $currentStylists) ? 'selected' : '' }}>
                        {{ $stylist->first_name }} {{ $stylist->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Edit</button>
    </form>
</div>
@endsection
