<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';

//Role management
Route::get('/rolemanager', [RoleController::class, 'roleManager']);
Route::post('/role/create', [RoleController::class, 'roleCreate']);
Route::get('/role/edit/{id}', [RoleController::class, 'roleEdit']);
Route::post('/role/update/{id}', [RoleController::class, 'roleUpdate']);
Route::get('/role/delete/{id}', [RoleController::class, 'roleDelete']);


//User management
Route::get('/usermanager', [UserController::class, 'userManager']);
Route::post('/roleassign', [UserController::class, 'roleAssign']);
Route::get('/user/edit/{id}', [UserController::class, 'userEdit']);
Route::post('/user/update/{id}', [UserController::class, 'userUpdate']);
Route::get('/user/delete/{id}', [UserController::class, 'userDelete']);
Route::get('/usercreate', [UserController::class, 'userCreate']);
Route::post('/usercreatedone', [UserController::class, 'userCreatedone']);
