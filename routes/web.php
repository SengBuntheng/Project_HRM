<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\EmployeeController;
use App\Http\Controllers\backend\DepartmentController;
use App\Http\Controllers\backend\PositionController;
use App\Http\Controllers\backend\ProfileController;

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard.index');
});

Route::resource('employees', EmployeeController::class);

Route::resource('/department',DepartmentController::class);

Route::resource('positions', PositionController::class);

Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
