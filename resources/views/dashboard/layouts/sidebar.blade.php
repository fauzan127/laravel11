<div class="flex flex-col md:flex-row-reverse min-h-screen">
    <nav class="bg-white md:w-64 border-l border-gray-200 md:top-0 min-h-screen">
      <ul class="mt-4 flex-grow">
        <!-- Sidebar content -->
        <h6 class=" block p-2 d-flex justify-content-between align-item-center mt-4 mb-1 font-bold text-blue-600">
          <span>Menu</span>
        </h6>
        <a
          class="block p-2 text-gray-700 nav-link {{ Request::is('dashboard') ? 'active' : '' }}"
          href="/dashboard">
          <i class="bi bi-house-door-fill"></i> Dashboard
        </a>
        <a
          class="block p-2 text-gray-700 nav-link {{ Request::is('dashboard/posts*') ? 'active' : '' }}"
          href="/dashboard/posts">
          <i class="bi bi-file-earmark-post"></i> My Posts
        </a>
      </ul>
      @can('admin')
      <h6 class="ml-8 block p-2 d-flex justify-content-between align-item-center mt-4 mb-1 font-bold text-blue-600">
        <span>Administrator</span>
      </h6>
      <ul class="flex-grow">
        <a
          class="block p-2 text-gray-700 nav-link {{ Request::is('dashboard/categories') ? 'active' : '' }}"
          href="/dashboard/categories">
          <i class="bi bi-grid mr-2"></i>Post Categories
        </a>
      </ul>
      @endcan
    </nav>
</div>
  
<style>
    .nav-link {
      color: black; /* Warna teks default */
      text-decoration: none; /* Hilangkan garis bawah */
    }
    .nav-link.active {
      color: blue; /* Warna teks untuk halaman aktif */
      font-weight: bold; /* Tambahkan efek jika diperlukan */
    }
  </style>
