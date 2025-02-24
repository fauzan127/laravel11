<x-layout>
    <x-slot:title>{{ $title ?? 'Home Page' }}</x-slot:title>

    <div class="container">
        <!-- Slider Container -->
        <div class="swiper-container">
            <div class="swiper-wrapper">
                @foreach ($sliders as $slider)
                    <div class="swiper-slide">
                        <div class="rounded-lg shadow-xl overflow-hidden border border-black">
                            <div class="relative max-h-[600px]"">
                                @if ($slider->image)
                                    <img src="{{ asset('storage/' . $slider->image) }}" alt="{{ $slider->title }}"
                                        class="w-full object-cover rounded-lg">
                                    <div
                                        class="absolute bottom-0 left-0 w-full p-6 rounded-b-lg bg-gradient-to-t from-white/80 to-black/30">
                                        <h3
                                            class="text-xl font-semibold text-gray-900 hover:text-indigo-600 transition duration-300">
                                            {{ $slider->title }}
                                        </h3>
                                        <p class="text-gray-900 mt-2">
                                            {{ Str::limit(strip_tags($slider->description), 150, '...') }}
                                        </p>
                                    </div>
                                @else
                                    <img src="https://stg-uploads.slidenest.com/template_2552/templateColor_2450/previewImages/beginner-coding-modern-powerpoint-google-slides-keynote-presentation-26.jpeg"
                                        alt="{{ $slider->title }}" class="w-full object-cover rounded-lg">
                                    <div
                                        class="absolute bottom-0 left-0 w-full p-6 rounded-b-lg bg-gradient-to-t from-white/80 to-black/30">
                                        <h3
                                            class="text-xl font-semibold text-gray-900 hover:text-indigo-600 transition duration-300">
                                            {{ $slider->title }}
                                        </h3>
                                        <p class="text-gray-900 mt-2">
                                            {{ Str::limit(strip_tags($slider->description), 150, '...') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <hr class="my-6 mt-10 border-gray-300">
    <h2 class="text-center text-5xl font-bold mb-10">News</h2>
    <div class="my-4 px-2 mx-auto max-w-screen-xl lg:py-4 lg:px-0">
        <div class="grid gap-8 md:grid-cols-3">
            @forelse ($posts as $post)
                <article
                    class="p-6 bg-gradient-to-br from-gray-50 to-gray-300 text-white rounded-lg border border-gray-700 shadow-md transform transition-transform duration-300 hover:scale-105">
                    <div class="relative overflow-hidden rounded-lg">
                        @if ($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->category->name }}"
                                class="w-full h-60 object-cover transition-opacity duration-300 ">
                        @else
                            <img src="https://stg-uploads.slidenest.com/template_2552/templateColor_2450/previewImages/beginner-coding-modern-powerpoint-google-slides-keynote-presentation-26.jpeg"
                                alt="{{ $post->category->name }}"
                                class="w-full h-60 object-cover transition-opacity duration-300 ">
                        @endif
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-5 text-gray-500">
                            <a href="/posts?category={{ $post->category->slug }}">
                                <span
                                    class="text-white text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded"
                                    style="background: linear-gradient(to right, 
                                @if ($post->category->color == 'red') #0dcaf0, #e25858
                                @elseif($post->category->color == 'green') #2e8b57, #66cdaa
                                @elseif($post->category->color == 'blue') #bdc3c7, #3b82f6
                                @elseif($post->category->color == 'yellow') #b8860b, #f1c40f
                                @else #7f8c8d, #bdc3c7 @endif);">
                                    {{ $post->category->name }}
                                </span>
                            </a>
                            <span class="text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        </div>
                        <a href="/posts/{{ $post->slug }}" class="hover:underline">
                            <h2 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-gray-900">
                                {{ $post->title }}
                            </h2>
                        </a>
                        <p class="mb-5 font-light text-gray-500 dark:text-gray-400">
                            {{ Str::limit(strip_tags($post->body), 150) }}</p>
                        <div class="flex justify-between items-center">
                            <a href="/posts?author={{ $post->author->username }}">
                                <div class="flex items-center space-x-3">
                                    <img class="w-7 h-7 rounded-full"
                                        src="https://flowbite.s3.amazonaws.com/blocks/marketing-ui/avatars/jese-leos.png"
                                        alt="{{ $post->author->name }}" />
                                    <span class="font-medium text-xs text-black">
                                        {{ $post->author->name }}
                                    </span>
                                </div>
                            </a>
                            <a href="/posts/{{ $post['slug'] }}"
                                class="inline-flex items-center font-medium text-white bg-primary-600 border border-primary-600 px-3 py-1.5 rounded-lg hover:bg-primary-700 hover:border-primary-700 text-xs transition-all duration-300">
                                Read more
                                <svg class="ml-2 w-4 h-4" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </article>
            @empty
                <div>
                    <p class="font-bold text-xl my-4">Article not found!</p>
                    <a href="/" class="block text-blue-500 hover:underline">&laquo; Back to all posts</a>
                </div>
            @endforelse
        </div>
    </div>
    <!-- SwiperJS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <style>
        html,
        body {
            overflow-x: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .swiper-container {
            width: 90%;
            max-width: 100vw;
            margin: 0 auto;
            overflow: hidden;
        }

        .container {
            max-width: 100%;
            overflow-x: hidden;
        }

        .swiper-slide {
            transition: transform 0.5s ease;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #2635d7;
            border-radius: 50%;
        }
    </style>

    <!-- SwiperJS Script -->
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.swiper-container', {
                slidesPerView: 1,
                spaceBetween: 30,
                loop: true,
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
            });
        });
    </script>
</x-layout>
