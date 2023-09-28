<?php

use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\BranchController;
use App\Http\Controllers\Admin\ClassificationController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DocumentTypeController;
use App\Http\Controllers\Admin\FilesController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Front\UserLoginController;
use App\Http\Controllers\Front\UserHomeController;
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
Route::get('/', function () {
    return view('auth/login');
});
Auth::routes();
Route::middleware('auth')->group(function (){
    Route::get('/',[UserHomeController::class, 'index'])->name('userHome');

    //Admin Side routes
    Route::prefix('admin')->middleware('admin')->group(function () {
        //Dashboard
        Route::get('/',[HomeController::class, 'index'])->name('home');
        //Users
        Route::resource('/users', UserController::class);
        //Roles
        Route::resource('/role', RoleController::class);
        // Settings
        Route::resource('/setting', SettingController::class)->only('edit','update');
        //Profile
        Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
        Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
        //AJAX Request
        Route::post('ajax/{method}', [AjaxController::class, 'handle'])->name('ajax.handle');
        Route::resource('/branches',BranchController::class);
        Route::resource('/departments',DepartmentController::class);
        Route::resource('/files',FilesController::class);
        Route::resource('/classifications',ClassificationController::class);
        Route::resource('/document_types',DocumentTypeController::class);
        Route::resource('/documents',DocumentController::class);
        Route::post('/printDocument',[\App\Http\Controllers\PDFController::class,'printDocument'])->name('printDocument');
    });
});
