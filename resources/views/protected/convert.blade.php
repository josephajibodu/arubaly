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

        <div class="card max-w-lg w-full">
            <div class="p-6 flex flex-col gap-4">
                <div class="flex justify-between p-4 border rounded">
                    <span class="flex items-center gap-1">
                        <img src="{{ asset('images/logo-sm.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        ARUBA FLORIN(AWG) Balance
                    </span>
                    <span class="font-bold text-gray-900 text-base">3.456</span>
                </div>


                <div class="flex flex-col gap-2">
                    <label for="amount-to-convert">Amount to convert</label>
                    <div class="flex">
                        <div
                            class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        >
                            <img src="{{ asset('images/logo-sm.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        </div>
                        <input
                            id="amount-to-convert"
                            type="text"
                            placeholder="0.00"
                            class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                        />
                    </div>
                </div>

                <div class="border bg-gray-200 rounded-xl p-4 flex flex-col gap-3">
                    <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Conversion Fee
                        </span>
                        <span class="font-bold text-gray-900 text-base">3.456</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Amount we'll convert
                        </span>
                        <span class="font-bold text-gray-900 text-base">3.456</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Exchange Duration
                        </span>
                        <span class="font-bold text-gray-900 text-base">4hr</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Today's rate
                        </span>
                        <span class="font-bold text-gray-900 text-base">x 3.456</span>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="amount-to-convert">Amount you will receive</label>
                    <div class="flex">
                        <div
                            class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        >
                            <img src="{{ asset('images/flags/us.jpg') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        </div>
                        <input
                            id="amount-to-convert"
                            type="text"
                            placeholder="0.00"
                            class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                        />
                    </div>
                </div>

                <button class="btn bg-primary text-white mt-2">
                    Convert
                </button>
            </div>
        </div>
    </div>
@endsection
