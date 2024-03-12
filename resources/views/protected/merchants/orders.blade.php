@extends('layouts.app')

@section('title', 'Merchant Orders')

@section('content')
    <div class="flex flex-col items-center py-10">
        <div class="mb-6 text-center">
            <h1 class="text-gray-900 text-xl">Buy Orders</h1>
        </div>

        <div class="card w-full max-w-screen-xl">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ref</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">User</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                    {{--                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th> --}}
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($transactions as $transaction)
                                    <tr>
                                        <td
                                            class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                            <a href="{{ route('dashboard.merchant.orders.view', ['order' => $transaction]) }}"><span class="uppercase underline">{{ $transaction->reference }}</span></a>
                                            @php
                                                $timeLeft = $transaction->order->getTimeLeft();
                                            @endphp
                                            @if ($timeLeft > 0 && $transaction->status == \App\Enums\TradeStatus::PENDING)
                                                <x-countdown :timeRemaining="$timeLeft" />
                                            @else
                                                <p class="italic font-light">
                                                    {{ \Carbon\Carbon::parse($transaction->created_at)->diffForHumans() }}
                                                    <br /></p>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ $transaction->user->username }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ $transaction->description }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ $transaction->currency->toString() }}
                                            {{ \Illuminate\Support\Number::format($transaction->amount / 100) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                            {{ $transaction->status }}</td>
                                        {{--                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium"> --}}
                                        {{--                                            <a class="text-primary hover:text-sky-700" href="#">Delete</a> --}}
                                        {{--                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection


@push('scripts')
    @livewireScripts
@endpush
