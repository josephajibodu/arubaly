@extends('layouts.app')

@section('title', 'Transfers')

@section('content')
    <div class="flex flex-col items-center py-10">
        <div class="mb-6 text-center">
            <h1 class="text-gray-900 text-xl">Transfer History</h1>
        </div>

        <div class="card w-full max-w-screen-xl">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                            <thead>
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ref</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Amount</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                                {{--                                <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>--}}
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">
                                        <span class="uppercase">{{ $transaction->reference }}</span>
                                        <p class="italic font-light">{{ \Carbon\Carbon::parse($transaction->created_at)->diffForHumans() }} <br /></p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        @if($transaction->user_id == auth()->id())
                                            <p class="flex gap-1 items-center">{{ $transaction->description }}
                                                <svg class="w-6 h-6 text-red-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v13m0-13 4 4m-4-4-4 4"/>
                                                </svg></p>

                                        @else
                                            <p class="flex gap-1 items-center t">From {{ $transaction->user->username }}
                                                <svg class="w-6 h-6 text-green-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19V5m0 14-4-4m4 4 4-4"/>
                                                </svg></p>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">{{ $transaction->currency->toString() }} {{ \Illuminate\Support\Number::format($transaction->amount/100) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">
                                        {{ $transaction->status }}</td>
                                    {{--                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">--}}
                                    {{--                                            <a class="text-primary hover:text-sky-700" href="#">Delete</a>--}}
                                    {{--                                        </td>--}}
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
