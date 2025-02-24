@extends('dashboard.layouts.main')

@section('container')
<h1 class="text-2xl font-bold">Tambah Slider</h1>

<form action="{{ route('dashboard.slider.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="mt-4">
        <label class="block text-gray-700">Title</label>
        <input type="text" name="title" class="border p-2 w-full" required>
    </div>

    <div class="mt-4">
        <label class="block text-gray-700">Deskripsi</label>
        <textarea name="description" class="border p-2 w-full" rows="4" required></textarea>
    </div>

    <div class="mt-4">
        <label class="block text-gray-700">Image</label>
        <input type="file" name="image" class="border p-2 w-full">
    </div>

    <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md">Tambah Slider</button>
</form>
@endsection
