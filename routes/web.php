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

//Route::get('/', function () {
//    return Inertia::render('Welcome', [
//        'canLogin' => Route::has('login'),
//        'canRegister' => Route::has('register'),
//        'laravelVersion' => Application::VERSION,
//        'phpVersion' => PHP_VERSION,
//    ]);
//});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Router User //
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login', [LoginController::class, 'auth'])->name('login');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

// Router User //
Route::middleware(['auth', 'verified'])->get('/', [HomeController::class, 'Index'])->name('home.admin');
Route::middleware(['auth', 'verified'])->get('admin/dashboard', [HomeController::class, 'index'])
    ->name('admin.dashboard');
Route::middleware(['auth', 'verified'])->get('register/user', [UserController::class, 'index'])
    ->name('admin.user');

Route::middleware(['auth', 'verified'])->post('register/user', [UserController::class, 'store'])
    ->name('register.store');

Route::get('user', function (){
    $user = new User();
    $user->name = "Teste Name";
    $user->email = "teste@email.com";
    $user->password = "123456";
    $user->save();
});


