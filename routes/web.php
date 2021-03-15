<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () { return view('home'); });

Route::middleware(['guest'])->group(function () {
    Route::get('/signup', function () {   return view('auth.signup'); })->name('signup');;

    Route::post('/signup',[UserController::class, 'signup']);

    Route::get('/login', function () {   return view('auth.login'); })->name('login');
    Route::post('/login',[UserController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/owner', function () {   return view('user.owner'); })->middleware('role:owner');
    Route::get('/admin', function () {   return view('user.admin'); })->middleware('role:admin');
    Route::get('/subscriber', function () {   return view('user.subscriber'); })->middleware('role:subscriber');
    Route::get('/logout', function () { Auth::logout(); return redirect('/login');    })->name('logout');
});
