@extends('layouts.app')

@section('title', 'Buy Aruba(AWG)')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="mb-6 text-center">
            <h1 class="text-gray-900 text-xl text-primary">Buy Aruba (AWG) Page</h1>
        </div>

        <div class="mb-8 text-center text-gray-950">
            <p class="mb-4">- Buy Aruba florin (AWG) from any of the available merchants below.</p>
            <p class="mb-4">- If all merchants are sold-out for the day, check back at 6:00 am the next day.</p>
            <p class="mb-4">- Select any of the available merchants below, click on Buy Aruba (AWG).</p>
            <p class="mb-4">- Insert the desired amount you want to buy and follow the payment instructions.</p>
            <p class="mb-4">- Click on the Appeal button if you encounter any issues with your order.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Merchant Cards -->
            <!-- Repeat this card structure for each merchant -->
            <div class="card px-4 py-4 ">
                <h2 class="text-xl font-semibold mb-2 text-primary">Merchant (Username)</h2>
                <p class="mb-2">Selling Price: ₦497</p>
                <p class="mb-2">Available Aruba (AWG): 400 Aruba Florin (AWG)</p>
                <p class="mb-2">Amount Limit: ₦20,000 - ₦600,000</p>
                <p class="mb-2">Status: Available</p>
                <p class="mb-2">Payment: Bank Transfer</p>
                <a href="#" class="btn bg-primary text-white">BUY ARUBA(AWG)</a>
            </div>
            <!-- End Merchant Cards -->
        </div>

        <!-- Modal for Buying Aruba(AWG) -->
        <!-- Add a modal structure for buying Aruba(AWG) -->

        <!-- Page for Inputting Amount and Proceeding with Payment -->
        <!-- Add a page structure for inputting amount and proceeding with payment -->

        <!-- Page for Order Confirmation and Payment Details -->
        <!-- Add a page structure for order confirmation and payment details -->

        <!-- Page for Successful Notification -->
        <!-- Add a page structure for successful notification -->

        <!-- Page for Cancel Order -->
        <!-- Add a page structure for canceling an order -->
    </div>
@endsection
