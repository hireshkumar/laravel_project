<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DefineController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('upload', function () {
    return view('upload');
});
Route::post('upload', [DataController::class, 'store'])->name('student_data');


// Route::middleware(['guest'])->group(function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [DefineController::class, 'register']); 
// });

Route::middleware(['auth.sessionex'])->group(function () {
    
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');    
    Route::get('records', [DefineController::class, 'records'])->name('records');
    Route::get('delete_record/{id}', [DefineController::class, 'delete_record'])->name('delete_record');
    Route::get('edit_record/{id}', [DefineController::class, 'edit_record'])->name('edit_record');
    Route::post('update_data/{id}', [DefineController::class, 'update_data'])->name('update_data');
    Route::get('toggle_status/{id}', [DefineController::class, 'toggleStatus'])->name('toggle_status');
    Route::get('/file', [DefineController::class, 'index'])->name('file');
    Route::post('/register', [DefineController::class, 'register']);
    Route::post('/student_data', [DefineController::class, 'student_data']);
    Route::get('/get-cities/{state_id}', [DefineController::class, 'getCities']);
});
