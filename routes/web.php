<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\ReportController;
use App\Models\Attendance;

Route::get('/', function () {
    return view('pages.auth.auth-login');
});


Route::middleware(['auth'])->group(function (){
    Route::get('/home', function () {
    return view('pages.dashboard', ['type_menu'=>'home']);
})->name('home');

Route::resource('users', UserController::class);
Route::get('user.export', [UserController::class,'userexport'])->name('user.export');
Route::post('user.import', [UserController::class,'userimport'])->name('user.import');

Route::resource('companies', CompanyController::class);
Route::resource('attendances', AttendanceController::class);
Route::get('/attendances/{id}', 'AttendanceController@show');
Route::resource('permissions', PermissionController::class);

// web.php

Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
Route::post('/reports/print', [ReportController::class, 'print'])->name('reports.print');
Route::post('/reports/export-excel', [ReportController::class, 'exportExcel'])->name('reports.exportExcel');



});


