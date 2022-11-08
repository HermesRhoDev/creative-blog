<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;

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
Route::get('/category/{id}', [AdminCategoryController::class, 'show'])->name('category.show');
Route::get('/tag/{id}', [AdminTagController::class, 'show'])->name('tag.show');

Route::group(['middleware' => 'auth', 'prefix'=> 'admin'], function () { 
    //************************** */ MENU DASHBOARD \* ******************************** \\
    Route::get('/', fn () => view('dashboard'))->name('dashboard');

    //************************** */ CATEGORIES PART \* ******************************** \\
    Route::get('categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::get('categories/create', [AdminCategoryController::class, 'create'])->name('categories.create');
    Route::post('categories/store', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::get('categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('categories.edit');
    Route::post('categories/destroy/{id}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');
    Route::put('categories/{id}', [AdminCategoryController::class, 'update'])->name('categories.update');

    //************************** */ TAGS PART \* ******************************** \\
    Route::get('tags', [AdminTagController::class, 'index'])->name('tags.index');
    Route::get('tags/create', [AdminTagController::class, 'create'])->name('tags.create');
    Route::post('tags/store', [AdminTagController::class, 'store'])->name('tags.store');
    Route::get('tags/{tag}/edit', [AdminTagController::class, 'edit'])->name('tags.edit');
    Route::post('tags/destroy/{id}', [AdminTagController::class, 'destroy'])->name('tags.destroy');
    Route::put('tags/{id}', [AdminTagController::class, 'update'])->name('tags.update');

    //************************** */ POSTS PART \* ******************************** \\
    Route::get('posts', [AdminPostController::class, 'index'])->name('posts.index');
    Route::get('posts/create', [AdminPostController::class, 'create'])->name('posts.create');
    Route::get('posts/{post}/edit', [AdminPostController::class, 'edit'])->name('posts.edit');
    Route::post('posts/store', [AdminPostController::class, 'store'])->name('posts.store');
    Route::post('posts/destroy/{id}', [AdminPostController::class, 'destroy'])->name('posts.destroy');
    Route::put('posts/{id}', [AdminPostController::class, 'update'])->name('posts.update');
    Route::post('posts/truncate', [AdminPostController::class, 'truncate'])->name('posts.truncate');
});

// Route::group(['middleware' => 'auth', 'prefix'=> 'admin', 'as' => 'admin.'], function () { 
//     Route::get('/', fn () => view('dashboard'))->name('dashboard');
// });

require __DIR__.'/auth.php';