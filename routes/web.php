<?php
use App\Http\Controllers\AdminHomeController;
use App\Http\Controllers\MemberHomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

// Rotas de Login
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'auth']);

// Rotas protegidas
Route::middleware(['auth:sanctum'])->group(function () {

    // Rotas de Logout
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

    // Rotas Admin
    Route::middleware(['role:Administrador'])->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminHomeController::class, 'index'])->name('admin.home');
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

            // Rotas de Configuração
            Route::prefix('settings')->group(function () {
                Route::get('/', [SettingsController::class, 'index'])->name('admin.settings');
            });
        });
    });

    // Rotas Member
    Route::prefix('/')->group(function () {
        Route::get('/home', [MemberHomeController::class, 'index'])->name('home');
        Route::get('/user', [MemberHomeController::class, 'index'])->name('user');
    });

    // Rotas de Configuração
    Route::prefix('settings')->group(function () {
        Route::get('/', [SettingsController::class, 'index'])->name('settings');
    });

    // Rotas Gerais
    Route::get('/', [AdminHomeController::class, 'index']);
});

// Rotas de Teste
Route::get('getRole', [PermissionController::class, 'getPermissionsByCategory']);
