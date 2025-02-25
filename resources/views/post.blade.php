<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
<main class="pt-10 pb-20 lg:pt-20 lg:pb-28 bg-gray-100 dark:bg-gray-900 antialiased">
    <div class="container mx-auto px-6 md:px-12 lg:px-24 max-w-6xl">
        <article class="bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden p-8">
            <header class="mb-6 border-b pb-6">
                <a href="/posts" class="font-medium text-xl text-blue-600 flex items-center relative">
                    <span class="border bg-blue-300 border-blue-600 px-1 hover:bg-blue-600 hover:text-white transition-all duration-200 rounded-md">
                        &laquo; Back
                    </span>
                </a>
                <address class="flex items-center mt-6 not-italic">
                    <img class="mr-4 w-16 h-16 rounded-full border-2 border-blue-500" src="https://flowbite.com/docs/images/people/profile-picture-2.jpg" 
                        alt="{{ $post->author->name }}">
                    <div>
                        <a href="/posts?author={{ $post->author->username }}" rel="author" 
                            class="text-xl font-bold text-gray-900 dark:text-white hover:text-blue-500 transition duration-300">{{ $post->author->name }}</a>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $post->created_at->diffForHumans() }}</p>
                        <a href="/posts?category={{ $post->category->slug }}" class="inline-block mt-2">
                            <span class="bg-{{ $post->category->color }}-100 text-{{ $post->category->color }}-800 text-xs font-medium px-3 py-1 rounded-full dark:bg-{{ $post->category->color }}-200 dark:text-{{ $post->category->color }}-900">
                                {{ $post->category->name }}
                            </span>
                        </a>
                    </div>
                </address>
                <h1 class="mt-4 text-4xl font-extrabold leading-tight text-gray-900 dark:text-white">{{ $post->title }}</h1>
            </header>        
            @if ($post->image)
                <div class="overflow-hidden rounded-lg shadow-md mb-6">
                    <img class="w-full max-h-[400px] object-cover" src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}">
                </div>
            @else
                <img class="w-full max-h-[400px] object-cover rounded-lg shadow-md mb-6" src="https://stg-uploads.slidenest.com/template_2552/templateColor_2450/previewImages/beginner-coding-modern-powerpoint-google-slides-keynote-presentation-26.jpeg" alt="{{ $post->category->name }}">
            @endif       
            <div class="prose max-w-none prose-lg dark:prose-invert">{!! $post->body !!}</div>
        </article>
    </div>
</main>
</x-layout>
