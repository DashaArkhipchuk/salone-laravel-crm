<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Salone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Salons_managers;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        if (Auth::check()) {
            // Redirect based on the user's role
            if (Auth::user()->role_id == 1) {
                return redirect('/admin/home');
            } elseif (Auth::user()->role_id == 2) {
                return redirect('/manager/home');
            } elseif (Auth::user()->role_id == 3) {
                return redirect('/stylist/home');
            } else if (Auth::user()->role_id == 4) {
                return redirect('/customer/home');
            }
        }

        return view('home');
    }
    public function admin()
    {
        $users = User::all();
        //$salons=Salone::all();
        $salons = Salone::with('salonManager')->get();
        //dd($salons->salonManager());
        //dd($salons);
        return view('home', ['users' => $users, 'salons' => $salons]);
    }

    public function manager()
    {
        $users = User::all();
        //$salons=Salone::all();
        $salons = Salone::with('salonManager')->get();
        //dd($salons->salonManager());
        //dd($salons);
        return view('managerlayout.home', ['users' => $users, 'salons' => $salons]);
    }

    public function stylist()
    {
        //$users=User::all();
        //$salons=Salone::all();
        //$salons=Salone::with('salonManager')->get();\
        $currentDate = Carbon::now();
        $appointments = Appointment::with(['salon', 'service', 'customer', 'stylist', 'schedule'])
            ->where('stylist_id', Auth::user()->id)
            ->whereHas('schedule', function ($query) use ($currentDate) {
                // Check if the schedule date is greater than or equal to the current date
                $query->where('date', '>=', $currentDate->toDateString());
                //$query->where('start_hour', '>=', $currentDate->toTimeString());
            })->get();
        //dd($salons->salonManager());
        //dd($salons);
        return view('stylistlayout.home', ['appointments' => $appointments]);
    }

    public function customer()
    {
        $currentDate=Carbon::now();
        $customer=Customer::where('user_id', Auth::user()->id)->first();
        $appointments = Appointment::with(['salon', 'service', 'customer', 'stylist', 'schedule'])
                ->where('customer_id', $customer->id)
                ->whereHas('schedule', function ($query) use ($currentDate) {
                    // Check if the schedule date is greater than or equal to the current date
                    $query->where('date', '>=', $currentDate->toDateString());
                })->get();

        return view('customerlayout.home', ['appointments' => $appointments]);

        
    }
}
