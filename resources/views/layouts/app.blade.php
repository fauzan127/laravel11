<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Application</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="bg-gray-100 dark:bg-gray-900">

    <!-- Navbar -->
    @include('components.navbar')

    <!-- Content -->
    <div class="min-h-screen">
        @yield('container')
    </div>
    
</body>
</html>
