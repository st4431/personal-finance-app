<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BalanceController;
use App\Http\Controllers\BalanceSheetController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // 慣習としてurlは複数形にする
    // resourceを使用することで、自動的にurlに名前をつけてくれる
    // これを行うことで、urlが変わったとしても、変更箇所はweb.phpだけに収まる
    Route::resource('accounts', AccountController::class);
    // accounts.balancesは、accounts/{account}/balancesと認識されるらしい
    // accountsというリソース名からLaravelが自動的に{account}というパラメータ名を生成しているらしい
    Route::resource('accounts.balances', BalanceController::class);
    Route::get('/balance-sheet', [BalanceSheetController::class, 'index'])->name('balance-sheets.index');
});


require __DIR__.'/auth.php';
