<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth; // Add this line
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class DashboardPostController extends Controller
{
    public function index(){
        return view('dashboard.posts.index',[
            'posts' => Post::where('author_id', Auth::user()->id)->get() // Updated
        ]);
    }
    public function create(){
        return view('dashboard.posts.create',[
            'categories' => Category::all()
        ]);
    }
    public function about(){
        return view('Dashboard.about');
    }

    public function store(Request $request){
        
        $validatedData = $request->validate([
            'title' => 'required',
            'slug' => 'required|unique:posts',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        $validatedData['author_id'] = Auth::user()->id; // Updated
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        $validatedData['body'] = strip_tags($request->body); // Sanitize body

        Post::create($validatedData);
        return redirect('/dashboard/posts')->with('status', 'Post created successfully!');
    }

    public function show(Post $post){
        return view('dashboard.posts.show', [
            'post' => $post
        ]);
    }

    public function destroy(Post $post){

        if($post->image){
            Storage::delete($post->image);
        }

        Post::destroy($post->id);
        return redirect('/dashboard/posts')->with('delete', 'Post has been deleted!');
    }
    
    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
    
    public function edit(Post $post){
        return view('dashboard.posts.edit', [
            'post' => $post,
            'categories' => Category::all()
        ]);
    }

    public function update(Request $request, Post $post){
        $rules = [
            'title' => 'required',
            'category_id' => 'required',
            'image' => 'image|file|max:1024',
            'body' => 'required',
        ];

        $validatedData = $request->validate($rules);

        if($request->file('image')){
            if($post->image){
                Storage::delete($post->image);
            }
            $validatedData['image'] = $request->file('image')->store('post-images');
        }
        $validatedData['author_id'] = Auth::user()->id; // Updated
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body), 200);
        $validatedData['body'] = strip_tags($request->body); // Sanitize body
        $validatedData['slug'] = $request->slug;

        $post->update($validatedData);
        return redirect('/dashboard/posts')->with('update', 'Post has been updated!');
    }
}

