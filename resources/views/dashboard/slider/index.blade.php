@extends('dashboard.layouts.main')
@section('container')
<div class="mt-6">
    <a href="{{ route('dashboard.slider.create') }}" 
       class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
       Tambah Slider
    </a>
</div>

<!-- Tabel untuk daftar slider -->
<div class="mt-6 bg-white shadow-md rounded-lg p-4">
    <h2 class="text-lg font-semibold mb-4">Daftar Slider</h2>
    @foreach (['success' => 'rgba(17, 164, 88, 0.25)', 'update' => 'rgba(17, 164, 88, 0.25)', 'delete' => 'rgba(239, 68, 68, 0.25)'] as $key => $color)
    @if(session()->has($key))
        <div id="flash-message-{{ $key }}" class="flash-message" role="alert" style="text-align: center; padding: 1rem; margin-bottom: 1rem; font-size: 1.25rem; border-radius: 0.5rem; background-color: {{ $color }}; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); animation: fade-in 0.5s ease-out;">
            <p style="font-weight: bold;">{{ session($key) }}</p>
        </div>
    @endif
    @endforeach
    <style>
    @keyframes fade-in {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }}
    @keyframes fade-out {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-10px); }}
    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            setTimeout(function () {
                document.querySelectorAll(".flash-message").forEach(function (el) {
                    el.style.animation = "fade-out 0.5s ease-out";
                    setTimeout(() => el.remove(), 500); // Hapus elemen setelah animasi selesai
                });
            }, 3000); // Hilang setelah 3 detik
        });
    </script>
        <table class="w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
            <tr class="text-center">
                <th class="border p-2">No</th>
                <th class="border p-2">Image</th>
                <th class="border p-2">Title</th>
                <th class="border p-2">Deskripsi</th>
                <th class="border p-2">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($sliders as $index => $slider)
            <tr class="text-center hover:bg-gray-50 transition-all">
                <td class="border p-2">{{ $index + 1 }}</td>
                <td class="border p-2">
                    @if ($slider->image)
                    <div class="flex justify-center items-center">
                    <img 
                        src="{{ asset('storage/' . $slider->image) }}" 
                        alt="{{ $slider->title }}"
                        class="flex w-16 h-16 object-cover rounded-md">
                    </div>
                    @else
                    <div class="flex justify-center items-center">
                        <img src="https://www.algobash.com/wp-content/uploads/2023/03/Online-Coding-Test-in-Java.jpg" 
                             alt="{{ $slider->title }}"
                             class="w-16 h-16 object-cover rounded-md">
                    </div>
                    @endif
                </td>
                <td class="border p-2">{{ $slider->title }}</td>
                <td class="border p-2">{{ Str::limit(strip_tags($slider->description), 50, '...') }}</td>
                <td class="border p-2">
                    <a href="{{ route('dashboard.slider.edit', $slider->id) }}" 
                        class="text-yellow-600 hover:text-yellow-900 transition duration-150">
                        <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('dashboard.slider.destroy', $slider->id) }}" method="POST" class="inline">
                        @csrf
                        @method('delete')
                        <button class="text-red-600 pl-2" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
        </table>
</div>
@endsection
