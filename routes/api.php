<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

//logout
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');
//company
Route::get('/company', [App\Http\Controllers\Api\CompanyController::class, 'show'])->middleware('auth:sanctum');
//absenmasuk
Route::post('/absendatang', [App\Http\Controllers\Api\AttendanceController::class, 'absendatang'])->middleware('auth:sanctum');
//absenpulang
Route::post('/absenpulang', [App\Http\Controllers\Api\AttendanceController::class, 'absenpulang'])->middleware('auth:sanctum');
//jikasudahabsen
Route::get('/ischeckedin', [App\Http\Controllers\Api\AttendanceController::class,'isCheckedin'])->middleware('auth:sanctum');
//updateprofile
Route::post('/updateprofile', [App\Http\Controllers\Api\AuthController::class,'updateprofile'])->middleware('auth:sanctum');
Route::post('/permission', [App\Http\Controllers\Api\PermissionController::class,'permission'])->middleware('auth:sanctum');
