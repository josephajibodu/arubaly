@php
    $user = \App\Models\User::find(auth()->id());
@endphp

<!-- Topbar Start -->
<header class="app-header flex items-center px-4 gap-3">
    <!-- Sidenav Menu Toggle Button -->
    <button id="button-toggle-menu" class="nav-link p-2">
        <span class="sr-only">Menu Toggle Button</span>
        <span class="flex items-center justify-center h-6 w-6">
              <i class="mgc_menu_line text-xl"></i>
            </span>
    </button>

    <!-- Topbar Brand Logo -->
    <a href="{{ route('landing') }}" class="logo-box">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img
                src="{{ asset('images/logo-light.png') }}"
                class="logo-lg h-6"
                alt="Light logo"
            />
            <img
                src="{{ asset('images/logo-sm.png') }}"
                class="logo-sm"
                alt="Small logo"
            />
        </div>

        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img
                src="{{ asset('images/logo-dark.png') }}"
                class="logo-lg h-6"
                alt="Dark logo"
            />
            <img
                src="{{ asset('images/logo-sm.png') }}"
                class="logo-sm"
                alt="Small logo"
            />
        </div>
    </a>

    <!-- Topbar Search Modal Button -->
    <button
        type="button"
        data-fc-type="modal"
        data-fc-target="topbar-search-modal"
        class="nav-link p-2 me-auto"
    >
        <span class="sr-only">Search</span>
        <span class="flex items-center justify-center h-6 w-6">
              <i class="mgc_search_line text-2xl"></i>
            </span>
    </button>


    <!-- Light/Dark Toggle Button -->
{{--    <div class="flex">--}}
{{--        <button id="light-dark-mode" type="button" class="nav-link p-2">--}}
{{--            <span class="sr-only">Light/Dark Mode</span>--}}
{{--            <span class="flex items-center justify-center h-6 w-6">--}}
{{--                <i class="mgc_moon_line text-2xl"></i>--}}
{{--              </span>--}}
{{--        </button>--}}
{{--    </div>--}}

    <!-- Profile Dropdown Button -->
    <div class="relative">
        <button
            data-fc-type="dropdown"
            data-fc-placement="bottom-end"
            type="button"
            class="nav-link"
        >
            <img
                src="{{ $user->avatar() }}"
                alt="user-image"
                class="rounded-full h-10"
            />
        </button>
        <div
            class="fc-dropdown fc-dropdown-open:opacity-100 hidden opacity-0 w-44 z-50 transition-[margin,opacity] duration-300 mt-2 bg-white shadow-lg border rounded-lg p-2 border-gray-200 dark:border-gray-700 dark:bg-gray-800"
        >
            <a
                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                href="{{ route('dashboard.profile') }}"
            >
                <i class="mgc_pic_2_line me-2"></i>
                <span>Profile</span>
            </a>
            <hr class="my-2 -mx-2 border-gray-200 dark:border-gray-700" />
            <a
                class="flex items-center py-2 px-3 rounded-md text-sm text-gray-800 hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-gray-300"
                href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit()"
            >
                <i class="mgc_exit_line me-2"></i>
                <span>Log Out</span>
            </a>
            <form method="post" action="{{ route('logout') }}" class="hidden" id="logout-form">
                @csrf
            </form>
        </div>
    </div>
</header>
<!-- Topbar End -->


<!-- Topbar Search Modal -->
<div>
    <div id="topbar-search-modal" class="fc-modal hidden w-full h-full fixed top-0 start-0 z-50">
        <div class="fc-modal-open:opacity-100 fc-modal-open:duration-500 opacity-0 transition-all sm:max-w-lg sm:w-full m-12 sm:mx-auto">
            <div class="mx-auto max-w-2xl overflow-hidden rounded-xl bg-white shadow-2xl transition-all dark:bg-slate-800">
                <div class="relative">
                    <div class="pointer-events-none absolute top-3.5 start-4 text-gray-900 text-opacity-40 dark:text-gray-200">
                        <i class="mgc_search_line text-xl"></i>
                    </div>
                    <input type="search" class="h-12 w-full border-0 bg-transparent ps-11 pe-4 text-gray-900 placeholder-gray-500 dark:placeholder-gray-300 dark:text-gray-200 focus:ring-0 sm:text-sm" placeholder="Search...">
                </div>
            </div>
        </div>
    </div>
</div>
