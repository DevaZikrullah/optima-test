<?php

use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;
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


Route::get('/companies', [
    CompaniesController::class, 'index'
]);

Route::get('/companies/{id}', [
    CompaniesController::class, 'show'
]);

Route::post('/companies_update/{id}', [
    CompaniesController::class, 'update'
]);

Route::delete('/companies/{id}', [
    CompaniesController::class, 'destroy'
]);

Route::post('companies_create',[
    CompaniesController::class, 'store'
]);

Route::get('/employees', [
    EmployeesController::class, 'index'
]);

Route::get('/employees/{id}', [
    EmployeesController::class, 'show'
]);

Route::post('/employees_update/{id}', [
    EmployeesController::class, 'update'
]);

Route::delete('/employees/{id}', [
    EmployeesController::class, 'destroy'
]);

Route::post('employees_create',[
    EmployeesController::class, 'store'
]);
