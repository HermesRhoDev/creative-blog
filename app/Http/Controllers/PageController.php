<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PageController extends Controller
{
    public function home() {
        $posts = Post::with('category')->where('isPublished', true)->latest()->get();

        return view('pages.home', ['posts' => $posts]);
    }
}
