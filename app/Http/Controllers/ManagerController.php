<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Salone;
use App\Models\User;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    public function index()
    {
        $managers = Manager::with('salons')->get();
        return view('manager.manager', ['managers' => $managers]);
    }

    public function create()
    {
        $allSalons = Salone::all();
        $allUsers=User::all();
        return view('manager.create', ['allSalons' => $allSalons, 'allUsers' => $allUsers]);
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

        $manager = Manager::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'user_id'=>$request->user_id
        ]);

        $selectedSalons = $request->input('salons', []);
        $manager->salons()->attach($selectedSalons);

        return redirect()->route('manager.index');
    }

    public function show($id)
    {
        $manager = Manager::findOrFail($id);
        return view('manager.show', ['manager' => $manager]);
    }

    public function edit($id)
    {
        $manager = Manager::findOrFail($id);
        $allSalons = Salone::all();
        $allUsers=User::all();
        $currentSalons = $manager->salons->pluck('id')->toArray();
        return view('manager.edit', ['manager' => $manager, 'allSalons' => $allSalons, 'currentSalons' => $currentSalons, 'allUsers' => $allUsers]);
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

        $manager = Manager::findOrFail($id);
        $manager->first_name = $request->first_name;
        $manager->last_name = $request->last_name;
        $manager->contact_phone = $request->contact_phone;
        $manager->contact_email = $request->contact_email;
        $manager->user_id = $request->user_id;
        $manager->save();

        $selectedSalons = $request->input('salons', []);
        $manager->salons()->sync($selectedSalons);

        return redirect()->route('manager.index');
    }

    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);
        $manager->delete();
        return redirect()->route('manager.index');
    }
}
