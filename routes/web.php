<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\HakAksesPermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
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

// auth

Route::get('/login',[AuthController::class,'login'])->name('login');
Route::post('/postlogin',[AuthController::class,'postlogin'])->name('postlogin');
Route::get('/register',[AuthController::class,'register'])->name('register');
Route::post('/postregister',[AuthController::class,'postregister'])->name('postregister');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::group(['middleware' => ['auth']], function(){

    Route::get('/', [DashboardController::class,'index'])->name('dashboard');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('/users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/delete/{id}', [UserController::class, 'destroy'])->name('users.destroy');
    
    Route::get('/menu/list',[MenuController::class,'index'])->name('menu.index');
    Route::get('/menu/create',[MenuController::class,'create'])->name('menu.create');
    Route::post('/menu/store',[MenuController::class,'store'])->name('menu.store');
    Route::get('/menu/delete/{id}',[MenuController::class,'destroy'])->name('menu.delete');

    Route::get('/hak-akses/list',[HakAksesPermissionController::class,'index'])->name('hak-akses.index');
    Route::get('/hak-akses/edit/{id}',[HakAksesPermissionController::class,'edit'])->name('hak-akses.edit');
    Route::put('/hak-akses/update/{id}',[HakAksesPermissionController::class,'update'])->name('hak-akses.update');
    
    Route::get('/{menu}',[PengajuanController::class,'index'])->name('menu');
    Route::get('/create/{menu}',[PengajuanController::class,'create'])->name('create');
    Route::get('/detail/{menu}/{id}',[PengajuanController::class,'show'])->name('show');
    Route::post('/{menu}',[PengajuanController::class,'store'])->name('store');
    Route::put('/update/{menu}/{id}',[PengajuanController::class,'update'])->name('update');
    
});


