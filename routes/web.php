<?php

use App\Http\Controllers\PostController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard',['username' => auth()->user()->name]);
})->name('dashboard');

Route::get('/show/{post_id}',[PostController::class,'show']);
Route::post('/cards',[PostController::class,'Cards']);
Route::post('/post/card',[PostController::class,'Post']);
Route::post('/post/store',[PostController::class,'store']);
Route::post('/post/updatecard/{post_id}',[PostController::class,'updatecard']);
Route::post('/post/update',[PostController::class,'update']);
Route::post('/delete/{post_id}',[PostController::class,'delete']);
