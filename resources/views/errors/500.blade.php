@extends('layouts.auth')

@section('title', 'Server Error')

@section('content')
    <div class="flex flex-col justify-center items-center px-4 lg:px-0">
        <h1 class="text-8xl font-extrabold text-primary">4*9</h1>
        <p class="text-4xl font-medium text-gray-800">Session Expired</p>
        <p class="text-xl text-gray-800 mt-4 text-center">We apologize for the inconvenience. Please try again later.</p>
        <div class="pt-4 flex gap-3 items-center">
            <a href="{{ url('/') }}" class="text-base font-semibold leading-6 text-primary">Go Home <span
                    aria-hidden="true">→</span></a>
        </div>
    </div>
@endsection
