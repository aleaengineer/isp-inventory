<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExportController;

Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('items/import/template', [ItemController::class, 'template'])->name('items.import.template');
    Route::get('items/import', [ItemController::class, 'importForm'])->name('items.import.form');
    Route::post('items/import', [ItemController::class, 'import'])->name('items.import');
    Route::resource('items', ItemController::class);
    Route::get('items/{item}/print-label', [ItemController::class, 'printLabel'])->name('items.print-label');
    Route::resource('categories', CategoryController::class);
    Route::resource('transactions', TransactionController::class)->except(['edit', 'update']);
    Route::resource('suppliers', SupplierController::class);

    Route::middleware('role:admin')->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::get('export/items/xlsx', [ExportController::class, 'itemsXlsx'])->name('items.export.xlsx');
    Route::get('export/transactions/xlsx', [ExportController::class, 'transactionsXlsx'])->name('transactions.export.xlsx');
});
