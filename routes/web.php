<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Illuminate\Support\Facades\Session;

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

// Router Login //
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'auth']);
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth:sanctum', 'check.permission'])->group(function () {
    // Router Admin//
    Route::get('admin/', [HomeController::class, 'Index'])->name('admin.home');
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');

    Route::prefix('/admin/register')->group(function () {
        Route::get('user', [UserController::class, 'index'])->name('admin.user');
        Route::get('users', [UserController::class, 'fetchUsers'])->name('admin.register.users');
        Route::post('user', [UserController::class, 'store']);
    });
});




//Routas testes

Route::get('user', [UserController::class, 'getRole'])->middleware(['check.permission'])->name("getRole");
Route::get('config/', [UserController::class, 'getRole'])->middleware(['check.permission'])->name("config");
Route::get('config/1/2', [UserController::class, 'getRole'])->middleware(['check.permission'])->name("config");
Route::get('/', [UserController::class, 'getRole'])->middleware(['check.permission'])->name("home");


