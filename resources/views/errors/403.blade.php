@extends('layouts.auth')

@section('title', 'Server Error')

@section('content')
    <div class="flex flex-col justify-center items-center px-4 lg:px-0">
        <h1 class="text-8xl font-extrabold text-primary">403</h1>
        <p class="text-4xl font-medium text-gray-800">Forbidden</p>
        <p class="text-xl text-gray-800 mt-4 text-center">You are not authorized to perform this action or view this page.</p>
        <div class="pt-4 flex gap-3 items-center">
            @if(str_contains(request()->url(), '/admin'))
                <a href="{{ url('/admin') }}" class="text-base font-semibold leading-6 text-primary">Admin Dashboard <span
                        aria-hidden="true">→</span></a>
            @else
                <a href="{{ url('/') }}" class="text-base font-semibold leading-6 text-primary">Go Home <span
                        aria-hidden="true">→</span></a>
            @endif
        </div>
    </div>
@endsection
