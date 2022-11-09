<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::with('category', 'tags')->latest()->get();

        return view('admin.posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();

        return view('admin.posts.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->slug = Str::slug($request->title, '-');
        $post->description = $request->description;
        if ($request->hasFile('image_file_name')) {
            $file = $request->file('image_file_name');
            $file_name = Str::uuid() . '.' . $file->getClientOriginalName();

            $destinationPathThumbnail = public_path('images/thumbnail');
            $image_thumbnail = Image::make($file->getPathname());
            $image_thumbnail->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail . '/' . $file_name);

            $destinationPathMedium = public_path('images/medium');
            $image_medium = Image::make($file->getPathname());
            $image_medium->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathMedium . '/' . $file_name);

            $file->move(public_path('images'), $file_name);
            $post->image_file_name = $file_name;
        }        
        $post->category_id = $request->category_id;
        $post->isPublished = isset($request->isPublished) ? 1 : 0;

        $post->save();

        if(isset($request->tags)){
            $post->tags()->attach($request->tags);
        }

        session()->flash('success', "L'article a nie, été enregistré");

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $post = Post::query()
            ->where('id', $request->id)
            ->where('slug', $request->slug)
            ->firstOrFail();

        return view("pages.article", compact("post"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();

        $tags = Tag::all();

        return view("admin.posts.create", compact("post", "categories", "tags"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $update = Post::find($id);

        $update->title = $request->get('title');
        $update->slug = Str::slug($request->get('title'), "-");
        $update->description = $request->get('description');
        if(isset($request->image_file_name)){
            if($update->image_file_name != null) {
                File::delete(public_path('images/' . $update->image_file_name));
                File::delete(public_path('images/thumbnail/' . $update->image_file_name));
                File::delete(public_path('images/medium/' . $update->image_file_name));
            }

            $file = $request->file('image_file_name');
            $file_name = Str::uuid() . '.' . $file->getClientOriginalName();

            $destinationPathThumbnail = public_path('images/thumbnail');
            $image_thumbnail = Image::make($file->getPathname());
            $image_thumbnail->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathThumbnail . '/' . $file_name);

            $destinationPathMedium = public_path('images/medium');
            $image_medium = Image::make($file->getPathname());
            $image_medium->resize(300, 300, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPathMedium . '/' . $file_name);

            $file->move(public_path('images'), $file_name);
            $update->image_file_name = $file_name;
        }
        if(isset($request->tags)){
            $update->tags()->sync($request->tags);
        }
        $update->category_id = $request->get('category_id');
        $update->isPublished = isset($request->isPublished) ? 1 : 0;
        $update->save();

        session()->flash('success', "L'article a bien été modifié");

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::where('id', $id)->first();

        if($post->image_file_name != null){
            File::delete(public_path('images/' . $post->image_file_name));
            File::delete(public_path('images/thumbnail/' . $post->image_file_name));
            File::delete(public_path('images/medium/' . $post->image_file_name));
        }

        $post->delete();

        session()->flash('success', "L'article a bien, été supprimé");

        return redirect()->route('posts.index');
    }
    // LARAVEL ELOQUENT DESTROY ALL TRUNCATE TO DO
    public function truncate()
    {
        $array_full = [];
        $array_thumbnail = [];
        $array_medium = [];

        $posts = Post::all();

        foreach($posts as $post){
            $array_full[] = public_path('images/' . $post->image_file_name);
            $array_thumbnail[] = public_path('images/thumbnail/' . $post->image_file_name);
            $array_medium[] = public_path('images/medium/' . $post->image_file_name);
        }

        File::delete($array_full);
        File::delete($array_thumbnail);
        File::delete($array_medium);

        $posts->map->delete();

        DB::statement("SET foreign_key_checks=0");
        Post::truncate();
        DB::statement("SET foreign_key_checks=1");

        session()->flash('success', "L'ensemble des articles a été correctement supprimé !");

        return redirect()->route('posts.index');
    }
}
