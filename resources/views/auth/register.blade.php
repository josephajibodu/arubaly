@extends('layouts.auth')

@section('title', 'Register with us')
@section('content')
    <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
        <div class="card overflow-hidden sm:rounded-md rounded-none">
            <form method="post" action="{{ route('register') }}" class="p-6">
                @csrf
                <a href="{{ route('landing') }}" class="block mb-8">
                    <img class="h-6 block dark:hidden" src="{{ asset('images/logo-dark.png') }}" alt="dark logo">
                    <img class="h-6 hidden dark:block" src="{{ asset('images/logo-light.png') }}" alt="light logo">
                </a>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="firstname">First Name</label>
                    <input id="firstname" class="form-input" type="text" name="firstname" value="{{ old('firstname') }}">
                    @error('firstname')<small class="text-help">{{ $message }}</small>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="lastname">Last Name (Surname)</label>
                    <input id="lastname" class="form-input" type="text" name="lastname" value="{{ old('lastname') }}">
                    @error('lastname')<small class="text-help">{{ $message }}</small>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="email">Email Address</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}">
                    @error('email')<small class="text-help">{{ $message }}</small>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="phonenumber">Phone Number</label>
                    <input id="phonenumber" class="form-input" type="text" name="phonenumber" value="{{ old('phonenumber') }}">
                    @error('phonenumber')<small class="text-help">{{ $message }}</small>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="password">Password</label>
                    <input id="password" class="form-input" type="password" name="password" placeholder="Enter your password">
                    @error('password')<small class="text-help">{{ $message }}</small>@enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="password_confirmation">Enter Password Again</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation">
                </div>

{{--                <div class="mb-4">--}}
{{--                    <div class="flex items-center">--}}
{{--                        <input type="checkbox" class="form-checkbox rounded" name="terms" id="checkbox-signup">--}}
{{--                        <label class="ms-2 text-slate-900 dark:text-slate-200" for="checkbox-signup">I accept <a href="#" class="text-gray-400 underline">Terms and Conditions</a></label>--}}
{{--                    </div>--}}
{{--                </div>--}}

                <div class="flex justify-center mb-6">
                    <button class="btn w-full text-white bg-primary"> Register </button>
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

                <p class="text-gray-500 dark:text-gray-400 text-center">Already have account ?<a href="{{ route('login') }}" class="text-primary ms-1"><b>Log In</b></a></p>
            </form>
        </div>
    </div>
@endsection
