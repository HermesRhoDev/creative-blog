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

Route::get('/', [PageController::class, 'home']);
Route::get('/posts/show/{id}-{slug}', [AdminPostController::class, 'show'])->name('posts.show');

Route::group(['middleware' => 'auth', 'prefix'=> 'admin'], function () { 
    Route::get('posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [AdminPostController::class, 'create'])->name('posts.create');
    Route::get('posts/{post}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
    Route::post('posts/store', [AdminPostController::class, 'store'])->name('posts.store');
    Route::post('posts/destroy/{id}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
    Route::put('posts/{id}', [AdminPostController::class, 'update'])->name('posts.update');
});

// Route::group(['middleware' => 'auth', 'prefix'=> 'admin', 'as' => 'admin.'], function () { 
//     Route::get('/', fn () => view('dashboard'))->name('dashboard');
// });

require __DIR__.'/auth.php';