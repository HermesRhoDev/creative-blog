<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController as AdminPostController;

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

// Route::get('/', fn() => view('welcome'));

Route::get('/hello-creative', fn() => view('hello-creative'));

Route::get('/', [PageController::class, 'home']);

Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';