@extends('layouts.auth')

@section('title', 'Login into your account')
@section('content')
    <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
        <div class="card overflow-hidden sm:rounded-md rounded-none">
            <form method="post" action="{{ route('login') }}" class="p-6">
                @csrf
                <a href="{{ route('landing') }}" class="block mb-8">
                    <img class="h-6 block dark:hidden" src="{{ asset('images/logo-dark.png') }}" alt="">
                    <img class="h-6 hidden dark:block" src="{{ asset('images/logo-light.png') }}" alt="">
                </a>

{{--                Password reset status--}}
                @if (session('status'))
                    <div class="bg-success/25 text-success text-sm rounded-md p-4 mb-4" role="alert">
                        <span class="font-bold">Hey!</span> {{ session('status') }}
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="email">Email Address</label>
                    <input id="email" name="email" value="{{ old('email') }}" class="form-input" type="email" placeholder="Enter your email" >
                    @error('email')<small class="text-help">{{ $message }}</small>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="loggingPassword">Password</label>
                    <input id="loggingPassword" name="password" class="form-input" type="password" placeholder="Enter your password" >
                    @error('password')<small class="text-help">{{ $message }}</small>@enderror
                </div>

                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <input type="checkbox" class="form-checkbox rounded" name="remember" id="rememberme">
                        <label class="ms-2" for="rememberme">Remember me</label>
                    </div>
                    <a href="{{ route('password.request') }}" class="text-sm text-primary border-b border-dashed border-primary">Forget Password ?</a>
                </div>

                <div class="flex justify-center mb-6">
                    <button class="btn w-full text-white bg-primary"> Log In </button>
                </div>

                <div class="flex items-center my-6">
                    <div class="flex-auto mt-px border-t border-dashed border-gray-200 dark:border-slate-700"></div>
                    <div class="mx-4 text-secondary">Or</div>
                    <div class="flex-auto mt-px border-t border-dashed border-gray-200 dark:border-slate-700"></div>
                </div>

                <div class="flex gap-4 justify-center mb-6">
                    <a href="javascript:void(0)" class="btn border-light text-gray-400 dark:border-slate-700">
                                <span class="flex justify-center items-center gap-2">
                                    <i class="mgc_github_line text-info text-xl"></i>
                                    <span class="lg:block hidden">Github</span>
                                </span>
                    </a>
                    <a href="javascript:void(0)" class="btn border-light text-gray-400 dark:border-slate-700">
                                <span class="flex justify-center items-center gap-2">
                                    <i class="mgc_google_line text-danger text-xl"></i>
                                    <span class="lg:block hidden">Google</span>
                                </span>
                    </a>
                    <a href="javascript:void(0)" class="btn border-light text-gray-400 dark:border-slate-700">
                                <span class="flex justify-center items-center gap-2">
                                    <i class="mgc_facebook_line text-primary text-xl"></i>
                                    <span class="lg:block hidden">Facebook</span>
                                </span>
                    </a>
                </div>

                <p class="text-gray-500 dark:text-gray-400 text-center">Don't have an account ?<a href="{{ route('register') }}" class="text-primary ms-1"><b>Register</b></a></p>
            </form>
        </div>
    </div>
@endsection
