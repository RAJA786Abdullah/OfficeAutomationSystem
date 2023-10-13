<?php

use App\Http\Controllers\RemarksController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\ClassificationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DocumentTypeController;
use App\Http\Controllers\FilesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
Route::resource('/remarks',RemarksController::class);

Route::post('/printDocument',[\App\Http\Controllers\PDFController::class,'printDocument'])->name('printDocument');
Route::get('/docShow/{id}', [HomeController::class, 'docShow'])->name('docShow');
Route::get('/sendDocToSup/{id}', [DocumentController::class, 'sendDocToSup'])->name('sendDocToSup');

Route::get('audits', [\App\Http\Controllers\AuditController::class,'index'])->name('audit.index');

});
