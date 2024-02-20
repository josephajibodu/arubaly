@extends('layouts.auth')

@section('title', 'Register with us')
@section('content')
    <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
        <div class="card overflow-hidden sm:rounded-md rounded-none">
            <form method="post" action="{{ route('register') }}" class="p-6">
                @csrf
                <a href="{{ route('landing') }}" class="block mb-8">
                    <img class="h-6 block dark:hidden" src="{{ asset('images/logo-dark.png') }}?v1" alt="dark logo">
                    <img class="h-6 hidden dark:block" src="{{ asset('images/logo-light.png') }}?v1" alt="light logo">
                </a>

                <div class="flex gap-4 mb-4">
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="firstname">First Name</label>
                        <input id="firstname" class="form-input" type="text" name="firstname" value="{{ old('firstname') }}">
                        @error('firstname')<small class="text-help">{{ $message }}</small>@enderror
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="lastname">Last Name (Surname)</label>
                        <input id="lastname" class="form-input" type="text" name="lastname" value="{{ old('lastname') }}">
                        @error('lastname')<small class="text-help">{{ $message }}</small>@enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="email">Email Address</label>
                    <input id="email" class="form-input" type="email" name="email" value="{{ old('email') }}">
                    @error('email')<small class="text-help">{{ $message }}</small>@enderror
                </div>

                <div class="flex gap-4 mb-4">
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="phonenumber">Phone Number</label>
                        <input id="phonenumber" class="form-input" type="text" name="phonenumber" value="{{ old('phonenumber') }}">
                        @error('phonenumber')<small class="text-help">{{ $message }}</small>@enderror
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="whatsappnumber">Whatsapp Number</label>
                        <input id="whatsappnumber" class="form-input" type="text" name="whatsappnumber" value="{{ old('whatsappnumber') }}">
                        @error('whatsappnumber')<small class="text-help">{{ $message }}</small>@enderror
                    </div>
                </div>

                <span class="text-sm mb-4 block italic">Your bank details will be used to process your withdrawal, make sure to input the
                    correct bank name, account name, and account number.</span>

                <div class="mb-8 block w-full">
                    <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="bankname">Bank Name</label>
                    @php
                         $banks = config('banks');
                    @endphp
                    <select id="bankname" name="bankname" class="search-select w-full">
                        <option value="">Select your preferred bank</option>
                        @foreach($banks as $bank)
                            <option value="{{ $bank['bank_name'] }}">{{ $bank['bank_name'] }}</option>
                        @endforeach
                    </select>
                    @error('bankname')<small class="text-help clear-both block">{{ $message }}</small>@enderror
                </div>

                <div class="flex gap-4 mb-4">
                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="accountname">Account Name</label>
                        <input id="accountname" class="form-input" type="text" name="accountname" value="{{ old('accountname') }}">
                        @error('accountname')<small class="text-help">{{ $message }}</small>@enderror
                    </div>

                    <div class="w-full">
                        <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2" for="accountnumber">Account Number</label>
                        <input id="accountnumber" class="form-input" type="text" name="accountnumber" value="{{ old('accountnumber') }}">
                        @error('accountnumber')<small class="text-help">{{ $message }}</small>@enderror
                    </div>
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

                <div class="flex justify-center mb-6">
                    <button class="btn w-full text-white bg-primary"> Register </button>
                </div>

                <p class="text-gray-500 dark:text-gray-400 text-center">Already have account ?<a href="{{ route('login') }}" class="text-primary ms-1"><b>Log In</b></a></p>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <link href="{{ asset('libs/nice-select2/css/nice-select2.css') }}" rel="stylesheet" type="text/css">
@endpush

@push('scripts')
<script src="{{ asset('libs/nice-select2/js/nice-select2.js') }}"></script>
<script>
    //===============================
    document.addEventListener("DOMContentLoaded", function (e) {
        // default
        var els = document.querySelectorAll(".selectize");
        els.forEach(function (select) {
            NiceSelect.bind(select);
        });
    });

    //
    document.addEventListener("DOMContentLoaded", function (e) {
        // seachable
        var options = {
            searchable: true
        };
        NiceSelect.bind(document.getElementById("bankname"), options);
    })
</script>
@endpush
