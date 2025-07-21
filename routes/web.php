<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LocaleController;


Route::get('/create-employee', function () {
    return view('employee.create');
})->name('register');
Route::get('/update', function () {
    return view('employee.update');
})->middleware('auth')->name('employee.update.views');

Route::get('/employees/login', function () {
    return view('employee.login');
})->name('employee.login.view');

Route::get('/home', function () {
    return view('employee.home');
})->middleware('auth')->name('employee.home');

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('register');
})->name('logout');


Route::post('/employees/register', [EmployeeController::class, 'register'])->name('employee.register');
Route::post('/employees/login', [EmployeeController::class, 'login'])->name('login');
Route::put('/employees/update', [EmployeeController::class, 'update'])->middleware('auth')->name('employee.update.submit');

Route::delete('/employees/delete', [EmployeeController::class, 'delete'])->name('employee.delete');
Route::get('/view-all', [EmployeeController::class, 'getAll'])->name('employee.view-all');
Route::get('locale/{lang}', action: [LocaleController::class, 'setLo'])->name('lang.switch');