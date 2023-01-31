<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LaporanCOntroller;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class, 'index'])->name('home.index');
Route::get('/login',[HomeController::class, 'login'])->name('login');
Route::post('/login/post',[HomeController::class, 'login_post'])->name('login.post');
Route::get('/register',[HomeController::class, 'register'])->name('register');

Route::get('/logout',[HomeController::class, 'logout'])->name('logout');

Route::post('/register/post',[HomeController::class, 'register_post'])->name('register.post');


Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard/index',[DashboardController::class, 'index'])->name('dashboard.index');
    Route::post('/dashboard/update/qrcode',[DashboardController::class, 'update_qrcode'])->name('dashboard.update_qrcode');
    Route::post('/dashboard/update/idtiket',[DashboardController::class, 'update_idtiket'])->name('dashboard.update_idtiket');

    Route::get('/laporan/index',[LaporanCOntroller::class, 'index'])->name('laporan.index');
    Route::post('/laporan/update/{id}',[LaporanCOntroller::class, 'update'])->name('laporan.update');
    Route::get('/laporan/destroy/{id}',[LaporanCOntroller::class, 'destroy'])->name('laporan.destroy');
});
