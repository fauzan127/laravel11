@extends('dashboard.layouts.main')

@section('container')
<div class="mt-6 bg-white shadow-md rounded-lg p-6">
    <h2 class="text-lg font-semibold mb-4">Edit Slider</h2>

    <form action="{{ route('dashboard.slider.update', $slider->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-gray-700">Title</label>
            <input type="text" id="title" name="title" value="{{ old('title', $slider->title) }}" 
                   class="w-full p-2 border rounded-md">
        </div>

        <div class="mb-4">
            <label for="description" class="block text-gray-700">Deskripsi</label>
            <textarea id="description" name="description" class="w-full p-2 border rounded-md">{{ old('description', $slider->description) }}
            </textarea>         
        </div>

        <div class="mb-4">
            <label class="block text-gray-700">Current Image</label>
            @if ($slider->image)
                <img src="{{ asset('storage/' . $slider->image) }}" class="w-32 h-32 object-cover rounded-md">
            @else
                <p class="text-gray-500">No image uploaded</p>
            @endif
        </div>

        <div class="mb-4">
            <label for="image" class="block text-gray-700">Upload New Image</label>
            <input type="file" id="image" name="image" class="w-full p-2 border rounded-md">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Slider</button>
    </form>
</div>
@endsection