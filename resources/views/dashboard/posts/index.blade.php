@extends('dashboard.layouts.main')

@section('container')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    {{-- Header Section --}}
    <div class="flex justify-between items-center border-b pb-4 mb-6">
        <h1 class="text-2xl font-bold text-gray-900">My Posts</h1>
        
    </div>

    {{-- Flash Messages --}}
    @foreach (['status' => 'rgba(17, 164, 88, 0.25)', 'update' => 'rgba(17, 164, 88, 0.25)', 'delete' => 'rgba(239, 68, 68, 0.25)'] as $key => $color)
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
    {{-- Stats Cards --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6 border-b pb-4">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="bi bi-file-text text-2xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-500">Total Posts</p>
                    <p class="text-xl font-semibold">{{ $posts->count() }}</p>
                </div>
            </div>
        </div>
    </div>
    <div class="flex justify-end mb-6">
        <a href="/dashboard/posts/create" 
            class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition duration-200">
            <i class="bi bi-plus-lg mr-2"></i>
            Create New Post
        </a>
    </div>

    {{-- Table Section --}}
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($posts as $post)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration }}</td>
                        <td class="px-6 py-4">
                            <div class="flex items-center">
                                <div class="text-sm font-medium text-gray-900">{{ $post->title }}</div>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $post->category->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $post->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 text-center">
                            <div class="flex justify-center space-x-2">
                                <a href="/dashboard/posts/{{ $post->slug }}" 
                                    class="text-blue-600 hover:text-blue-900 transition duration-150">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="/dashboard/posts/{{ $post->slug }}/edit" 
                                    class="text-yellow-600 hover:text-yellow-900 transition duration-150">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="/dashboard/posts/{{ $post->slug }}" method="POST" class="inline">
                                    @csrf
                                    @method('delete')
                                    <button class="text-red-600" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Delete Confirmation Modal --}}
<div id="deleteModal" class="fixed z-10 inset-0 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                        <i class="bi bi-exclamation-triangle text-red-600"></i>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Delete Post
                        </h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-500">
                                Are you sure you want to delete this post? This action cannot be undone.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" id="confirmDelete" 
                    class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Delete
                </button>
                <button type="button" id="cancelDelete"
                    class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    // Flash message animation
    document.addEventListener("DOMContentLoaded", function () {
        setTimeout(function () {
            document.querySelectorAll(".flash-message").forEach(function (el) {
                el.style.opacity = '0';
                el.style.transform = 'translateY(-10px)';
                setTimeout(() => el.remove(), 500);
            });
        }, 3000);
    });

    // Search functionality
    document.getElementById('search').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        document.querySelectorAll('tbody tr').forEach(row => {
            const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const category = row.querySelector('td:nth-child(3)').textContent.toLowerCase();
            row.style.display = title.includes(searchTerm) || category.includes(searchTerm) ? '' : 'none';
        });
    });

    // Delete confirmation
    let formToSubmit = null;

    function deletePost(button) {
        formToSubmit = button.closest('form');
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    document.getElementById('confirmDelete').addEventListener('click', function() {
        if (formToSubmit) {
            formToSubmit.submit();
        }
        document.getElementById('deleteModal').classList.add('hidden');
    });

    document.getElementById('cancelDelete').addEventListener('click', function() {
        document.getElementById('deleteModal').classList.add('hidden');
        formToSubmit = null;
    });
</script>
@endpush