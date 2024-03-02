<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Service;
use App\Models\Stylist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
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

        if ($layout == 'layouts.stylist') {
            $stylist = Stylist::where('user_id', Auth::user()->id)->first();
            $payments = Payment::with(['currency', 'service', 'customer', 'stylist'])->where('stylist_id', $stylist->id)->get();
        } else if ($layout == 'layouts.customer') {
            $customer = Customer::where('user_id', Auth::user()->id)->first();
            $payments = Payment::with(['currency', 'service', 'customer', 'stylist'])->where('customer_id', $customer->id)->get();
        } else {
            $payments = Payment::with(['currency', 'service', 'customer', 'stylist'])->get();
        }



        return view('payment.payment', ['payments' => $payments, 'layout' => $layout]);
    }

    public function create()
    {
        $currencies = Currency::all();
        $customers = Customer::all();
        $services = Service::all();
        $stylists = Stylist::all();

        return view('payment.create', ['currencies' => $currencies, 'customers' => $customers, 'services' => $services, 'stylists' => $stylists]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'currency_id' => 'required',
            'customer_id' => 'required',
            'service_id' => 'required',
            'stylist_id' => 'required',
            'value' => 'required|numeric',
        ]);

        Payment::create($request->all());
        return redirect()->route('payment.index');
    }

    public function show($id)
    {
        $userRole = Auth::user()->role_id;
        $layout = $this->getUserLayout($userRole);
        $payment = Payment::find($id);
        $customer = Customer::find($payment->customer_id);
        $stylist = Stylist::find($payment->stylist_id);
        $service = Service::find($payment->service_id);
        $currency = Currency::find($payment->currency_id);

        return view('payment.show', [
            'payment' => $payment,
            'customer' => $customer,
            'stylist' => $stylist,
            'service' => $service,
            'currency' => $currency,
            'layout' => $layout
        ]);
    }

    public function edit($id)
    {
        $payment = Payment::find($id);
        $currencies = Currency::all();
        $customers = Customer::all();
        $services = Service::all();
        $stylists = Stylist::all();


        return view('payment.edit', compact('payment', 'currencies', 'customers', 'services', 'stylists'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'currency_id' => 'required',
            'customer_id' => 'required',
            'service_id' => 'required',
            'stylist_id' => 'required',
            'value' => 'required|numeric',
        ]);

        $payment = Payment::find($id);
        $payment->update($request->all());
        return redirect()->route('payment.index');
    }

    public function destroy($id)
    {
        $payment = Payment::find($id);
        $payment->delete();
        return redirect()->route('payment.index');
    }
}
