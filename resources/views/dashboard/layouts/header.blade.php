<nav class="bg-gray-800 sticky top-0">
    <div class="mx-auto max-w-7xl">
        <div class="flex h-16 items-center justify-between">
            <div class="flex items-center ">
                <a class="text-lg font-semibold text-white" href="#">Dashboard</a>
            </div>

            <div class="flex items-center">
                <div class="relative ml-4" x-data="{ open: false }">
                    @if(Auth::check())
                        <!-- Avatar Button -->
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <img src="data:image/png;base64,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" 
                                 alt="Profile" class="w-10 h-10 rounded-full border-2 border-gray-300 object-cover">
                        </button>
                
                        <!-- Dropdown -->
                        <div x-show="open" @click.away="open = false" 
                             class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg overflow-hidden z-50">
                            <button id="toggleProfile"  class="w-full text-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-700">
                                Profil
                            </button>
                            <div id="profile" class="min-h-screen bg-white shadow-lg rounded-lg p-6 fixed top-0 right-0 transform translate-x-full transition-transform duration-500">
                                <h2 class="text-lg font-bold text-gray-700">Profil</h2>
                                <hr class="my-2 border-gray-300">
                                <p class="text-gray-600 mt-2"><strong>Nama :</strong> {{ Auth::user()->name }}</p>
                                <p class="text-gray-600 mt-1"><strong>Email :</strong> {{ Auth::user()->email }}</p>
                                <button id="openChangePassword" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-blue-600 transition-all">Ganti Password</button>
                                <button id="closeProfile" class="mt-4 bg-red-500 text-white px-4 py-2 rounded-lg shadow-md hover:bg-red-600 transition-all">Tutup</button>
                            </div>
                            {{-- Route logout --}}
                            <form action="{{ route('logout') }}" method="post" class="block">
                                @csrf
                                <button type="submit" class="w-full text-center px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-blue-700">
                                    Logout
                                </button>
                            </form>
                        </div>
                    @else
                        <!-- Login Button -->
                        <a href="/login" class="inline-flex items-center gap-x-2 rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m3 0l3-3m0 0l-3-3m3 3H9" />
                            </svg>
                            Login
                        </a>
                    @endif
                </div>
                <div id="changePasswordModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 items-center justify-center hidden">
                    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                        <h2 class="text-lg font-bold text-gray-700 mb-4">Ganti Password</h2>
                        <form action="{{ route('password.update') }}" method="POST">
                            @csrf
                            @method('PUT')
                            
                            <div class="mb-4">
                                <label class="block text-gray-700">Password Lama</label>
                                <input type="password" name="current_password" required 
                                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                            </div>
                
                            <div class="mb-4">
                                <label class="block text-gray-700">Password Baru</label>
                                <input type="password" name="new_password" required 
                                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                            </div>
                
                            <div class="mb-4">
                                <label class="block text-gray-700">Konfirmasi Password Baru</label>
                                <input type="password" name="new_password_confirmation" required 
                                       class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-500">
                            </div>
                
                            <div class="flex justify-end">
                                <button type="button" id="closeChangePassword" class="mr-2 px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600">
                                    Batal
                                </button>
                                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600">
                                    Simpan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <script>
                    document.getElementById('toggleProfile').addEventListener('click', function () {
                        document.getElementById('profile').classList.toggle('translate-x-0');
                        document.getElementById('profile').classList.toggle('translate-x-full');
                    });
                    document.getElementById('closeProfile').addEventListener('click', function () {
                        document.getElementById('profile').classList.add('translate-x-full');
                    });
                    document.getElementById('openChangePassword').addEventListener('click', function () {
                        document.getElementById('changePasswordModal').classList.remove('hidden');
                    });

                    document.getElementById('closeChangePassword').addEventListener('click', function () {
                        document.getElementById('changePasswordModal').classList.add('hidden');
                    });
                                </script>  
                <!-- Alpine.js -->
                <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>                
            </div>
        </div>
    </div>
</nav>
