@extends('layouts.app')

@section('title', 'Buy Aruba(AWG)')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="mb-6 text-center">
            <h1 class="text-gray-900 text-xl text-primary">Buy Aruba (AWG) Page</h1>
        </div>

        <div class="mb-8 text-center text-gray-950">
            <p class="mb-4">- Buy Aruba Florin (AWG) from any of the available merchants below.</p>
            <p class="mb-4">- Current Average (AWG) price: ₦570 - ₦590.</p>
            <p class="mb-4">- If all merchants are sold-out for the day, check back at 6:00 am the next day.</p>
            <p class="mb-4">- Select any of the available merchants below, click on Buy Aruba (AWG).</p>
            <p class="mb-4">- Insert the desired amount you want to buy and follow the payment instructions.</p>
            <p class="mb-4">- Click on the Appeal button if you encounter any issues with your order.</p>
        </div>

        @livewire('buy-aruba')

    </div>
@endsection
