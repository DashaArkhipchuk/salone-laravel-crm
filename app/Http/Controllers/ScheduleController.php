<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use App\Models\Salone;
use App\Models\Schedule;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
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
    public function index(Request $request)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);

        $currentDate = Carbon::now();

        // Initialize the query
        $query = Schedule::with('salon', 'stylist');

        // If the user is a manager, filter by the salons managed by the manager
        if ($layout == 'layouts.manager') {
            $manager = Manager::where('user_id', Auth::user()->id)->first();

            if ($manager) {
                $salonIds = $manager->salons()->pluck('salons.id')->toArray();
                $salons = $manager->salons()->get();
                $query->whereIn('salon_id', $salonIds);
            }
        } else if ($layout == 'layouts.stylist') {
            $stylist = Stylist::where('user_id', Auth::user()->id)->first();

            if ($stylist) {
                $query->where('stylist_id', $stylist->id)
                    ->where('date', '>=', $currentDate->toDateString());
            }
        }

        // Apply additional filters based on user input
        if ($request->filled('salon_id')) {
            //dd($request->input('salon_id'));
            $query->where('salon_id', $request->input('salon_id'));
        }

        if ($request->filled('stylist_id')) {
            //dd($request->input('stylist_id'));
            $query->where('stylist_id', $request->input('stylist_id'));
        }

        if ($request->filled('start_date')) {
            //dd($request->input('start_date'));
            $startDateTime = $request->input('start_date') . ' 00:00:00';
            $query->where('date', '>=', $startDateTime);
        }

        if ($request->filled('end_date')) {
            //dd($request->input('end_date'));
            $endDateTime = $request->input('end_date') . ' 23:59:59';
            $query->where('date', '<=', $endDateTime);
        }

        // Execute the query
        $schedules = $query->get();
        if (!isset($salons)) {
            $salons = Salone::all();
        }
        $stylists = Stylist::all();

        return view('schedule.schedule', [
            'schedules' => $schedules,
            'layout' => $layout,
            'salons' => $salons,
            'stylists' => $stylists
        ])->with([
                    'salon_id' => $request->input('salon_id'),
                    'stylist_id' => $request->input('stylist_id'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                ]);
    }

    public function create()
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        if ($layout == 'layouts.stylist') {
            $stylist = Stylist::where('user_id', Auth::user()->id)->first();
            if ($stylist) {
                $salons = $stylist->salons;
                $stylists= $stylist;
            }
        } else {
            $salons = Salone::all();
            $stylists = Stylist::all();
        }

        return view('schedule.create', compact('salons', 'stylists', 'layout'));
    }

    public function store(Request $request)
    {
        //dd($request->salon_id);
        //dd($request->stylist_id);
        //dd($request->date);
        //dd($request->start_hour);
        //dd($request->end_hour);
        $request->validate([
            'salon_id' => 'required',
            'stylist_id' => 'required',
            'date' => 'required|date',
            'start_hour' => 'required|integer',
            'end_hour' => 'required|integer',
        ]);

        Schedule::create($request->all());

        return redirect()->route('schedule.index');
    }

    public function show($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $schedule = Schedule::findOrFail($id);

        return view('schedule.show', ['schedule' => $schedule, 'layout' => $layout]);
    }

    public function edit($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $schedule = Schedule::findOrFail($id);
        if ($layout == 'layouts.stylist') {
            $stylist = Stylist::where('user_id', Auth::user()->id)->first();
            if ($stylist) {
                $salons = $stylist->salons;
                $stylists= $stylist;
            }
        } else{
            $salons = Salone::all();
            $stylists = Stylist::all();

        }

        return view('schedule.edit', compact('schedule', 'salons', 'stylists', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'salon_id' => 'required',
            'stylist_id' => 'required',
            'date' => 'required|date',
            'start_hour' => 'required|integer',
            'end_hour' => 'required|integer',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->salon_id = $request->salon_id;
        $schedule->stylist_id = $request->stylist_id;
        $schedule->date = $request->date;
        $schedule->start_hour = $request->start_hour;
        $schedule->end_hour = $request->end_hour;
        $schedule->save();

        return redirect()->route('schedule.index');
    }

    public function destroy($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();

        return redirect()->route('schedule.index');
    }


    public function getScheduleDetails($scheduleId)
    {
        $schedule = Schedule::find($scheduleId);
        return response()->json(['schedule' => $schedule, 'salon' => $schedule->salon, 'stylist' => $schedule->stylist]);
    }
}
