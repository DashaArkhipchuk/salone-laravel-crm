<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Salone;
use Illuminate\Http\Request;

class AddressController extends Controller
{

public function index()
{
    
    $addresses = Address::with('salon')->get();
    return view('address.address', ['addresses' => $addresses]);
}

public function create()
{
    $salons = Salone::All();
    return view('address.create', ['salons' => $salons]);
}

public function store(Request $request)
{
    $request->validate([
        'salon_id' => 'required|min:1',
        'region' => 'required|max:100',
        'district' => 'required|max:100',
        'city' => 'required|max:100',
        'street' => 'required|max:250',
    ]);

    Address::create([
        'salon_id' => $request->salon_id,
        'region' => $request->region,
        'district' => $request->district,
        'city' => $request->city,
        'street' => $request->street,
    ]);

    return redirect()->route('address.index');
}

public function show($id)
{
    $address = Address::find($id);
    //dd($addresses->salone_id);
    return view('address.show', ['address' => $address]);
}

public function edit($id)
{
    $salons = Salone::pluck('name', 'id');
    $address = Address::find($id);
    return view('address.edit', ['address' => $address, 'salons' => $salons]);
}

public function update(Request $request, $id)
{
    //dd($request->salon_id);
    $request->validate([
        'salon_id' => 'required|min:1',
        'region' => 'required|max:100',
        'district' => 'required|max:100',
        'city' => 'required|max:100',
        'street' => 'required|max:250',
    ]);

    $address = Address::find($id);
    
    $address->salon_id = $request->salon_id;
    //dd($request->salon_id);
    $address->region = $request->region;
    $address->district = $request->district;
    $address->city = $request->city;
    $address->street = $request->street;
    $address->save();

    return redirect()->route('address.index');
}

public function destroy($id)
{
    $address = Address::find($id);
    $address->delete();
    return redirect()->route('address.index');
}

}
