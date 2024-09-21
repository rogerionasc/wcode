<?php

use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\MemberHomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui você pode registrar as rotas web para a aplicação.
|
*/

// Rotas de Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'auth']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Rotas Admin protegidas por middleware
Route::middleware(['auth:sanctum'])->group(function () {

    // Rotas Admin
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminHomeController::class, 'Index'])->name('admin.home');
        Route::get('dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');
        
        // Rotas de Usuários
        Route::prefix('user')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('admin.user');
            Route::get('fetchUsers', [UserController::class, 'fetchUsers'])->name('admin.users.fetch');
            Route::post('store', [UserController::class, 'store'])->name('admin.users.store');
            Route::delete('delete/{id}', [UserController::class, 'delete'])->name('admin.user.delete');
            Route::put('update/{id}', [UserController::class, 'update'])->name('admin.user.update');
        });

        // Rotas de Cargo/Função
        Route::prefix('roles')->group(function () {
            Route::get('fetchRoles', [RoleController::class, 'index'])->name('admin.roles.fetch');
        });
    });

    // Rotas Member
    Route::prefix('/')->group(function () {
        Route::get('/home', [MemberHomeController::class, 'index'])->name('member.home');

    });

    // Rotas Gerais
    Route::get('/', [AdminHomeController::class, 'Index']);

});

// Rotas de Teste
// Route::get('update', [UserController::class, 'update']);
