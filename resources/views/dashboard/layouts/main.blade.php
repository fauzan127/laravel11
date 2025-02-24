<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs" defer></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
    <script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
    
    
    <style>
        a {
            text-decoration: none; /* Menghapus garis bawah dari semua tautan */
        }
        trix-toolbar [data-trix-button-group="file-tools"]{
            display:none;
        }
    </style>
</head>
<body class="bg-gray-100" x-data="{ isMobileMenuOpen: false }">

@include('dashboard.layouts.header')

    <div class="flex flex-col md:flex-row min-h-screen">
    
        @include('dashboard.layouts.sidebar')

        <main class="flex-1 p-4">
            @yield('container')
        </main>
    </div>
</body>
</html>

