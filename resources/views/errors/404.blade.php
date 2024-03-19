@extends('layouts.auth')

@section('title', 'Not found')

@section('content')
    <div class="flex flex-col justify-center items-center px-4 lg:px-0">
        <h1 class="text-8xl font-extrabold text-primary">404</h1>
        <p class="text-4xl font-medium text-gray-800">Not Found</p>
        <p class="text-xl text-gray-800 mt-4 text-center">It appears something seem to be broken. We can't find the page you are looking for.</p>
        <div class="pt-4 flex gap-3 items-center">
            <a href="{{ url('/') }}" class="text-base font-semibold leading-6 text-primary">Go Home <span
                    aria-hidden="true">→</span></a>
        </div>
    </div>
@endsection
