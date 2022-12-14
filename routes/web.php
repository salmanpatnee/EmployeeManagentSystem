<?php

use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\CountriesController;
use App\Http\Controllers\Admin\StatesController;
use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\DepartmentsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {

    Route::resource('users', UsersController::class);
    Route::resource('countries', CountriesController::class);
    Route::resource('states', StatesController::class);
    Route::resource('cities', CitiesController::class);
    Route::resource('departments', DepartmentsController::class);

    Route::get('/{any}', function () {
        return view('admin.employees.index');
    })->where('any', '.*');
});
