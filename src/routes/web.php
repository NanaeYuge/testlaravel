<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AdminController;

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

//お問い合わせ入力ページ
Route::get('/', [ContactController::class, 'index'])->name('contact.index');

//確認画面
Route::post('/confirm', [ContactController::class, 'confirm'])->name('confirm');

//サンクスページ
Route::get('/thanks', [ContactController::class, 'thanks'])->name('thanks');
Route::post('/send', [ContactController::class, 'send'])->name('send');

Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

Route::get('/register', function () {
    return view('auth.register');
})->name('register.form');

Route::middleware('auth')->group(function () {
    Route::get('/admin/export', [AdminController::class, 'export'])->name('admin.export');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{contact}', [AdminController::class, 'detail'])->name('admin.detail');
    Route::delete('/admin/{id}', [AdminController::class, 'destroy'])->name('admin.destroy');
});

Route::post('/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken(); 
    return redirect('/login'); 
})->name('logout');

Route::get('/admin/contact/{id}', [AdminController::class, 'show']);





