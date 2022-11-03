<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home() {
        // $posts = Post::latest()->get();

        // return view('pages.home', ['posts' => $posts]);

        return view('pages.home', ['posts' => collect()]);
    }
}
