<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\backend\DashboardController;
use App\Http\Controllers\backend\EmployeeController;
use App\Http\Controllers\backend\DepartmentController;

Route::controller(DashboardController::class)->group(function () {
    Route::get('/', 'index')->name('dashboard.index');
});

Route::resource('employees', EmployeeController::class);

Route::resource('/department',DepartmentController::class);
