<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') - Arubaly</title>

    <!-- Config -->
    @vite('resources/js/config.js')

    <!-- Styles -->
    @vite(['resources/css/app.scss', 'resources/css/icons.scss', 'resources/js/app.js'])

    @stack('styles')

</head>

<body class="antialiased">
<div class="bg-gradient-to-r from-primary/10 to-primary/50">

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="min-h-screen w-screen flex justify-center items-center overflow-scroll py-24">
        @yield('content')
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
</div>

@stack('scripts')
</body>

</html>
