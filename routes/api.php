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
//permission
Route::apiResource('/api-permissions', App\Http\Controllers\Api\PermissionController::class)->middleware('auth:sanctum');
//notes
Route::apiResource('/api-notes', App\Http\Controllers\Api\NoteController::class)->middleware('auth:sanctum');

//update fcm token
Route::post('/update-fcm-token', [App\Http\Controllers\Api\AuthController::class, 'updateFcmToken'])->middleware('auth:sanctum');

//get attendance
Route::get('/api-attendances', [App\Http\Controllers\Api\AttendanceController::class, 'index'])->middleware('auth:sanctum');
