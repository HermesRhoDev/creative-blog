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
// Route::get('/hello-creative', fn() => view('hello-creative'));

Route::get('/', [PageController::class, 'home']);
Route::get('/posts', [AdminPostController::class, 'index'])->name('posts.index');
Route::get('/posts/create', [AdminPostController::class, 'create'])->name('posts.create');
Route::get('/dashboard', function () {return view('dashboard');})->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/posts/{id}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
Route::get('/posts/show/{slug}-{id}', [AdminPostController::class, 'show'])->name('posts.show');

Route::post('/posts/store', [AdminPostController::class, 'store'])->name('posts.store');
Route::post('/posts/destroy/{id}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
Route::post('/posts/{id}', [AdminPostController::class, 'update'])->name('posts.update');

require __DIR__.'/auth.php';