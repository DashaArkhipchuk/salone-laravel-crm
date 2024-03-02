<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Price;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function getUserLayout($userRole)
    {
        if ($userRole == 1) {
            $layout = 'layouts.app';
        } else if ($userRole == 2) {
            $layout = 'layouts.manager';
        } else if ($userRole == 3) {
            $layout = 'layouts.stylist';
        } else if ($userRole == 4) {
            $layout = 'layouts.customer';
        }
        return $layout;
    }
    public function index()
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $services = Service::all();
        return view('service.service', ['services' => $services, 'layout' => $layout]);
    }

    public function create()
    {
        $currencies = Currency::all();
        return view('service.create', ['currencies' => $currencies]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',

        ]);

        $service = Service::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);


        return redirect()->route('service.index');
    }

    public function show($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $service = Service::findOrFail($id);
        return view('service.show', ['service' => $service, 'layout' => $layout]);
    }

    public function edit($id)
    {

        $service = Service::findOrFail($id);
        return view('service.edit', ['service' => $service]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable',
        ]);

        $service = Service::findOrFail($id);
        $service->name = $request->name;
        $service->description = $request->description;

        $service->save();

        return redirect()->route('service.index');
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->route('service.index');
    }

    public function getServicesFrontPage()
    {
        $services = Service::all()->take(6);
        return view('services', ['services' => $services]);
    }
}
