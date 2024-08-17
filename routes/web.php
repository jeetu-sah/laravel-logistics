<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogOutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\ReviewerController;
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

    Route::get('admin', [AdminController::class, 'index']);
    Route::get('admin/adminlayout', [AdminController::class, 'adminlayout']);

    Route::get('admin/reviewers', [ReviewerController::class, 'show']);
    Route::get('admin/reviewers/list', [ReviewerController::class, 'list']);
    Route::get('admin/reviewers/create', [ReviewerController::class, 'index']);
    Route::get('admin/reviewers/edit/{id}', [ReviewerController::class, 'edit']);
    Route::post('admin/reviewers/update/{id}', [ReviewerController::class, 'update']);
    Route::post('admin/reviewers/store', [ReviewerController::class, 'store'])->name('admin.add_reviewers');
    Route::post('admin/settings/change', [SettingsController::class, 'changeSettings'])->name('admin.settings.change');
    // Branch 
    Route::get('admin/branch/create', [BranchController::class, 'index']);
    Route::get('admin/branch/branch-list', [BranchController::class, 'show']);
    // booking 
    Route::get('admin/booking/create', [BookingController::class, 'index']);
    Route::get('admin/booking/branch-list', [BookingController::class, 'show']);

    Route::get('admin/article/create', [ArticleController::class, 'index']);


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
