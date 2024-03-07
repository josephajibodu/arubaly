@extends('layouts.app')

@section('title', 'Withdraw Funds')

@section('content')
    <div class="flex flex-col items-center py-10">
        <div class="mb-6 text-center">
            <h1 class="text-gray-900 text-xl">Withdraw Funds</h1>
            <p>Withdraw Naira into your local bank account</p>
        </div>

        <div class="text-sm rounded-md p-4 max-w-lg mb-4 font-bold" role="alert">

            <ul class="space-y-4 text-left text-gray-500 dark:text-gray-400">
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>The withdrawal process is straightforward and rapid. Simply follow the instructions provided below to withdraw Naira from your Arubaly Naira Balance.</span>
                </li>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>Input the amount you wish to withdraw from your Arubaly Naira Balance.</span>
                </li>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>The processing of withdrawals will be completed within a span of 24 hours.</span>
                </li>
                <li class="flex items-center space-x-3 rtl:space-x-reverse">
                    <svg class="flex-shrink-0 w-3.5 h-3.5 text-green-500 dark:text-green-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 12">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5.917 5.724 10.5 15 1.5"/>
                    </svg>
                    <span>You have the option to modify your bank details on your dashboard if the information below is inaccurate.</span>
                </li>
            </ul>

        </div>

        @livewire('withdraw')
    </div>
@endsection
