<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

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
Route::get('/', [AdminController::class, 'index'])->name('admin.index');
Route::get('add', [AdminController::class, 'create'])->name('admin.create');
Route::post('store', [AdminController::class, 'store'])->name('admin.store');
Route::get('edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
Route::post('update/{id}', [AdminController::class, 'update'])->name('admin.update');
Route::post('delete/{id}', [AdminController::class, 'delete'])->name('admin.delete');

// Route untuk fitur trash
Route::get('trash', [AdminController::class, 'trash'])->name('admin.trash');
Route::get('restore/{id}', [AdminController::class, 'restore'])->name('admin.restore');
Route::get('restore-all', [AdminController::class, 'restoreAll'])->name('admin.restore.all');
Route::delete('force-delete/{id}', [AdminController::class, 'forceDelete'])->name('admin.force.delete');