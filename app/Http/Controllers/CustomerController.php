<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
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
        $customers = Customer::all();
        return view('customer.customer', ['customers' => $customers, 'layout' => $layout]);
    }

    public function create()
    {
        $userRole=Auth::user()->role_id;
        $allUsers=User::all();
        $layout = $this->getUserLayout($userRole);
        return view('customer.create', ['layout' => $layout, 'allUsers' => $allUsers]);
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

        Customer::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'contact_phone' => $request->contact_phone,
            'contact_email' => $request->contact_email,
            'user_id'=>$request->user_id
        ]);

        return redirect()->route('customer.index');
    }

    public function show($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $manager = Customer::findOrFail($id);
        return view('customer.show', ['customer' => $manager, 'layout' => $layout]);
    }

    public function edit($id)
    {
        $userRole=Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $manager = Customer::findOrFail($id);
        $allUsers=User::all();
        return view('customer.edit', ['customer' => $manager, 'layout' => $layout, 'allUsers' => $allUsers]);
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

        $manager = Customer::findOrFail($id);
        $manager->first_name = $request->first_name;
        $manager->last_name = $request->last_name;
        $manager->contact_phone = $request->contact_phone;
        $manager->contact_email = $request->contact_email;
        $manager->user_id = $request->user_id;
        $manager->save();

        return redirect()->route('customer.index');
    }

    public function destroy($id)
    {
        $manager = Customer::findOrFail($id);
        $manager->delete();
        return redirect()->route('customer.index');
    }
}
