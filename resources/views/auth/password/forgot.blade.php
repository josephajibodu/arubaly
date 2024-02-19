@extends('layouts.auth')

@section('title', 'Request for password reset')
@section('content')
    <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
        <div class="card overflow-hidden sm:rounded-md rounded-none">
            <form method="post" action="{{ route('password.email') }}" class="p-6">
                @csrf
                <a href="{{ route('landing') }}" class="block mb-8">
                    <img class="h-6 block dark:hidden" src="{{ asset('images/logo-dark.png') }}" alt="">
                    <img class="h-6 hidden dark:block" src="{{ asset('images/logo-light.png') }}" alt="">
                </a>

                @if (session('status'))
                    <div class="bg-success/25 text-success text-sm rounded-md p-4 mb-4" role="alert">
                        <span class="font-bold">Hey!</span> {{ session('status') }}
                    </div>
                @endif

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="email">Email Address</label>
                    <input id="email" required value="{{ old('email') }}" name="email" class="form-input" type="email">
                    @error('email')<small class="text-help">{{ $message }}</small>@enderror
                </div>

                <div class="flex justify-center mb-6">
                    <button class="btn w-full text-white bg-primary"> Reset Password </button>
                </div>

                <div class="flex items-center my-6">
                    <div class="flex-auto mt-px border-t border-dashed border-gray-200 dark:border-slate-700"></div>
                    <div class="mx-4 text-secondary">Or</div>
                    <div class="flex-auto mt-px border-t border-dashed border-gray-200 dark:border-slate-700"></div>
                </div>

                <p class="text-gray-500 dark:text-gray-400 text-center">Back to<a href="{{ route('login') }}" class="text-primary ms-1"><b>Log In</b></a></p>
            </form>
        </div>
    </div>
@endsection
