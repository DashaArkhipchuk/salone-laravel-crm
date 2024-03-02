<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Manager;
use App\Models\Salone;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaloneController extends Controller
{
    public function getUserLayout($userRole)
    {
        if ($userRole == 1) {
            $layout = 'layouts.app';
        } else if ($userRole == 2) {
            $layout = 'layouts.manager';
        } else if ($userRole == 3) {
            $layout = 'layouts.stylist';
        }
        return $layout;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);

        $query = Salone::with('salonManager', 'salonStylist');

        if ($userRole == 2) {
            $manager = Manager::where('user_id', Auth::user()->id)->first();

            if ($manager) {
                $query->whereHas('salonManager', function ($q) use ($manager) {
                    $q->where('manager_id', $manager->id);
                });
            }
        } elseif ($userRole == 3) {
            $stylist = Stylist::where('user_id', Auth::user()->id)->first();

            if ($stylist) {
                $query->whereHas('salonStylist', function ($q) use ($stylist) {
                    $q->where('stylist_id', $stylist->id);
                });
            }
        }

        if ($request->filled('city')) {
            $query->whereHas('salonAddress', function ($q) use ($request) {
                $q->where('city', $request->input('city'));
            });
        }

        if ($request->filled('stylist_id')) {
            $query->whereHas('salonStylist', function ($q) use ($request) {
                $q->where('stylist_id', $request->input('stylist_id'));
            });
        }
    

        $salons = $query->get();

        $cities = Address::distinct('city')->pluck('city');

        $stylists = Stylist::when($salons->isNotEmpty(), function ($query) use ($salons) {
            $query->whereHas('salons', function ($q) use ($salons) {
                $q->whereIn('salon_id', $salons->pluck('id')->toArray());
            });
        })->get();

        return view('salone.salone', [
            'salone' => $salons,
            'cities'=> $cities,
            'stylists' => $stylists,
            'layout' => $layout,
        ])->with([
                    'city' => $request->input('city'),
                    'district' => $request->input('district'),
                    'stylist_id' => $request->input('stylist_id'),
                ]);
    }
    public function create()
    {
        $managers = Manager::all();
        $allStylists = Stylist::all();
        return view('salone.create', ['managers' => $managers, 'allStylists' => $allStylists]);
    }

    public function store(Request $request)
    {
        //dd($request);

        $request->validate([
            'name' => 'required|max:250',
            'description' => 'max:250',
            'contact_phone' => 'max:20',
            'contact_email' => 'required|max:100|email',
            'region' => 'max:100',
            'district' => 'max:100',
            'city' => 'max:100',
            'street' => 'max:250'
        ]);

        // Create a new Salon
        $salon = Salone::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'contact_phone' => $request->input('contact_phone'),
            'contact_email' => $request->input('contact_email'),
        ]);

        // Find or create the Address
        $address = Address::firstOrCreate(
            [
                'region' => $request->input('region'),
                'district' => $request->input('district'),
                'city' => $request->input('city'),
                'street' => $request->input('street'),
            ],
            ['salon_id' => null] // Set salon_id to null initially
        );

        //dd($address);
        //dd($salon);
        // Check if the address has a salon association
        if ($address->salon_id !== null) {
            //dd('here');
            // If it has a salon association, display an error message
            $salon->delete(); // Rollback the salon creation
            return redirect()->back()->with('error', 'Address is already associated with a salon. Please choose a different address or delete the existing association before creating a new one.');
        }
        //dd($address);
        //dd($salon);
        // Associate the address with the salon
        $address->salon_id = $salon->id;
        $address->save();

        // Attach selected managers to the salon, if any are selected
        $selectedManagers = $request->input('managers', []);

        if (!empty($selectedManagers)) {
            $salon->salonManager()->attach($selectedManagers);
        }

        $selectedStylists = $request->input('stylists', []);

        if (!empty($selectedStylists)) {
            $salon->salonStylist()->attach($selectedStylists);
        }


        // Redirect or perform other actions after successful submission
        return redirect()->route('salone.index');
    }

    public function show(string $id)
    {
        $userRole = Auth::user()->role_id;
        if ($userRole == 1) {
            $layout = 'layouts.app';
        } else if ($userRole == 2) {
            $layout = 'layouts.manager';
        } else if ($userRole == 3) {
            $layout = 'layouts.stylist';
        } else if ($userRole == 4) {
            $layout = 'layouts.customer';
        }
        $salone = Salone::find($id);
        return view('salone.show', ['salone' => $salone, 'layout' => $layout]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

        $userRole = Auth::user()->role_id;
        if ($userRole == 1) {
            $layout = 'layouts.app';
        } else if ($userRole == 2) {
            $layout = 'layouts.manager';
        }

        $salone = Salone::find($id);

        $allManagers = Manager::all();
        $currentManagers = $salone->salonManager()->pluck('managers.id')->toArray();

        $allStylists = Stylist::all();
        $currentStylists = $salone->salonStylist()->pluck('stylists.id')->toArray();

        return view('salone.edit', ['salone' => $salone, 'allManagers' => $allManagers, 'currentManagers' => $currentManagers, 'allStylists' => $allStylists, 'currentStylists' => $currentStylists, 'layout' => $layout]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|max:250',
            'description' => 'max:250',
            'contact_phone' => 'max:20',
            'contact_email' => 'required|max:100|email',
            'region' => 'max:100',
            'district' => 'max:100',
            'city' => 'max:100',
            'street' => 'max:250'
        ]);
        $salon = Salone::findOrFail($id);

        // Update Salon information
        $salon->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'contact_phone' => $request->input('contact_phone'),
            'contact_email' => $request->input('contact_email'),
        ]);

        // Find or create the Address
        $address = Address::updateOrCreate(
            ['salon_id' => $salon->id],
            [
                'region' => $request->input('region'),
                'district' => $request->input('district'),
                'city' => $request->input('city'),
                'street' => $request->input('street'),
            ]
        );

        $selectedManagers = $request->input('managers', []);
        $salon->salonManager()->sync($selectedManagers);

        $selectedStylists = $request->input('stylists', []);
        $salon->salonStylist()->sync($selectedStylists);

        return redirect()->route('salone.index')->with('success', 'Salon and address updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salone = Salone::find($id);
        $salone->delete();
        return redirect()->route('salone.index');
    }

    public function getAvailableStylists($salonId)
    {

        $salon = Salone::find($salonId);
        $stylists = $salon->salonStylist;
        return response()->json($stylists);
    }

    public function getSalonsFrontPage()
    {

        $salons = Salone::all()->take(7);
        return view('salons', compact('salons'));
    }

}
