@extends('layouts.app')

@section('title', 'Convert Funds')

@section('content')
    <div class="flex flex-col items-center py-10">
        <div class="mb-6 text-center">
            <h1 class="text-gray-900 text-xl">Convert Money</h1>
            <p>Enter amount and select currency to convert to</p>
        </div>

        <div class="bg-warning/25 text-warning  text-sm rounded-md p-4 max-w-lg mb-4 font-bold" role="alert">
            Kindly be aware that the conversion process requires a duration of 4 hours, and the
            exchange fee will be deducted upon completion. Feel free to monitor your dashboard
            for real-time updates on the remaining time.
        </div>

        @livewire('convert-funds', ['from' => $from, 'to' => $to])
    </div>
@endsection
