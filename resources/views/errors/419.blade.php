@extends('layouts.auth')

@section('title', 'Session expired')

@section('content')
    <div class="flex flex-col justify-center items-center px-4 lg:px-0">
        <h1 class="text-8xl font-extrabold text-primary">OOPS</h1>
        <p class="text-4xl font-medium text-gray-800">Session Expired</p>
        <p class="text-xl text-gray-800 mt-4 text-center">Your authentication session has expired, refresh this page to continue.</p>
        <div class="pt-4 flex gap-3 items-center">
            <a href="{{ request()->url() }}" class="btn w-fit text-white bg-primary hover:bg-primary/80">Refresh</a>
            <a href="{{ url('/') }}" class="text-base font-semibold leading-6 text-primary">Go Home <span
                    aria-hidden="true">→</span></a>
        </div>
    </div>
@endsection
