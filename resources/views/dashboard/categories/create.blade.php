@extends('dashboard.layouts.main')

@section('container')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-2xl font-bold mb-4">Create New Category</h1>

    <div class="max-w-lg bg-white p-6 rounded-lg shadow-md">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Category Name</label>
                <input type="text" name="name" id="name" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="slug" class="block text-gray-700 font-medium mb-2">Category Slug</label>
                <input type="text" name="slug" id="slug" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('slug') border-red-500 @enderror" value="{{ old('slug') }}" required>
                @error('slug')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label for="color" class="block text-gray-700 font-medium mb-2">Category Color</label>
                <select name="color" id="color" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 @error('color') border-red-500 @enderror" required>
                    <option value="blue" class="text-blue-500">Blue</option>
                    <option value="red" class="text-red-500">Red</option>
                    <option value="green" class="text-green-500">Green</option>
                    <option value="yellow" class="text-yellow-500">Yellow</option>
                    <option value="purple" class="text-purple-500">Purple</option>
                    <option value="pink" class="text-pink-500">Pink</option>
                    <option value="indigo" class="text-indigo-500">Indigo</option>
                </select>
                @error('color')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition duration-200">Create Category</button>
            </div>

        </form>
    </div>
</div>
@endsection
