@extends('dashboard.layouts.main')
@section('container')
<h1 id="greeting" class="text-2xl font-bold"></h1>
<p class="mt-2 text-gray-600">This is your dashboard where you can manage your content.</p>
@can('admin')
<div class="mt-6 flex justify-start">
    <a href="{{ route('dashboard.slider.index') }}" 
       class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 hover:shadow-lg transition-all duration-300 transform hover:scale-105">
       🚀 Kelola Slider
    </a>
</div>
@endcan
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let greetingText = "";
        let emoji = "";
        const hour = new Date().getHours();

        if (hour >= 5 && hour < 12) {
            greetingText = "Good Morning";
            emoji = "🌅";
        } else if (hour >= 12 && hour < 15) {
            greetingText = "Good Afternoon";
            emoji = "🌞";
        } else if (hour >= 15 && hour < 18) {
            greetingText = "Good Evening";
            emoji = "🌇";
        } else {
            greetingText = "Good Night";
            emoji = "🌙";
        }
        // Menyisipkan nama pengguna dari Laravel
        const userName = @json(Auth::user()->name);
        document.getElementById("greeting").innerHTML = `${greetingText}, ${userName}! ${emoji} `;

        // Animasi Fade-in dan Slide-up
        setTimeout(() => {
            greetingElement.classList.remove('opacity-0', 'translate-y-5');
        }, 300);
    });
</script>

@endsection
