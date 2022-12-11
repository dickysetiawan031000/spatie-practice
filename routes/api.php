<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\NewsController;
use App\Http\Controllers\Api\RolePermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::middleware(['auth:api',])->group(function () {
    // News
    Route::apiResource('news', NewsController::class); // declare on constructor
    // Route::post('news', [NewsController::class, 'store'])->middleware('can:news.create'); // declare per endpoint - default laravel
    // Route::post('news', [NewsController::class, 'store'])->middleware('permission:news.create'); // declare per endpoint - spatie/laravel-permission

    // RolePermission
    Route::post('role-permission/check-role-permission', [RolePermissionController::class, 'check_role_permission']);
    Route::post('role-permission/create-role', [RolePermissionController::class, 'create_role']);
    Route::post('role-permission/create-permission', [RolePermissionController::class, 'create_permission']);

    Route::post('role-permission/assign-role', [RolePermissionController::class, 'assign_role']);

    Route::post('role-permission/assign-role-by-user', [RolePermissionController::class, 'assign_role_by_user']);
    Route::post('role-permission/assign-role-by-permission', [RolePermissionController::class, 'assign_role_by_permission']);

    Route::post('role-permission/assign-permission', [RolePermissionController::class, 'assign_permission']);
});
