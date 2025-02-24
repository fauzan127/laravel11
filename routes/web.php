<?php

use App\Models\Post;
use App\Models\User;
use App\Models\Slider;
use App\Models\Category;
use Illuminate\Support\Arr;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthnController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminCategoryController;
use App\Http\Controllers\DashboardPostController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    $sliders = Slider::latest()->get();
    $posts = Post::latest()->take(12)->get(); // Fetch all posts

    return view('home', [
        'title' => 'Halaman Utama',
        'sliders' => $sliders,
        'posts' => $posts // Pass posts to the view
    ]);
});

Route::get('/about', function () {
    return view('about', ['name' => 'Fauzan Rosyad', 'title' => 'About']);
});

Route::get('/posts', function () {
    $filters = request(['search', 'category', 'author', 'recent']);

    $query = Post::filter($filters)->latest();
    $latestPosts = Post::latest()->get();
    if (request('recent')) {
        $posts = $query->take(5)->get();
    } 
    else {
        $posts = $query->paginate(16)->withQueryString();
    }
    return view('posts', [
        'title' => 'Posts',
        'posts' => $posts,
        'latestPosts' => $latestPosts
        
    ]);
});
 
Route::get('/posts/{post:slug}', function (Post $post) {
    return view('post', ['title' => 'Single post', 'post' => $post]);
});

Route::get('/authors/{user:username}', function (User $user) {  
    return view('posts', ['title' => count($user->posts) . ' Articles by '. $user->name, 'posts' =>
     $user->posts]);
});

Route::get('/categories/{category:slug}', function (Category $category) { 
    return view('posts', ['title' =>' Articles in : '. $category->name, 'posts' =>
    $category->posts]);
});

Route::get('/contact', function () {
    return view('contact', ['title' => 'Contact']);
});

Route::get('/login', [AuthnController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthnController::class, 'authenticate']);

Route::get('/register', [RegisterController::class, 'showLoginForm'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']); 

Route::post('/logout', [AuthnController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/dashboard/posts/checkSlug', [DashboardPostController::class, 'checkSlug'])->middleware('auth');
Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

Route::resource('/dashboard/categories', AdminCategoryController::class)->except('show')->middleware(IsAdmin::class);

Route::middleware(IsAdmin::class)->group(function () {
    Route::get('/dashboard/slider/index', [SliderController::class, 'index'])->name('dashboard.slider.index');
    Route::get('/dashboard/slider/create', [SliderController::class, 'create'])->name('dashboard.slider.create');
    Route::post('/dashboard/slider', [SliderController::class, 'store'])->name('dashboard.slider.store');
    Route::get('/dashboard/slider/edit/{slider}', [SliderController::class, 'edit'])->name('dashboard.slider.edit');
    Route::put('/dashboard/slider/{slider}', [SliderController::class, 'update'])->name('dashboard.slider.update');
    Route::delete('/dashboard/slider/{id}', [SliderController::class, 'destroy'])->name('dashboard.slider.destroy');
});
