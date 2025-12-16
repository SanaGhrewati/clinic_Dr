<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
use App\Http\Controllers\DepartmentController;

Route::apiResource('departments', DepartmentController::class);

use App\Http\Controllers\DoctorController;

Route::apiResource('doctors', DoctorController::class);

use App\Http\Controllers\Api\PatientController;

Route::apiResource('patients', PatientController::class);

use App\Http\Controllers\Api\ServiceController;

Route::apiResource('services', ServiceController::class);

use App\Http\Controllers\Api\AppointmentController;

Route::apiResource('appointments', AppointmentController::class);