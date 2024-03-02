<?php

namespace App\Http\Controllers;

use App\Models\Filter;
use App\Models\Service;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $filters = Filter::all();
        $service = Service::whereIn('id', $filters->pluck('service_id'))->pluck('name', 'id');

        return view('filter.filter', compact('filters','service'));
    }

    public function create()
    {
        $services=Service::all();
        return view('filter.create', compact('services'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'filter_name' => 'required|max:255',
            'service_id' => 'required|exists:services,id',
        ]);

        Filter::create([
            'filter_name' => $request->filter_name,
            'service_id' => $request->service_id,
        ]);

        return redirect()->route('filter.index');
    }

    public function show($id)
    {
        $filter = Filter::findOrFail($id);
        $service=Service::find($filter->service_id);
        return view('filter.show', compact('filter','service'));
    }

    public function edit($id)
    {
        $filter = Filter::findOrFail($id);
        $services=Service::all();
        return view('filter.edit', compact('filter','services'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'filter_name' => 'required|max:255',
            'service_id' => 'required|exists:services,id',
        ]);

        $filter = Filter::findOrFail($id);
        $filter->update([
            'filter_name' => $request->filter_name,
            'service_id' => $request->service_id,
        ]);

        return redirect()->route('filter.index');
    }

    public function destroy($id)
    {
        $filter = Filter::findOrFail($id);
        $filter->delete();
        return redirect()->route('filter.index');
    }
}
