<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function index()
    {
        $currencies = Currency::all();
        return view('currency.currency', ['currencies' => $currencies]);
    }

    public function create()
    {
        return view('currency.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'value' => 'required|numeric',
        ]);

        Currency::create([
            'name' => $request->name,
            'code' => $request->code,
            'value' => $request->value,
        ]);

        return redirect()->route('currency.index');
    }

    public function show($id)
    {
        $currency = Currency::findOrFail($id);
        return view('currency.show', ['currency' => $currency]);
    }

    public function edit($id)
    {
        $currency = Currency::findOrFail($id);
        return view('currency.edit', ['currency' => $currency]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|max:10',
            'value' => 'required|numeric',
        ]);

        $currency = Currency::findOrFail($id);
        $currency->update([
            'name' => $request->name,
            'code' => $request->code,
            'value' => $request->value,
        ]);

        return redirect()->route('currency.index');
    }

    public function destroy($id)
    {
        $currency = Currency::findOrFail($id);
        $currency->delete();
        return redirect()->route('currency.index');
    }
}
