<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
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


// Rotas de Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'auth']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth:sanctum', 'check.permission'])->group(function () {

    // Rotas Admin
    Route::get('admin/', [HomeController::class, 'Index'])->name('admin.home');
    Route::get('/', [HomeController::class, 'Index']);
    Route::get('admin/dashboard', [HomeController::class, 'index'])->name('admin.dashboard');
    // Route::get('pageloader', [HomeController::class, 'pageloader'])->name('pageloader');

    // Rotas de Usuários
    Route::prefix('admin')->group(function () {
        Route::get('user', [UserController::class, 'index'])->name('admin.user');
        Route::get('users', [UserController::class, 'fetchUsers'])->name('admin.users');
        Route::post('user', [UserController::class, 'store']);
        Route::delete('user/delete/{id}', [UserController::class, 'deleteUser'])->name('admin.user.delete');
    });

    Route::prefix('getAll')->group(function () {
        Route::get('fetchRoles', [RoleController::class, 'index']);
    });

        //Rotas para Obter
        // Route::get('getAll')->group(function () {
        //     Route::get('fectRoles', [RoleController::class, 'index']);
        // });

});





//Routas testes

// Route::get('user', [UserController::class, 'getRole'])->middleware(['check.permission'])->name("getRole");
// Route::get('config/', [UserController::class, 'getRole'])->middleware(['check.permission'])->name("config");
// Route::get('config/1/2', [UserController::class, 'getRole'])->middleware(['check.permission'])->name("config");
// Route::get('/', [UserController::class, 'getRole'])->middleware(['check.permission'])->name("home");
// // Route::delete('admin/user/delete/{id}', [UserController::class, 'deleteUser'])->name("user.delete");


