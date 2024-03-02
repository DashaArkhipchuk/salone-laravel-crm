<?php

namespace App\Http\Controllers;

use App\Models\Salone;
use App\Models\Service;
use App\Models\Stylist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StylistsController extends Controller
{
    public function getUserLayout($userRole){
        if ($userRole == 1) {
            $layout = 'layouts.app';
           
        } else if ($userRole == 2) {
            $layout = 'layouts.manager';
        }
        return $layout;
    }
    public function index()
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $stylists = Stylist::with('salons')->get();
        return view('stylist.stylist', ['stylists' => $stylists, 'layout' => $layout]);
    }

    public function create()
    {
        $allSalons = Salone::all();
        $allUsers=User::all();
        return view('stylist.create', ['allSalons' => $allSalons, 'allUsers' => $allUsers]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'contact_phone' => 'nullable|max:20',
            'contact_email' => 'nullable|email|max:100',
            'user_id'=> 'required|exists:users,id',
        ]);

        $stylist=Stylist::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'user_id'=>$request->user_id
        ]);

        $selectedSalons = $request->input('salons', []);
        $stylist->salons()->attach($selectedSalons);

        return redirect()->route('stylist.index');
    }

    public function show($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $stylist = Stylist::findOrFail($id);
        return view('stylist.show', ['stylist' => $stylist, 'layout' => $layout]);
    }

    public function edit($id)
    {
        $stylist = Stylist::findOrFail($id);
        $allSalons = Salone::all();
        $allUsers=User::all();
        $currentSalons = $stylist->salons->pluck('id')->toArray();
        return view('stylist.edit', ['stylist' => $stylist, 'allSalons' => $allSalons, 'currentSalons' => $currentSalons, 'allUsers' => $allUsers]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'contact_phone' => 'nullable|max:20',
            'contact_email' => 'nullable|email|max:100',
            'user_id'=> 'required|exists:users,id',
        ]);

        $stylist = Stylist::findOrFail($id);
        $stylist->first_name=$request->first_name;
        $stylist->last_name=$request->last_name;
        $stylist->contact_phone=$request->contact_phone;
        $stylist->contact_email=$request->contact_email;
        $stylist->user_id=$request->user_id;
        $stylist->save();

        $selectedSalons = $request->input('salons', []);
        $stylist->salons()->sync($selectedSalons);

        return redirect()->route('stylist.index');
    }

    public function destroy($id)
    {
        $stylist = Stylist::findOrFail($id);
        $stylist->delete();
        return redirect()->route('stylist.index');
    }

    public function GetAvailableServices($id)
    {
        $stylist = Stylist::findOrFail($id);
        //dd($stylist);
        $services = Service::whereHas('prices', function ($query) use ($stylist) {
            $query->where('stylist_id', $stylist->id);
        })->get();
        //dd($services);
        return response()->json($services);
    }
}
