<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Price;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PriceController extends Controller
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

    public function index(Request $request)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);

        $query = Price::with('currency', 'stylist', 'service');

        $value_from = $request->input('value_from', null);
        $value_to = $request->input('value_to', null);

        // Apply additional filters based on user input
        if ($request->filled('service_id')) {
            $query->where('service_id', $request->input('service_id'));
        }

        if ($request->filled('stylist_id')) {
            $query->where('stylist_id', $request->input('stylist_id'));
        }

        if ($request->filled('currency_id')) {
            $query->where('currency_id', $request->input('currency_id'));
        }

        if ($request->filled('value_from')) {
            $query->where('value', '>=', $request->input('value_from'));
        }

        if ($request->filled('value_to')) {
            $query->where('value', '<=', $request->input('value_to'));
        }

        if ($layout == 'layouts.stylist') {
            $stylist = Stylist::where('user_id', Auth::user()->id)->first();
            if ($stylist) {
                 $query->where('stylist_id', $stylist->id);
            }
            $services = Service::whereHas('prices', function ($query) use ($stylist) {
                $query->where('stylist_id', $stylist->id);
            })->get();
        } else {
            $services = Service::all();
        }

        $prices = $query->get();
        $stylists = Stylist::all();

        return view('price.price', [
            'prices' => $prices,
            'services' => $services,
            'stylists' => $stylists,
            'currencies' => Currency::all(),
            'value_from' => $value_from,
            'value_to' => $value_to,
            'layout' => $layout,
        ])->with([
                    'service_id' => $request->input('service_id'),
                    'stylist_id' => $request->input('stylist_id'),
                    'currency_id' => $request->input('currency_id'),
                ]);
    }

    public function create()
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $currencies = Currency::all();
        if ($layout == 'layouts.stylist') {
            $stylists = Stylist::where('user_id', Auth::user()->id)->first();
        } else {
            $stylists = Stylist::all();

        }
        $services = Service::all();
        return view('price.create', ['currencies' => $currencies, 'stylists' => $stylists, 'services' => $services, 'layout' => $layout]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'stylist_id' => 'required|exists:stylists,id',
            'currency_id' => 'required|exists:currencies,id',
            'value' => 'required|numeric',
        ]);

        Price::create([
            'service_id' => $request->service_id,
            'stylist_id' => $request->stylist_id,
            'currency_id' => $request->currency_id,
            'value' => $request->value,
        ]);

        return redirect()->route('price.index');
    }

    public function show($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $price = Price::findOrFail($id);
        return view('price.show', ['price' => $price, 'layout' => $layout]);
    }

    public function edit($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $price = Price::findOrFail($id);
        $currencies = Currency::all();
        if ($layout == 'layouts.stylist') {
            $stylists = Stylist::where('user_id', Auth::user()->id)->first();
        } else {
            $stylists = Stylist::all();

        }
        $services = Service::all();
        return view('price.edit', ['price' => $price, 'currencies' => $currencies, 'stylists' => $stylists, 'services' => $services, 'layout' => $layout]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'service_id' => 'required|exists:services,id',
            'stylist_id' => 'required|exists:stylists,id',
            'currency_id' => 'required|exists:currencies,id',
            'value' => 'required|numeric',
        ]);

        $price = Price::findOrFail($id);
        $price->service_id = $request->service_id;
        $price->stylist_id = $request->stylist_id;
        $price->currency_id = $request->currency_id;
        $price->value = $request->value;
        $price->save();

        return redirect()->route('price.index');
    }

    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();
        return redirect()->route('price.index');
    }
}
