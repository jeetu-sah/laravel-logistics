<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ChallanController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\Admin\BranchDistace;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::post('track-shipment', [ShipmentController::class, 'trackShipment']);
Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('/');
    Route::post('login', [LoginController::class, 'store']);
});
Route::get('/get-districts-user/{stateId}', [HomeController::class, 'getDistricts']);
Route::post('/inquiry', [InquiryController::class, 'store']);



Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->user_type == 'admin') {
            return redirect('/admin/dashboard');

        } else if ($user->user_type == 'branch-user') {
            return redirect('/branch-user/dashboard');
        }
    });

    Route::prefix('admin')->group(function () {

        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::get('/adminlayout', [AdminController::class, 'adminlayout']);
        Route::get('/get-states/{countryId}', [AdminController::class, 'getStates']);
        Route::get('/get-districts/{stateId}', [AdminController::class, 'getDistricts']);

        Route::post('/settings/change', [SettingsController::class, 'changeSettings'])->name('admin.settings.change');
        // Branch
        Route::get('/branches', [BranchController::class, 'index']);
        Route::get('/branches/list', [BranchController::class, 'list']);
        Route::get('/branches/deletebranch/{id}', [BranchController::class, 'deletebranch']);
        Route::get('/branches/create', [BranchController::class, 'create']);
        Route::get('/branches/edit/{branchId}', [BranchController::class, 'edit']);
        Route::post('/branches/update/{id}', [BranchController::class, 'update'])->name('admin.update');
        Route::post('/branches/store', [BranchController::class, 'store'])->name('admin.store');



        // Define the route for the bilti view
        Route::get('/bookings/bilti/{id}', [BookingController::class, 'bilti'])->name('bookings.bilti');

        // paid booking
        Route::get('/bookings', [BookingController::class, 'index']);
        Route::get('/bookings/create', [BookingController::class, 'create']);
        Route::post('/bookings/store', [BookingController::class, 'store']);
        Route::get('/bookings/redirect', [BookingController::class, 'redirect']);

        Route::get('/bookings/upcoming-booking', action: [BookingController::class, 'upcomingBookings']);
        Route::get('/bookings/list', action: [BookingController::class, 'list']);
        Route::get('/bookings/challan-booking-list', [BookingController::class, 'challanBookingList']);
        //  Route::get('/booking/create', [BookingController::class, 'index']);
        Route::get('/bookings/noBill', [BookingController::class, 'noBill']);

        Route::post('/bookings/paid-booking', [BookingController::class, 'paid_booking']);
        // // to paid booking
        Route::get('/bookings/to-pay-booking', [BookingController::class, 'to_pay_booking']);
        Route::post('/bookings/to-pay-booking', [BookingController::class, 'to_pay_booking_save']);
        // // to client booking
        Route::get('/bookings/clients', [BookingController::class, 'Clientshow']);
        Route::get('/bookings/clientsList', [BookingController::class, 'clientList']);
        Route::get('/bookings/to-client-booking/{id}', [BookingController::class, 'to_client_booking']);
        Route::post('/bookings/to-client-booking', [BookingController::class, 'to_client_booking_save']);

        Route::get('/challans', [ChallanController::class, 'index']);
        Route::get('/challans/list', [ChallanController::class, 'list']);
        Route::get('/challans/create', [ChallanController::class, 'create']);
        Route::post('/challans/create', [ChallanController::class, 'store']);
        Route::get('challans/{id}', [ChallanController::class, 'show']);
        //Client routes

        Route::get('/clients', [ClientController::class, 'show']);
        Route::get('/clients/create', [ClientController::class, 'index']);
        Route::post('/clients/store', [ClientController::class, 'store']);
        Route::get('/clients/list', [ClientController::class, 'list']);
        Route::get('clients/edit/{id}', [ClientController::class, 'edit']);
        Route::post('clients/update', [ClientController::class, 'update']);
        Route::get('clients/delete/{id}', [ClientController::class, 'delete']);
        Route::get('get-distance', [ClientController::class, 'getDistance']);

        // /Distance
        Route::get('distances', [BranchDistace::class, 'index']);
        Route::get('distances/create', [BranchDistace::class, 'create']);
        Route::post('distances/store', [BranchDistace::class, 'store']);
        Route::get('distances/list', [BranchDistace::class, 'list']);
        Route::get('distances/edit/{id}', [BranchDistace::class, 'edit']);
        Route::post('distances/update', [BranchDistace::class, 'update']);
        Route::get('distances/delete/{id}', [BranchDistace::class, 'delete']);

        Route::post('/booking/recived', [ChallanController::class, 'recived']);


        Route::get('admin/article/create', [ArticleController::class, 'index']);

        // delivery 

        Route::get('delivery', [DeliveryController::class, 'index']);
        Route::get('delivery/list', [DeliveryController::class, 'list']);
        Route::get('delivery/create/{id}', [DeliveryController::class, 'create']);
        Route::post('delivery/store', [DeliveryController::class, 'store']);
        Route::get('admin/delivery/receipt/{id}', [DeliveryController::class, 'show'])->name('admin.delivery.receipt');


    });

    Route::prefix('branch-user/')->group(function () {

        Route::get('dashboard', [\App\Http\Controllers\BranchUser\DashboardController::class, 'index']);

        Route::get('employees', [\App\Http\Controllers\BranchUser\ReviewerController::class, 'show']);
        Route::get('employees/list', [\App\Http\Controllers\BranchUser\ReviewerController::class, 'list']);
        Route::get('employees/create', [\App\Http\Controllers\BranchUser\ReviewerController::class, 'index']);
        Route::get('employees/edit/{id}', [\App\Http\Controllers\BranchUser\ReviewerController::class, 'edit']);
        Route::post('employees/update/{id}', [\App\Http\Controllers\BranchUser\ReviewerController::class, 'update']);
        Route::post('employees/store', [\App\Http\Controllers\BranchUser\ReviewerController::class, 'store'])->name('branch-user.add_employee');

        Route::get('settings', [\App\Http\Controllers\BranchUser\SettingController::class, 'index']);
        Route::post('settings', [\App\Http\Controllers\BranchUser\SettingController::class, 'store'])->name('branch-user.settings');
    });

    //Route::get('admin/add-new-reviewers', [ReviewerController::class, 'index']);
    //Route::get('admin/reviewers-list', [ReviewerController::class, 'show']);
    //Route::post('admin/add-reviewers', [ReviewerController::class, 'add_reviewers'])->name('admin.add_reviewers');

    // Permission
    Route::get('admin/permission', [PermissionController::class, 'index']);
    Route::post('admin/add-permission', [PermissionController::class, 'store'])->name('admin.add-permission');
    Route::get('admin/permission-list', [PermissionController::class, 'show']);
    // Role
    Route::get('admin/role', [RoleController::class, 'index']);
    Route::get('admin/role/list', [RoleController::class, 'list']);
    Route::post('admin/add-role', [RoleController::class, 'store'])->name('admin.add-role');
    Route::get('admin/role-list', [RoleController::class, 'show']);

    Route::get('logout', [LogOutController::class, 'index']);
});
