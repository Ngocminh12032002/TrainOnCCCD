<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [UserController::class, 'index'])->name('index');

Route::post('/login', [UserController::class, 'login'])->name('login');

Route::get('/home', [UserController::class, 'home'])->name('home');

Route::get('/quan-ly-model', [UserController::class, 'manageModel'])->name('qlyModel');

Route::put('/quan-ly-model/{id}', [UserController::class, 'updateModel'])->name('updateModel');

Route::delete('/quan-ly-model/{id}', [UserController::class, 'deleteModel'])->name('deleteModel');

Route::get('/chi-tiet-model/{id}', [UserController::class, 'detail'])->name('detailModel');

Route::post('/train', [UserController::class, 'train'])->name('train');

Route::get('/danh-sach-mau', [UserController::class, 'list'])->name('list');

Route::delete('/danh-sach-mau/{id}', [UserController::class, 'delete'])->name('delete');

Route::put('/danh-sach-mau/{id}', [UserController::class, 'update'])->name('update');

Route::post('/retrain', [UserController::class, 'retrain'])->name('retrain');

Route::get('/listWeight', [UserController::class, 'listWeight'])->name('listWeight');
