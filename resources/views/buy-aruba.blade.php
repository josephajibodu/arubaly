@extends('layouts.guest')

@section('title', 'Buy Aruba(AWG)')

@section('content')

    <div class="container mx-auto pt-24">
        <div class="mb-6 text-center">
            <h1 class="text-gray-900 text-2xl text-primary">Buy Aruba (AWG) Page</h1>
        </div>

        <div class="mb-8 text-center mt-6 text-lg leading-8 text-gray-600">
            <p class="mb-4">- Buy Aruba florin (AWG) from any of the available merchants below.</p>
            <p class="mb-4">- If all merchants are sold-out for the day, check back at 6:00 am the next day.</p>
            <p class="mb-4">- Select any of the available merchants below, click on Buy Aruba (AWG).</p>
            <p class="mb-4">- Insert the desired amount you want to buy and follow the payment instructions.</p>
            <p class="mb-4">- Click on the Appeal button if you encounter any issues with your order.</p>
        </div>


        <div class="max-w-screen-lg mx-auto">
            @guest()
                <div class="p-4 mb-4 text-base text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400" role="alert">
                    <span class="font-medium">Hello!</span> Please login for to trade without restrictions.
                </div>
            @endguest
        </div>

        @livewire('buy-aruba')

    </div>
@endsection
