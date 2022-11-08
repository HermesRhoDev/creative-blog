<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class PageController extends Controller
{
    public function home() {
        $posts = Post::with('category')->where('isPublished', true)->latest()->get();

        $categories = Category::query()->orderBy('title', 'asc')->get();

        $tags = Tag::query()->orderBy('title', 'asc')->get();

        return view('pages.home', ['posts' => $posts, 'categories' => $categories, 'tags' => $tags]);
    }
}
