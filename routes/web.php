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
use App\Http\Controllers\HomeController;
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

Route::group(['middleware' => ['guest']], function () {
    Route::get('/login', [LoginController::class, 'index'])->name('/');
    Route::post('login', [LoginController::class, 'store']);
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function() {
        $user = Auth::user();
        if($user->user_type == 'admin') {
            return redirect('/admin/dashboard');
            
        } else if($user->user_type == 'branch-user') {
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
        Route::get('/branches/create', [BranchController::class, 'create']);
        Route::get('/branches/edit/{branchId}', [BranchController::class, 'edit']);
        Route::post('/branches/update/{id}', [BranchController::class, 'update'])->name('admin.update');
        Route::post('/branches/store', [BranchController::class, 'store'])->name('admin.store');

      
        // Define the route for the bilti view
        Route::get('/bookings/bilti/{id}', [BookingController::class, 'bilti'])->name('bookings.bilti');
        
        // paid booking
        Route::get('/bookings', [BookingController::class, 'index']);
        Route::get('/bookings/list', [BookingController::class, 'list']);
        //  Route::get('/booking/create', [BookingController::class, 'index']);
        Route::get('/bookings/paid-booking', [BookingController::class, 'bookings']);
        Route::post('/bookings/paid-booking', [BookingController::class, 'paid_booking']);
        // // to paid booking
        Route::get('/bookings/to-pay-booking', [BookingController::class, 'to_pay_booking']);
        // Route::post('/booking/to-pay-booking', [BookingController::class, 'to_pay_booking_save']);
        // // to client booking
        // Route::post('/booking/to-client-booking', [BookingController::class, 'to_client_booking_save']);
        Route::get('/bookings/to-client-booking', [BookingController::class, 'to_client_booking']);
        
        //challan routes
        Route::get('/challans', [ChallanController::class, 'index']);
        Route::get('/challans/create', [ChallanController::class, 'create']);
        




        Route::get('admin/article/create', [ArticleController::class, 'index']);
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
