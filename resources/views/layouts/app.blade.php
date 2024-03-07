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

    @vite('resources/js/alerts.js')

    @stack('styles')

</head>

<body class="antialiased">
    <div class="flex wrapper">
        <!-- Sidenav Menu -->
        @include('partials.sidenav')

        <!-- ============================================================== -->
        <!-- Start Page Content here -->
        <!-- ============================================================== -->

        <div class="page-content">
            @include('partials.topbar')

            <main class="flex-grow p-6 overflow-y-scroll overflow-hidden max-w-[100%]">
                @yield('content')
            </main>

            <!-- Footer Start -->
            @include('partials.footer')
            <!-- Footer End -->
        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->
    </div>

    @include('partials.customizer')


{{--    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
    @stack('scripts')

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {

            @if($errors)
            @foreach($errors->all() as $error)
            Swal.fire(
                'Ooops!!!',
                '{{ $error }}',
                'error',
            );
            @endforeach
            @endif

            @if (Session()->has('error'))
            Swal.fire(
                'Ooops!!!',
                '{{ session('error') }}',
                'error',
            );
            @elseif (Session()->has('success'))
            Swal.fire(
                'Thank you!',
                '{{ session('success') }}',
                'success',
            );
            @elseif (Session()->has('info'))
            Swal.fire(
                'Note',
                '{{ session('info') }}',
                'info',
            );
            @elseif (Session()->has('warning'))
            Swal.fire(
                'Warning',
                '{{ session('warning') }}',
                'warning',
            );
            @endif
            // $(document).ready(function(){
            //   $(window).load(function(){
            //     alert("Page loaded.");
            //   });
            // });
        });
    </script>
</body>

</html>
