<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

Route::post('employees/register', [EmployeeController::class, 'register']);
Route::middleware('auth.jwt')->put('employees/update', [EmployeeController::class, 'update']);
Route::post('login', [EmployeeController::class, 'login'])->name('login');
Route::middleware('auth.jwt')->delete('employees/delete', [EmployeeController::class, 'delete']);
Route::get('employees/getall', [EmployeeController::class, 'getAll']);
