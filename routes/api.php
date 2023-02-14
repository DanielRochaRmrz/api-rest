<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubmenuController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login-user', [AuthController::class, 'login']);
Route::post('register-user', [AuthController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {

    // Rutas para el controlador usuarios
    Route::post('logout-user', [AuthController::class, 'logout']);
    // Route::post('register-user', [AuthController::class, 'store']);

    // Rutas para el controlador de menus
    Route::get('get-all-menus', [MenuController::class, 'index']);

    // Rutas para el controlador de productos
    Route::get('get-all-products', [ProductController::class, 'index']);

    // Rutas para el controlador de submenus
    Route::get('get-all-submenus', [SubmenuController::class, 'index']);
 });
