<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.role', ['roles'=>$roles]);
    }
    public function create()
    {
        return view('role.create');
    }

    public function store(Request $request)
    {
        //dd($request);

        $request->validate([
            'name'=>'required|max:100',

        ]);

        $salone = new Role();
        $salone::create([
            'name'=>$request->name
        ]);
        return redirect()->route('role.index');
    }

    public function show(string $id)
    {
        $role=Role::find($id);
        return view('role.show',['role'=>$role]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role=Role::find($id);
        return view('role.edit',['role'=>$role]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name'=>'required|max:100',
        ]);
        $salone=Role::find($id);
        $salone->name=$request->name;
        
        $salone->save();
        return redirect()->route('role.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salone=Role::find($id);
        $salone->delete();
        return redirect()->route('role.index');
    }

}
