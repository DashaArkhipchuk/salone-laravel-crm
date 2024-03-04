<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Customer;
use App\Models\Salone;
use App\Models\Schedule;
use App\Models\Service;
use App\Models\Stylist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
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

        $currentDate = Carbon::now();
        if ($layout == 'layouts.stylist') {
            $stylist = Stylist::where('user_id', Auth::user()->id)->first();
            if ($stylist) {
                $query = Appointment::with(['salon', 'service', 'customer', 'stylist', 'schedule'])
                    ->where('stylist_id', $stylist->id)
                    ->whereHas('schedule', function ($query) use ($currentDate) {
                        // Check if the schedule date is greater than or equal to the current date
                        $query->where('date', '>=', $currentDate->toDateString());
                        //$query->where('start_hour', '>=', $currentDate->toTimeString());
                    });
            }
        } else if ($layout == 'layouts.customer') {
            $customer=Customer::where('user_id', Auth::user()->id)->first();
            $query = Appointment::with(['salon', 'service', 'customer', 'stylist', 'schedule'])
                ->where('customer_id', $customer->id)
                ->whereHas('schedule', function ($query) use ($currentDate) {
                    // Check if the schedule date is greater than or equal to the current date
                    $query->where('date', '>=', $currentDate->toDateString());
                });
        } else {
            // Initialize the query
            $query = Appointment::with(['salon', 'service', 'customer', 'stylist', 'schedule']);
        }



        // Apply additional filters based on user input
        if ($request->filled('salon_id')) {
            $query->whereHas('salon', function ($q) use ($request) {
                $q->where('id', $request->input('salon_id'));
            });
        }

        if ($request->filled('stylist_id')) {
            $query->where('stylist_id', $request->input('stylist_id'));
        }

        if ($request->filled('service_id')) {
            $query->where('service_id', $request->input('service_id'));
        }

        if ($request->filled('customer_id')) {
            $query->where('customer_id', $request->input('customer_id'));
        }

        if ($request->filled('start_date')) {
            $startDateTime = $request->input('start_date') . ' 00:00:00';
            $query->whereHas('schedule', function ($q) use ($startDateTime) {
                $q->where('date', '>=', $startDateTime);
            });
        }

        if ($request->filled('end_date')) {
            $endDateTime = $request->input('end_date') . ' 23:59:59';
            $query->whereHas('schedule', function ($q) use ($endDateTime) {
                $q->where('date', '<=', $endDateTime);
            });
        }

        // Execute the query
        $appointments = $query->get();


        $salons = Salone::all();
        $stylists = Stylist::all();
        $services = Service::all();
        $customers = Customer::all();

        return view('appointment.appointment', [
            'appointments' => $appointments,
            'layout' => $layout,
            'salons' => $salons,
            'stylists' => $stylists,
            'services' => $services,
            'customers' => $customers
        ])->with([
                    'salon_id' => $request->input('salon_id'),
                    'stylist_id' => $request->input('stylist_id'),
                    'service_id' => $request->input('service_id'),
                    'customer_id' => $request->input('customer_id'),
                    'start_date' => $request->input('start_date'),
                    'end_date' => $request->input('end_date'),
                ]);
    }

    public function create()
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        if ($layout == 'layouts.customer') {
            $customers = Customer::where('user_id', Auth::user()->id)->first();
        } else {
            $customers = Customer::all();
        }
        $services = Service::all();
        $salons = Salone::all();
        $existingAppointments = Appointment::pluck('schedule_id')->all();
        $availableSchedules = Schedule::whereNotIn('id', $existingAppointments)->get();

        return view('appointment.create', compact('customers', 'services', 'salons', 'availableSchedules', 'layout'));
    }

    public function store(Request $request)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $request->validate([
            'customer_id' => 'required',
            'service_id' => 'required',
            'stylist_id' => 'required',
            'salon_id' => 'required',
            'schedule_id' => 'required',
        ]);

        Appointment::create($request->all());

        return redirect()->route('appointment.index', compact('layout'));
    }

    public function show($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $appointment = Appointment::findOrFail($id);
        $customer = Customer::find($appointment->customer_id);
        $service = Service::find($appointment->service_id);
        $stylist = Stylist::find($appointment->stylist_id);
        $salon = Salone::find($appointment->salon_id);
        $schedule = Schedule::find($appointment->schedule_id);

        return view('appointment.show', ['appointment' => $appointment, 'customer' => $customer, 'service' => $service, 'stylist' => $stylist, 'salon' => $salon, 'schedule' => $schedule, 'layout' => $layout]);
    }

    public function edit($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $appointment = Appointment::findOrFail($id);
        if ($layout == 'layouts.customer') {
            $customers = Customer::where('user_id', Auth::user()->id)->first();
        } else {
            $customers = Customer::all();
        }
        $stylists = Stylist::all();
        $salons = Salone::all();

        // Get all existing appointments
        $existingAppointments = Appointment::where('customer_id', $appointment->customer_id)
            ->pluck('schedule_id')->all();

        // Get schedules that are not taken (i.e., not in existing appointments)
        $availableSchedules = Schedule::whereNotIn('id', $existingAppointments)
            ->orWhere('id', $appointment->schedule_id) // Include the current schedule of the appointment
            ->get();

        return view('appointment.edit', compact('appointment', 'customers', 'stylists', 'salons', 'availableSchedules', 'layout'));
    }

    public function update(Request $request, $id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $request->validate([
            'customer_id' => 'required',
            'service_id' => 'required',
            'stylist_id' => 'required',
            'salon_id' => 'required',
            'schedule_id' => 'required',
        ]);

        $appointment = Appointment::findOrFail($id);
        $appointment->update($request->all());

        return redirect()->route('appointment.index', compact('layout'));
    }

    public function destroy($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->route('appointment.index', compact('layout'));
    }

    public function getAvailableSchedules($stylistId, $salonId, $currentAppointmentId = null)
    {
        $currentDate = Carbon::now();
        $existingAppointments = Appointment::pluck('schedule_id')->all();

        $availableSchedules = Schedule::where('stylist_id', $stylistId)
            ->where('salon_id', $salonId);

        if (!empty($existingAppointments)) {
            $availableSchedules->whereNotIn('id', $existingAppointments);
            $availableSchedules->where('date', '>', $currentDate->toDateString());
        }

        //dd($currentAppointment);
        //dd($schedule);

        // if ($schedule->stylist_id==$stylistId&& $schedule->salon_id==$salonId) {
        //     $availableSchedules->where('id', $currentAppointment->schedule_id);
        // }
        if (!empty($currentAppointmentId)) {
            $currentAppointment = Appointment::find($currentAppointmentId);
            $schedule = Schedule::find($currentAppointment->schedule_id);
            $availableSchedules->orWhere('id', $currentAppointment->schedule_id);
        }

        $availableSchedules = $availableSchedules->get();

        return response()->json($availableSchedules);
    }


    public function getAppointmentDetails($appointmentId)
    {
        $appointment = Appointment::find($appointmentId);

        return response()->json([
            'appointment' => $appointment,
            'schedule' => $appointment->schedule,
            'stylist' => $appointment->stylist,
            'salon' => $appointment->salon
        ]);
    }
}
