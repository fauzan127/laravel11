<!DOCTYPE html>
<html lang="en" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://rsms.me/inter/inter.css">
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <title>Beranda</title>
</head>
<body class="h-screen flex flex-col">
    <x-navbar></x-navbar>
    <x-header>{{ $title }}</x-header>
    <div class="flex flex-1 mx-auto py-6 w-full">
      <!-- Main Content -->
      <main class="flex-1 pr-8">
        {{ $slot }}
      </main>
  
      <!-- Right Sidebar -->
      @if(request()->is('posts*')) 
      <aside class="w-64 bg-white shadow-lg rounded-lg p-4 overflow-y-auto">
        <div class="sticky top-4">
          <h2 class="text-lg font-semibold mb-2">Filters</h2>
          <p class="mb-4">Search Posts By :</p>
          <nav>
            <hr class="my-2 border-gray-300">
            <h2 class="flex gap-2 py-2 rounded-md w-full text-left">
              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-file-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg></i> Latest Posts
            </h2>
            <ul class="text-sm">
              @foreach ($latestPosts->take(5) as $post)
                <li>
                  <a href="/posts/{{ $post->slug }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">
                    {{ $loop->iteration }}. {{ $post->title }}
                  </a>
                </li>
              @endforeach
            </ul>
            <div class="relative">
              <hr class="my-2 border-gray-300">
              <div class="flex gap-2 py-2 text-gray-700 font-semibold"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-category"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h6v6h-6z" /><path d="M14 4h6v6h-6z" /><path d="M4 14h6v6h-6z" /><path d="M17 17m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /></svg> Category</div>
              <div class="w-48 bg-white">
                  <a href="/posts?category=web-design" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">Web Design</a>
                  <a href="/posts?category=ui-ux" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">UI UX</a>
                  <a href="/posts?category=machine-learning" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">Machine Learning</a>
                  <a href="/posts?category=data-science" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">Data Science</a>
              </div>
            </div>
            <div class="relative">
              <hr class="my-2 border-gray-300">
              <div class="flex items-center justify-between gap-2 py-2 text-gray-700 font-semibold cursor-pointer" id="dropdownToggle">
                <div class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                    <span>Author</span>
                </div>
                <svg id="dropdownArrow" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="transition-transform duration-200">
                    <path d="M6 9l6 6l6 -6" />
                </svg>
            </div>            
              <div class="w-48 bg-white hidden transition" id="dropdownMenu" style="max-height: 0; opacity: 0;">
                  <a href="/posts?users=fauzanrosyad" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">Fauzan Rosyad</a>
                  <a href="/posts?users=kajenhutasoit" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">Kajen Hutasoit</a>
                  <a href="/posts?users=ekatarihoran" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">Eka Tarihoran</a>
                  <a href="/posts?users=wasisgunarto" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">Wasis Gunarto</a>
                  <a href="/posts?users=kaniakeisha" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">Kania Keisha Mandasari S.I.Kom</a>
                  <a href="/posts?users=mutiamardhiyah" class="block px-4 py-2 text-gray-700 hover:bg-gray-100 pl-8 rounded-md">Mutia Mardhiyah S.Gz</a>
              </div>
          </div>
      
          <script>
            document.getElementById('dropdownToggle').addEventListener('click', function() {
                const dropdownMenu = document.getElementById('dropdownMenu');
                const dropdownArrow = document.getElementById('dropdownArrow');
                const isHidden = dropdownMenu.classList.contains('hidden');
        
                if (isHidden) {
                    dropdownMenu.classList.remove('hidden');
                    dropdownMenu.style.maxHeight = dropdownMenu.scrollHeight + "px";
                    dropdownMenu.style.opacity = 1;
                    dropdownArrow.classList.add('rotate-180'); // Putar panah ke atas
                } else {
                    dropdownMenu.style.maxHeight = 0;
                    dropdownMenu.style.opacity = 0;
                    dropdownArrow.classList.remove('rotate-180'); // Kembalikan panah ke bawah
                    setTimeout(() => {
                        dropdownMenu.classList.add('hidden');
                    }, 300);
                }
            });
          </script>
          </nav>
        </div>
      </aside>
      @endif
    </div>
    <x-footer></x-footer>
  </body>
</html>
