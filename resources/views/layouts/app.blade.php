<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="font-sans antialiased" style="background-image: url('{{ asset('images/background.jpeg') }}'); ">
    <div
        style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(255, 255, 255, 0.7); z-index: -1;">
    </div>
    @livewireScripts

    <livewire:layout.navigation />

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        {{ $slot }}
    </main>
    </div>
</body>

<footer class = "font-sans">
    <div class="container mx-auto px-4 text-center">
        <div class="mx-auto mb-4"
            style="max-width: 400px; height: 30px; background-image: url('{{ asset('images/footer.png') }}'); background-size: cover; background-position: center;">
        </div>
        <p>FINAL YEAR PROJECT : Machine Learning-Based Job-Hunting Web Application for CV Optimisation </p>
        <p> &copy; 2025 RAY RAY RACHEL. All rights reserved.</p>
    </div>
</footer>

</html>


<script>
    window.addEventListener("DashboardClicked", function () {
        console.log("DashboardClicked event was dispatched!");
        openDefaultTab();
    });
</script>
