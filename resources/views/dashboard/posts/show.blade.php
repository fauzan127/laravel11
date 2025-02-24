
@extends('dashboard.layouts.main')

@section('container')
<main class="pt-8 pb-16 lg:pt-16 lg:pb-24 bg-white dark:bg-gray-900 antialiased">
    <div class="flex justify-between px-4 mx-auto max-w-screen-xl ">
        <article class="mx-auto w-full max-w-4xl format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
            <header class="mb-4 lg:mb-6 not-format">
                <h1 class="mb-4 text-3xl font-extrabold leading-tight text-gray-900 lg:mb-6 lg:text-4xl dark:text-white">{{ $post->title }}</h1>
            </header>
            <div class="mb-4">
                <a href="/dashboard/posts/" class="btn btn-success mr-2">
                    <i class="bi bi-arrow-left"></i> Back to All Posts</a>
                <a href="/dashboard/posts/{{ $post->slug }}/edit" class="btn btn-warning mr-2 text-white"> <!-- Tambahkan text-white -->
                    <i class="bi bi-pencil"></i> Edit</a>                    
                <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="inline bg-red-600 mr-2 btn btn-danger text-white">
                    @csrf
                    @method('delete')
                    <button  onclick="return confirm('Are you sure?')"><i class="bi bi-trash">Delete</i></button>
                </form>
                <p class="text-base text-gray-500 dark:text-gray-400 mt-4">{{ $post->created_at->diffForHumans() }}</p>
                @if ($post->image)
                    <div style="max-height: 350px; overflow:hidden;">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}">
                    </div>
                @else
                    <img src="https://www.algobash.com/wp-content/uploads/2023/03/Online-Coding-Test-in-Java.jpg" alt="{{ $post->category->name }}" class="img-fluid mt-3">
                @endif
                <p>{!!$post->body!!}</p>
            </div>     
        </article>
    </div>
</main>
@endsection