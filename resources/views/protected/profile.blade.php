@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <!-- Page Title Start -->
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Profile Details</h4>

    </div>
    <!-- Page Title End -->

    <div class="gap-6 w-full max-w-screen-xl space-y-8">
        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Personal Information</h4>
                        <div class="flex items-center gap-2">
{{--                            <button type="button" class="btn-code">--}}
{{--                                <i class="mgc_eye_line text-lg"></i>--}}
{{--                                <span class="ms-2">Code</span>--}}
{{--                            </button>--}}
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">Update your profile details here.</p>
                    <form action="{{ route('user-profile-information.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2  gap-6">
                            <div>
                                <label for="email" class="text-gray-800 text-sm font-medium inline-block mb-2">Email</label>
                                <input type="hidden" name="email" value="{{ $user->email }}">
                                <input type="email" class="form-input" id="email" value="{{ $user->email }}" disabled>
                                @error('email')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="username" class="text-gray-800 text-sm font-medium inline-block mb-2">Username</label>
                                <input type="hidden" name="username"  value="{{ $user->username }}">
                                <input type="text"  class="form-input" id="username" value="{{ $user->username }}" disabled>
                                @error('username')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="firstname" class="text-gray-800 text-sm font-medium inline-block mb-2">Firstname</label>
                                <input type="text" name="firstname" class="form-input" id="firstname" value="{{ old('firstname') ?? $user->firstname }}">
                                @error('firstname')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="lastname" class="text-gray-800 text-sm font-medium inline-block mb-2">Lastname</label>
                                <input type="text" name="lastname" class="form-input" id="lastname" value="{{ old('lastname') ?? $user->lastname }}">
                                @error('lastname')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="phonenumber" class="text-gray-800 text-sm font-medium inline-block mb-2">Phonenumber</label>
                                <input type="text" class="form-input" id="phonenumber" name="phonenumber" value="{{ old('phonenumber') ?? "0$user->phonenumber" }}">
                                @error('phonenumber')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="whatsappnumber" class="text-gray-800 text-sm font-medium inline-block mb-2">Whatsapp Number</label>
                                <input type="text" class="form-input" name="whatsappnumber" id="whatsappnumber" value="{{ old('whatsappnumber') ?? "0$user->whatsappnumber" }}">
                                @error('whatsappnumber')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn bg-primary text-white mt-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Banking Details</h4>
                        <div class="flex items-center gap-2">
                            {{--                            <button type="button" class="btn-code">--}}
                            {{--                                <i class="mgc_eye_line text-lg"></i>--}}
                            {{--                                <span class="ms-2">Code</span>--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <p class="text-sm text-slate-700 dark:text-slate-400 mb-4">Your bank details will be used to process your withdrawal, make sure to input the
                        correct bank name, account name, and account number.</p>
                    <form action="{{ route('dashboard.banking-details.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1  gap-6">
                            <div>
                                <label for="bankname" class="text-gray-800 text-sm font-medium inline-block mb-2">Bankname</label>
                                @php
                                    $banks = config('banks');
                                @endphp
                                <select id="bankname" name="bankname" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-fit p-2.5">
                                    <option value="">Select your preferred bank</option>
                                    @foreach($banks as $bank)
                                        <option value="{{ $bank['bank_name'] }}" @if($user->bankname == $bank['bank_name']) selected @endif>{{ $bank['bank_name'] }}</option>
                                    @endforeach
                                </select>

                                @error('firstname')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="accountname" class="text-gray-800 text-sm font-medium inline-block mb-2 ">Account Name</label>
                                <input type="text" name="accountname" class="form-input w-fit" id="accountname" value="{{ old('accountname') ?? $user->accountname }}">

                                @error('accountname')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="accountnumber" class="text-gray-800 text-sm font-medium inline-block mb-2">Account Number</label>
                                <input type="text" class="form-input w-fit" id="accountnumber" name="accountnumber" value="{{ old('accountnumber') ?? "$user->accountnumber" }}">

                                @error('accountnumber')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn bg-primary text-white mt-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
