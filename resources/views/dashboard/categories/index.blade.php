
@extends('dashboard.layouts.main')
@section('container')
<div class="mb-6">
    <h1 class="text-2xl font-bold border-b pb-2">Post Categories</h1>
</div>
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

<div class="overflow-x-auto mt-2">
    <a href="/dashboard/categories/create" class="mb-4 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 disabled:opacity-25 transition ease-in-out duration-150">
        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
        Create New Category
    </a>
    <div class="bg-white shadow-sm rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
            <tr>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category Name</th>
                <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
            </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
            @foreach ($categories as $category)
            <tr class="hover:bg-gray-50 transition-colors duration-200">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $category->name }}</td>
                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                    <div class="flex justify-end space-x-2">
                        <a href="/dashboard/categories/{{ $category->slug }}/edit" class="text-red-600 hover:text-indigo-900">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                        </a>
                        <form action="/dashboard/categories/{{ $category->slug }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?')">
                            @method('delete')
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-900">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
