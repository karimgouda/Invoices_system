<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\InvoiceArchiveController;
use App\Http\Controllers\InvoiceAttachmentsController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\InvoicesDetalisController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::get('/dashboard', function () {
    return view('index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::resource('invoices',InvoicesController::class);
Route::resource('sections',SectionController::class);
Route::resource('products',ProductsController::class);
Route::get('/section/{id}',[InvoicesController::class,"getProducts"]);
Route::get('/invoicesDetalis/{id}',[InvoicesDetalisController::class,"getSection"]);
Route::get('download/{invoice_number}/{file_name}',[InvoicesDetalisController::class,"download"]);
Route::resource('InvoiceAttachments',InvoiceAttachmentsController::class);
Route::get('/Status_show/{id}', [InvoicesController::class,"show"])->name('Status_show');
Route::get('Invoice_Paid',[InvoicesController::class,'Invoice_Paid']);

Route::middleware('admin')->group(function(){
    Route::post('/Status_Update/{id}',[InvoicesController::class,"Status_Update"])->name('Status_Update');
    Route::get('Invoice_UnPaid',[InvoicesController::class,'Invoice_UnPaid']);
    Route::delete('/{id}',[InvoicesDetalisController::class,"destroy"]);
    Route::get('Print_invoice/{id}',[InvoicesController::class,"Print_invoice"]);
    Route::get('edit_invoice/{id}',[InvoicesController::class,"edit"]);
    
    Route::get('add-user',[AuthController::class,"add"]);
    Route::post('new-user',[AuthController::class,"addUser"]);
    Route::get('allUsers',[AuthController::class,"allUsers"]);
    Route::get('edit/{id}',[AuthController::class,"edit"]);
    Route::put('edit_user/{id}',[AuthController::class,"editUser"]);
    Route::delete('delete/{id}',[AuthController::class,"delete"]);
});

Route::get('/{page}', [AdminController::class,"index"]);
