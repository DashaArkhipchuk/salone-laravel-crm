<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\SalonController;
use App\Http\Controllers\SaloneController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\StylistsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/salons', [SaloneController::class, 'getSalonsFrontPage'])->name('salons');
Route::get('/services', [ServiceController::class, 'getServicesFrontPage'])->name('services');
Route::get('/reviews', function () {
    return view('reviews'); })->name('reviews');


Route::middleware(['admin'])->group(function () {
    Route::get('/admin/salone/create', [SaloneController::class, 'create'])->name('salone.create');
    Route::post('/admin/salone', [SaloneController::class, 'store'])->name('salone.store');
    Route::delete('/admin/salone/{id}', [SaloneController::class, 'destroy'])->name('salone.destroy');


    Route::get('/admin/role', [RolesController::class, 'index'])->name('role.index');
    Route::get('/admin/role/create', [RolesController::class, 'create'])->name('role.create');
    Route::post('/admin/role', [RolesController::class, 'store'])->name('role.store');
    Route::get('/admin/role/{id}', [RolesController::class, 'show'])->name('role.show');
    Route::get('/admin/role/{id}/edit', [RolesController::class, 'edit'])->name('role.edit');
    Route::put('/admin/role/{id}', [RolesController::class, 'update'])->name('role.update');
    Route::delete('/admin/role/{id}', [RolesController::class, 'destroy'])->name('role.destroy');

    Route::get('/admin/address', [AddressController::class, 'index'])->name('address.index');
    Route::get('/admin/address/create', [AddressController::class, 'create'])->name('address.create');
    Route::post('/admin/address', [AddressController::class, 'store'])->name('address.store');
    Route::get('/admin/address/{id}', [AddressController::class, 'show'])->name('address.show');
    Route::get('/admin/address/{id}/edit', [AddressController::class, 'edit'])->name('address.edit');
    Route::put('/admin/address/{id}', [AddressController::class, 'update'])->name('address.update');
    Route::delete('/admin/address/{id}', [AddressController::class, 'destroy'])->name('address.destroy');
    
    Route::get('/admin/stylist/create', [StylistsController::class, 'create'])->name('stylist.create');
    Route::post('/admin/stylist', [StylistsController::class, 'store'])->name('stylist.store');
    Route::get('/admin/stylist/{id}/edit', [StylistsController::class, 'edit'])->name('stylist.edit');
    Route::put('/admin/stylist/{id}', [StylistsController::class, 'update'])->name('stylist.update');
    Route::delete('/admin/stylist/{id}', [StylistsController::class, 'destroy'])->name('stylist.destroy');


    Route::get('/admin/manager', [ManagerController::class, 'index'])->name('manager.index');
    Route::get('/admin/manager/create', [ManagerController::class, 'create'])->name('manager.create');
    Route::post('/admin/manager', [ManagerController::class, 'store'])->name('manager.store');
    Route::get('/admin/manager/{id}', [ManagerController::class, 'show'])->name('manager.show');
    Route::get('/admin/manager/{id}/edit', [ManagerController::class, 'edit'])->name('manager.edit');
    Route::put('/admin/manager/{id}', [ManagerController::class, 'update'])->name('manager.update');
    Route::delete('/admin/manager/{id}', [ManagerController::class, 'destroy'])->name('manager.destroy');

    Route::get('/admin/services/create', [ServiceController::class, 'create'])->name('service.create');
    Route::post('/admin/services', [ServiceController::class, 'store'])->name('service.store');
    Route::get('/admin/services/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
    Route::put('/admin/services/{id}', [ServiceController::class, 'update'])->name('service.update');
    Route::delete('/admin/services/{id}', [ServiceController::class, 'destroy'])->name('service.destroy');
    
    Route::get('/admin/currency', [CurrencyController::class, 'index'])->name('currency.index');
    Route::get('/admin/currency/create', [CurrencyController::class, 'create'])->name('currency.create');
    Route::post('/admin/currency', [CurrencyController::class, 'store'])->name('currency.store');
    Route::get('/admin/currency/{id}', [CurrencyController::class, 'show'])->name('currency.show');
    Route::get('/admin/currency/{id}/edit', [CurrencyController::class, 'edit'])->name('currency.edit');
    Route::put('/admin/currency/{id}', [CurrencyController::class, 'update'])->name('currency.update');
    Route::delete('/admin/currency/{id}', [CurrencyController::class, 'destroy'])->name('currency.destroy');

    Route::get('/admin/payment/create', [PaymentController::class, 'create'])->name('payment.create');
    Route::post('/admin/payment', [PaymentController::class, 'store'])->name('payment.store');
    Route::get('/admin/payment/{id}/edit', [PaymentController::class, 'edit'])->name('payment.edit');
    Route::put('/admin/payment/{id}', [PaymentController::class, 'update'])->name('payment.update');
    Route::delete('/admin/payment/{id}', [PaymentController::class, 'destroy'])->name('payment.destroy');

    Route::delete('/admin/customer/{id}', [CustomerController::class, 'destroy'])->name('customer.destroy');
    
    
    Route::get('/admin/filter', [FilterController::class, 'index'])->name('filter.index');
    Route::get('/admin/filter/create', [FilterController::class, 'create'])->name('filter.create');
    Route::post('/admin/filter', [FilterController::class, 'store'])->name('filter.store');
    Route::get('/admin/filter/{id}', [FilterController::class, 'show'])->name('filter.show');
    Route::get('/admin/filter/{id}/edit', [FilterController::class, 'edit'])->name('filter.edit');
    Route::put('/admin/filter/{id}', [FilterController::class, 'update'])->name('filter.update');
    Route::delete('/admin/filter/{id}', [FilterController::class, 'destroy'])->name('filter.destroy');
    
    Route::get('/admin/account', [AccountController::class, 'index'])->name('account.index');
    Route::get('/admin/account/create', [AccountController::class, 'create'])->name('account.create');
    Route::post('/admin/account', [AccountController::class, 'store'])->name('account.store');
    Route::get('/admin/account/{id}', [AccountController::class, 'show'])->name('account.show');
    Route::get('/admin/account/{id}/edit', [AccountController::class, 'edit'])->name('account.edit');
    Route::put('/admin/account/{id}', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/admin/account/{id}', [AccountController::class, 'destroy'])->name('account.destroy');
    
    
    Route::get('/admin/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/admin/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/admin/user', [UserController::class, 'store'])->name('user.store');
    Route::get('/admin/user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/admin/user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/admin/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    
    
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin'])->name('adminHome');
});
Route::middleware(['manager'])->group(function () {
    Route::get('/manager/home', [App\Http\Controllers\HomeController::class, 'manager'])->name('managerHome');

    
});

Route::middleware(['stylist'])->group(function () {
    Route::get('/stylist/home', [App\Http\Controllers\HomeController::class, 'stylist'])->name('stylistHome');
});

Route::middleware(['customer'])->group(function () {
    Route::get('/customer/home', [App\Http\Controllers\HomeController::class, 'customer'])->name('customerHome');
});

Route::middleware(['adminOrManager'])->group(function () {

    Route::get('/salone/{id}/edit', [SaloneController::class, 'edit'])->name('salone.edit');
    Route::put('/salone/{id}', [SaloneController::class, 'update'])->name('salone.update');
    
    Route::get('/stylist', [StylistsController::class, 'index'])->name('stylist.index');
    Route::get('/stylist/{id}', [StylistsController::class, 'show'])->name('stylist.show');
    
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer.index');
    Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
    Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');
    Route::get('/customer/{id}', [CustomerController::class, 'show'])->name('customer.show');
    Route::get('/customer/{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
    Route::put('/customer/{id}', [CustomerController::class, 'update'])->name('customer.update');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.home');


//stylist& admin

Route::middleware(['adminOrStylist'])->group(function () {
    Route::get('/schedule/create', [ScheduleController::class, 'create'])->name('schedule.create');
    Route::post('/schedule', [ScheduleController::class, 'store'])->name('schedule.store');
    Route::get('/schedule/{id}/edit', [ScheduleController::class, 'edit'])->name('schedule.edit');
    Route::put('/schedule/{id}', [ScheduleController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{id}', [ScheduleController::class, 'destroy'])->name('schedule.destroy');

    Route::get('/admin/price/create', [PriceController::class, 'create'])->name('price.create');
    Route::post('/admin/price', [PriceController::class, 'store'])->name('price.store');
    Route::get('/admin/price/{id}/edit', [PriceController::class, 'edit'])->name('price.edit');
    Route::put('/admin/price/{id}', [PriceController::class, 'update'])->name('price.update');
    Route::delete('/admin/price/{id}', [PriceController::class, 'destroy'])->name('price.destroy');
});


Route::middleware(['adminOrStylistOrCustomer'])->group(function () {
    Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
    Route::get('/payment/{id}', [PaymentController::class, 'show'])->name('payment.show');
});
    
//----

//customer admin manager

Route::middleware(['adminOrManagerOrCustomer'])->group(function () {
    Route::get('/appointment/create', [AppointmentController::class, 'create'])->name('appointment.create');
    Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');
    Route::get('/appointment/{id}/edit', [AppointmentController::class, 'edit'])->name('appointment.edit');
    Route::put('/appointment/{id}', [AppointmentController::class, 'update'])->name('appointment.update');
    Route::delete('/appointment/{id}', [AppointmentController::class, 'destroy'])->name('appointment.destroy');
});


Route::get('/salone', [SaloneController::class, 'index'])->name('salone.index');
Route::get('/salone/{id}', [SaloneController::class, 'show'])->name('salone.show');

Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/services/{id}', [ServiceController::class, 'show'])->name('service.show');

Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule.index');
Route::get('/schedule/{id}', [ScheduleController::class, 'show'])->name('schedule.show');

Route::get('/appointment', [AppointmentController::class, 'index'])->name('appointment.index');
Route::get('/appointment/{id}', [AppointmentController::class, 'show'])->name('appointment.show');

Route::get('/price', [PriceController::class, 'index'])->name('price.index');
Route::get('/price/{id}', [PriceController::class, 'show'])->name('price.show');


Route::get('/get-available-schedules/{stylistId}/{salonId}/{currentAppointmentId?}', [AppointmentController::class, 'getAvailableSchedules'])->name('get-available-schedules');
Route::get('/get-appointment-details/{appointmentId}', [AppointmentController::class, 'getAppointmentDetails'])->name('get-appointment-details');
Route::get('/get-schedule-details/{scheduleId}', [ScheduleController::class, 'getScheduleDetails'])->name('get-schedule-details');
Route::get('/get-available-stylists/{salonId}', [SaloneController::class, 'getAvailableStylists'])->name('get-available-stylists');
Route::get('/get-available-services/{stylistId}', [StylistsController::class, 'getAvailableServices'])->name('get-available-services');


Auth::routes();

