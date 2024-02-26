<?php

use App\Http\Controllers\Authcontroller;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
    return view('welcome');
});

Route::get('/login',[Authcontroller::class, 'index'])->name('auth.index')->middleware('guest');
Route::post('/login',[Authcontroller::class, 'verify'])->name('auth.verify');

Route::group(['middleware' =>'auth:user'], function(){
    Route::prefix('admin')->group(function(){
        Route::get('/',[DashboardController::class, 'index'])->name('dashboard.index');
        Route::get('/profile',[DashboardController::class, 'profile'])->name('dashboard.profile');
    });
    Route::get('/logout',[Authcontroller::class, 'logout'])->name('auth.logout');
});


