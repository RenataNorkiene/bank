<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\TransfersController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    if (auth::check()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
})->name('login');

Route::get('/transfer-{type}', [\App\Http\Controllers\TransfersController::class, 'create_transfer']);
Route::post('/transfer-{type}', [\App\Http\Controllers\TransfersController::class, 'store_transfer']);
Route::get('/account', function () {
    if (auth::check()) {
        return redirect()->route('home');
    } else {
        return redirect()->route('login');
    }
})->name('login');
Route::get('/account/{account_number}/details', [\App\Http\Controllers\TransfersController::class, 'transfers_by_account']);
Route::get('/account/create', [\App\Http\Controllers\AccountsController::class, 'create_account_form']);
Route::post('/account/create', [\App\Http\Controllers\AccountsController::class, 'store']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\AccountsController::class, 'account_list'])->name('home');
Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout']);
