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
<div class="bg-gradient-to-r from-rose-100 to-teal-100 dark:from-gray-700 dark:via-gray-900 dark:to-black">

    <!-- ============================================================== -->
    <!-- Start Page Content here -->
    <!-- ============================================================== -->

    <div class="bg-white">
        <header class="absolute inset-x-0 top-0 z-50">

            <nav class="bg-white border-gray-200 dark:bg-gray-900 dark:border-gray-700">
                <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
                    <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                        <img src="{{ asset('images/logo-dark.png') }}" class="h-8" alt="Flowbite Logo" />
                    </a>
                    <button data-collapse-toggle="navbar-dropdown" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="navbar-dropdown" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                        </svg>
                    </button>
                    <div class="hidden w-full md:block md:w-auto" id="navbar-dropdown">
                        <ul class="flex flex-col font-medium p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                            <li>
                                <a href="{{ url('/') }}" class="block py-2 px-3 text-white bg-primary rounded md:bg-transparent md:text-primary md:p-0" aria-current="page">Home</a>
                            </li>
{{--                            <li>--}}
{{--                                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0">Services</a>--}}
{{--                            </li>--}}
{{--                            <li>--}}
{{--                                <a href="#" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0">Pricing</a>--}}
{{--                            </li>--}}
                            @guest()
                                <li>
                                    <a href="{{ route('login') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0">Login</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}" class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-primary md:p-0">Register</a>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

        </header>

        @yield('content')

        {{-- Footer--}}
        <footer>
            <div class="bg-gray-900">
                <div class="mx-auto max-w-7xl py-24 sm:px-6 sm:py-32 lg:px-8 text-center">
                    <ul class="flex gap-6 mx-auto flex justify-center text-md text-white">
                        <li>Terms of Service</li>
                        <li>Privacy Policy</li>
                        <li>Become a Merchant</li>
                    </ul>

                    <span class="mt-4 block">&copy; {{ date("Y") }} arubaly.com. All rights reserved.</span>
                </div>
            </div>
        </footer>
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
</div>

@stack('scripts')
</body>

</html>
