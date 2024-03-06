@extends('layouts.app')

@section('title', 'Buy Aruba(AWG)')

@section('content')
    <div class="container mx-auto mt-8">
        <div class="mb-6 text-center">
            <h1 class="text-gray-900 text-xl text-primary">Buy Aruba Order Details</h1>
        </div>

        @livewire('buy-order-details', ['reference' => $order->reference])
    </div>
@endsection
