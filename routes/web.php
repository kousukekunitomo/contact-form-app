<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

// ユーザー向けお問い合わせフォーム
Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/store', [ContactController::class, 'store'])->name('contact.store');
Route::get('/thanks', function () {
    return view('thanks');
})->name('contact.thanks');
Route::post('/', [ContactController::class, 'back'])->name('contact.back');

// 🔽 ログイン画面（GET）にリダイレクト処理を追加
Route::get('/login', function () {
    if (Auth::check()) {
        return redirect('/admin');
    }
    return view('auth.login');
})->name('login');

// 管理画面（ログイン必須）
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [AdminContactController::class, 'show'])->name('contacts.show');
    Route::delete('/contacts/{contact}', [AdminContactController::class, 'destroy'])->name('contacts.destroy');
    Route::get('/export', [AdminContactController::class, 'export'])->name('contacts.export');
});

// POSTログイン（Fortifyが処理）
Route::post('/login', [LoginController::class, 'login'])->name('login');
