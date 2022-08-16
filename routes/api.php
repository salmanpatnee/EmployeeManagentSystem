<?php

use App\Http\Controllers\Admin\Api\EmployeeDataController;
use App\Http\Controllers\Admin\Api\EmployeesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::get('/employees/countries', [EmployeeDataController::class, 'getCountries']);
Route::get('/employees/{country}/states', [EmployeeDataController::class, 'getStates']);
Route::get('/employees/{state}/cities', [EmployeeDataController::class, 'getCities']);
Route::get('/employees/departments', [EmployeeDataController::class, 'getDepartments']);

Route::apiResource('employees', EmployeesController::class);
