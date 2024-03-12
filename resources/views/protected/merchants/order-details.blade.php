@extends('layouts.app')

@section('title', 'Buy Order Detail')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="mb-6 text-center">
            <h1 class="text-gray-900 text-xl text-primary">Buy Aruba (AWG) Order Details</h1>
        </div>

        @livewire('merchant.buy-order-details', ['reference' => $reference])

    </div>
@endsection
