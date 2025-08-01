<?php

use App\Http\Controllers\Admin\AccountsController;
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
use App\Http\Controllers\Admin\CareerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\Admin\BranchDistace;
use App\Http\Controllers\Report\BookingReportController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\MapClientController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Admin\IncomingBookingController;
use App\Http\Controllers\BranchUser\ReviewerController;
use App\Http\Controllers\BranchUser\SettingController;
use App\Http\Controllers\BranchUser\DashboardController;
use App\Http\Controllers\FranchiseApplicationController;

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


Route::post('apply', [ApplicationController::class, 'store'])->name('applications.store');

Route::get('/', [HomeController::class, 'index'])->name('/');
Route::get('franchise', [FranchiseApplicationController::class, 'index']);
Route::post('/franchise/application/store', [FranchiseApplicationController::class, 'store'])->name('franchise.application.store');

Route::post('track-shipment', [ShipmentController::class, 'trackShipment']);

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('/');
    Route::post('login', [LoginController::class, 'store']);
    Route::post('reset-password', [LoginController::class, 'resetPassword']);
    Route::match(['get', 'post'], 'forget-password', [LoginController::class, 'forgetPassword']);
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
        // Jobs
        Route::get('careers', [CareerController::class, 'index']);
        Route::get('careers/list', [CareerController::class, 'list']);
        Route::get('careers/create', [CareerController::class, 'create']);
        Route::post('careers/store', [CareerController::class, 'store']);
        Route::get('careers/applications', [CareerController::class, 'applications']);
        Route::get('careers/applications/list', [CareerController::class, 'applicationList']);
        Route::get('careers/edit/{id}', [CareerController::class, 'edit'])->name('careers.edit');
        Route::put('careers/update/{id}', [CareerController::class, 'update'])->name('careers.update');
        Route::delete('careers/delete/{id}', [CareerController::class, 'destroy'])->name('careers.delete');

        //admin/settings
        Route::prefix('admin-settings')->group(function () {
             Route::get('/', [SettingsController::class, 'index']);
             Route::get('/create', [SettingsController::class, 'create']);
             Route::get('/delete/{id}', [SettingsController::class, 'delete']);
             Route::post('/store', [SettingsController::class, 'store']);
        });

        // Client Booking Report
        // Booking Report
        Route::get('reports/bookings-report', [BookingReportController::class, 'index']);
        Route::get('reports/bookings/list', [BookingReportController::class, 'list']);
        // Client Booking Report
        Route::get('reports/clients', [BookingReportController::class, 'clientBooking']);
        Route::get('reports/clients/list', [BookingReportController::class, 'clientList']);
        Route::get('reports/clients/bookings/list', [BookingReportController::class, 'clientBookingview']);
        Route::get('reports/clients/bookings/revenue/{fromId}/{toId}', [BookingReportController::class, 'clientBookingRevenue']);
        Route::get('reports/clients/bookings/{id}', [BookingReportController::class, 'clientBookingList']);


        Route::get('/dashboard', [AdminController::class, 'index']);
        Route::get('/adminlayout', [AdminController::class, 'adminlayout']);
        Route::get('/get-states/{countryId}', [AdminController::class, 'getStates']);
        Route::get('/get-districts/{stateId}', [AdminController::class, 'getDistricts']);

        Route::post('/settings/change', [SettingsController::class, 'changeSettings'])->name('admin.settings.change');
        // Branch
        // Define the route for the bilti view
        Route::prefix('branches')->group(function () {
            Route::get('/', [BranchController::class, 'index']);
            Route::get('/list', [BranchController::class, 'list']);
            Route::get('/deletebranch/{id}', [BranchController::class, 'deletebranch']);
            Route::get('/create', [BranchController::class, 'create']);
            Route::get('/edit/{branchId}', [BranchController::class, 'edit']);
            Route::post('/update/{id}', [BranchController::class, 'update'])->name('admin.update');
            Route::post('/store', [BranchController::class, 'store'])->name('admin.store');
        });

        // Define the route for the bilti view
        Route::prefix('bookings')->group(function () {
            Route::get('/', [BookingController::class, 'index']);
            Route::get('/list', [BookingController::class, 'list']);
            Route::get('/create', [BookingController::class, 'create']);
            Route::post('/store', [BookingController::class, 'store']);
            Route::get('/edit/{id}', [BookingController::class, 'edit']);
            Route::post('/update/{id}', [BookingController::class, 'update']);
            // Route::get('/client', [BookingController::class, 'clientBooking']);
            Route::get('/client-detail/{id}', [ClientController::class, 'getClientDetail']);
            // Route::get('/incoming-load', [BookingController::class, 'incomingLoad']);

            Route::get('/print-bilti/{id}', [BookingController::class, 'printBilti'])->name('bookings.bilti');
            Route::post('/booking-received', [ChallanController::class, 'received']);
            Route::get('/challan-booking-list', [BookingController::class, 'challanBookingList']);
        });
        // Define the route for the bilti view
        Route::prefix('incoming-booking')->group(function () {
            Route::get('/', [IncomingBookingController::class, 'incomingLoad']);
            Route::get('/list', [IncomingBookingController::class, 'upcomingBookings']);
        });
        // paid booking
        // Route::get('/bookings/redirect', [BookingController::class, 'redirect']);
        // Route::get('/clients/bookings/edit/{id}', [BookingController::class, 'edit']);
        // Route::get('/bookings/challan-booking-list', [BookingController::class, 'challanBookingList']);
        //  Route::get('/booking/create', [BookingController::class, 'index']);
        // Route::get('/bookings/noBill', [BookingController::class, 'noBill']);

        Route::post('/bookings/paid-booking', [BookingController::class, 'paid_booking']);
        // to paid booking
        // Route::get('/bookings/to-pay-booking', [BookingController::class, 'to_pay_booking']);
        // Route::post('/bookings/to-pay-booking', [BookingController::class, 'to_pay_booking_save']);
        // to client booking
        Route::get('/bookings/clients', [BookingController::class, 'Clientshow']);
        Route::get('/bookings/clientsList', [BookingController::class, 'clientList']);
        // Route::get('/bookings/clients/bookings/{id}', [BookingController::class, 'to_client_booking']);

        Route::post('/bookings/to-client-booking', [BookingController::class, 'to_client_booking_save']);
        Route::get('challans/{challanId}/revert-booking/{bookingId}', [ChallanController::class, 'revertChallanbooking']);

        Route::prefix('challans')->group(function () {
            Route::get('/', [ChallanController::class, 'index']);
            Route::get('/list', [ChallanController::class, 'list']);
            Route::get('/incoming-challans', [ChallanController::class, 'incomingChallans']);
            Route::get('/create', [ChallanController::class, 'create']);
            Route::post('/create', [ChallanController::class, 'store']);
            Route::get('/{id}', [ChallanController::class, 'show']);
        });
        //Client routes

        Route::get('/clients', [ClientController::class, 'show']);
        Route::get('/clients/list', [ClientController::class, 'list']);
        Route::get('/clients/create', [ClientController::class, 'index']);
        Route::post('/clients/store', [ClientController::class, 'store']);
        Route::get('clients/edit/{id}', [ClientController::class, 'edit']);
        Route::post('clients/update/{id}', [ClientController::class, 'update']);
        Route::get('clients/delete/{id}', [ClientController::class, 'delete']);


        Route::get('/clients/map-to-branch/{id}', [MapClientController::class, 'index']);
        // Route::get('/clients/clientMap', [MapClientController::class, 'clientMap']);
        Route::post('clients/maps/{id}', [MapClientController::class, 'mapBranches']);
        // Route::post('/clients/mapClient', [MapClientController::class, 'storeClientMapping']);
        Route::get('get-distance', [ClientController::class, 'getDistance']);

        // /Distance
        Route::get('distances', [BranchDistace::class, 'index']);
        Route::get('distances/create', [BranchDistace::class, 'create']);
        Route::post('distances/store', [BranchDistace::class, 'store']);
        Route::get('distances/list', [BranchDistace::class, 'list']);
        Route::get('distances/edit/{id}', [BranchDistace::class, 'edit']);
        Route::post('distances/update', [BranchDistace::class, 'update']);
        Route::get('distances/delete/{id}', [BranchDistace::class, 'delete']);
        Route::get('admin/article/create', [ArticleController::class, 'index']);

        // delivery 
        Route::prefix('delivery')->group(function () {
            // Route::get('delivery', [DeliveryController::class, 'index']);
            Route::get('gatepass/', [DeliveryController::class, 'index']);
            Route::get('/list', [DeliveryController::class, 'list']);
            Route::get('/gatepass-amount', [DeliveryController::class, 'gatepassAmounts']);
            Route::get('/gatepass-amount/detail/{deliveryReceptId}', [DeliveryController::class, 'details']);
            Route::post('/gatepass-amount/add-payments/{deliveryReceptId}', [DeliveryController::class, 'addDeliveryPayment']);
            Route::get('/gatepass/amount/ajax-list', [DeliveryController::class, 'gatepassList']);
            Route::get('gatepass/create/{id}', [DeliveryController::class, 'create']);
            Route::post('/gatepass/store', [DeliveryController::class, 'store']);
            Route::get('/gatepass/receipt/{id}', [DeliveryController::class, 'show'])->name('admin.delivery.receipt');
        });
        // accounts 
        Route::prefix('accounts')->group(function () {
            // Route::get('delivery', [DeliveryController::class, 'index']);
            Route::get('create', [AccountsController::class, 'create']);
            Route::get('index/', [AccountsController::class, 'index']);
            Route::post('store/', [AccountsController::class, 'store']);
            Route::get('list/', [AccountsController::class, 'list']);
        });
    });

    Route::prefix('branch-user/')->group(function () {

        Route::prefix('dashboard/')->group(function () {
            Route::get('/', [DashboardController::class, 'index']);
            // Route::get('/bookings/upcoming-booking', [\App\Http\Controllers\BranchUser\DashboardController::class, 'upcomingBookings']);
            Route::get('/reports', [\App\Http\Controllers\BranchUser\DashboardController::class, 'reports']);
        });

        Route::prefix('employees')->group(function () {
            Route::get('/', [ReviewerController::class, 'show']);
            Route::get('/list', [ReviewerController::class, 'list']);
            Route::post('/update-status', [ReviewerController::class, 'updateStatus']);
            Route::get('/create', [ReviewerController::class, 'index']);
            Route::get('/edit/{id}', [ReviewerController::class, 'edit']);
            Route::post('/update/{id}', [ReviewerController::class, 'update']);
            Route::post('/store', [ReviewerController::class, 'store'])->name('branch-user.add_employee');
        });

        Route::prefix('settings')->group(function () {
            Route::get('/', [SettingController::class, 'index']);
            Route::post('/', [SettingController::class, 'store'])->name('branch-user.settings');
            Route::match(['get', 'post'], '/change-password', [SettingController::class, 'changePassword']);
        });
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
