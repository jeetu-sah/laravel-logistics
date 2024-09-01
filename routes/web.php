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





Route::group(['middleware' => ['guest']], function () {
    Route::get('/', [LoginController::class, 'index'])->name('/');
    Route::post('login', [LoginController::class, 'store']);
});

Route::group(['middleware' => ['auth']], function () {

    Route::prefix('admin')->group(function () {

        Route::get('/', [AdminController::class, 'index']);
        Route::get('/adminlayout', [AdminController::class, 'adminlayout']);

        Route::post('/settings/change', [SettingsController::class, 'changeSettings'])->name('admin.settings.change');
        // Branch 
        Route::get('/branch/create', [BranchController::class, 'index']);
        Route::get('/branch/branch-list', [BranchController::class, 'show']);

        Route::get('/branch/get-districts/{stateId}', [BranchController::class, 'getDistricts']);
        Route::post('/create-new-branch', [BranchController::class, 'store'])->name('admin.create-new-branch');
        // booking 
        Route::get('/booking/create', [BookingController::class, 'index']);
        Route::get('/booking/to-pay-booking', [BookingController::class, 'to_pay_booking']);
        Route::get('/booking/to-client-booking', [BookingController::class, 'to_client_booking']);
        Route::get('/booking/branch-list', [BookingController::class, 'show']);
        Route::post('/booking/paid-booking', [BookingController::class, 'paid_booking']);


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
