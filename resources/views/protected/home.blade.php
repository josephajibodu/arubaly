@extends('layouts.app')

@section('title', 'Account Dashboard')

@section('content')
    <div class="grid lg:grid-cols-3 gap-6">

        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6 flex flex-col items-center">
                <div data-fc-type="tab" class="flex flex-col items-center">
                    <nav class="flex w-fit space-x-2 justify-center p-1 bg-gray-300 rounded-xl" aria-label="Tabs" role="tablist">
                        <button type="button" class="fc-tab-active:bg-primary fc-tab-active:text-white py-3 px-4 inline-flex items-center gap-2 bg-transparent text-sm font-medium text-center text-gray-500 rounded-lg hover:text-primary dark:hover:text-gray-400 active" id="pills-with-brand-color-item-1" data-fc-target="#pills-with-brand-color-1" aria-controls="pills-with-brand-color-1" role="tab">
                            <img src="{{ asset('images/logo-sm-light.png') }}?v1" class="h-4 w-4 rounded-full fc-tab-active:bg-primary"  alt="awg balance"/>
                            AWG
                        </button>
                        <button type="button" class="fc-tab-active:bg-primary fc-tab-active:text-white py-3 px-4 inline-flex items-center gap-2 bg-transparent text-sm font-medium text-center text-gray-500 rounded-lg hover:text-primary dark:hover:text-gray-400" id="pills-with-brand-color-item-2" data-fc-target="#pills-with-brand-color-2" aria-controls="pills-with-brand-color-2" role="tab">
                            <img src="{{ asset('images/flags/us.jpg') }}" class="h-4 w-4 rounded-full"  alt="usd balance"/>
                            USD
                        </button>
                        <button type="button" class="fc-tab-active:bg-primary fc-tab-active:text-white py-3 px-4 inline-flex items-center gap-2 bg-transparent text-sm font-medium text-center text-gray-500 rounded-lg hover:text-primary dark:hover:text-gray-400" id="pills-with-brand-color-item-3" data-fc-target="#pills-with-brand-color-3" aria-controls="pills-with-brand-color-3" role="tab">
                            <img src="{{ asset('images/flags/ng.png') }}" class="h-4 w-4 rounded-full"  alt="ngn balance"/>
                            NGN
                        </button>
                    </nav>

                    <div class="mt-3">
                        <div id="pills-with-brand-color-1" role="tabpanel" aria-labelledby="pills-with-brand-color-item-1">
                            <div class="p-6 flex flex-col items-center gap-6">
                                <div class="flex items-center justify-center gap-16">
                                    <div class="text-center space-y-3">
                                        <span class="text-sm">Available Balance <i data-feather="info" class="h-4 w-4 inline"></i></span>
                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">{{ \Illuminate\Support\Number::format($user->awg->balance / 100) }}</h4>
                                    </div>

{{--                                    <div class="text-center space-y-3">--}}
{{--                                        <span class="text-sm">Pending Balance<i data-feather="info" class="h-4 w-4 inline"></i></span>--}}
{{--                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">0.00</h4>--}}
{{--                                    </div>--}}
                                </div>

                                <div class="flex gap-2">
                                    <a href="{{ route('transaction.convert', ['from' => \App\Enums\Currency::AWG->value, 'to' => \App\Enums\Currency::USD->value]) }}" type="button" class="btn bg-light text-slate-900 dark:text-slate-200"><i class="mgc_add_fill text-base me-4"></i> Convert AWG to USD</a>
                                </div>
                            </div>
                        </div>
                        <div id="pills-with-brand-color-2" class="hidden" role="tabpanel" aria-labelledby="pills-with-brand-color-item-2">

                            <div class="p-6 flex flex-col items-center gap-6">
                                <div class="flex items-center justify-center gap-16">
                                    <div class="text-center space-y-3">
                                        <span class="text-sm">Available Balance <i data-feather="info" class="h-4 w-4 inline"></i></span>
                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">${{ \Illuminate\Support\Number::format($user->usd->balance / 100) }}</h4>
                                    </div>

{{--                                    <div class="text-center space-y-3">--}}
{{--                                        <span class="text-sm">Pending Balance<i data-feather="info" class="h-4 w-4 inline"></i></span>--}}
{{--                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">$299.00</h4>--}}
{{--                                    </div>--}}
                                </div>

                                <a href="{{ route('transaction.convert', ['from' => \App\Enums\Currency::USD->value, 'to' => \App\Enums\Currency::NGN->value]) }}" type="button" class="btn bg-light text-slate-900 dark:text-slate-200"><i class="mgc_add_fill text-base me-4"></i> Convert USD to Naira</a>
                            </div>

                        </div>
                        <div id="pills-with-brand-color-3" class="hidden" role="tabpanel" aria-labelledby="pills-with-brand-color-item-3">

                            <div class="p-6 flex flex-col items-center gap-6">
                                <div class="flex items-center justify-center gap-16">
                                    <div class="text-center space-y-3">
                                        <span class="text-sm">Available Balance <i data-feather="info" class="h-4 w-4 inline"></i></span>
                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">&#8358;{{ \Illuminate\Support\Number::format($user->ngn->balance / 100) }}</h4>
                                    </div>

{{--                                    <div class="text-center space-y-3">--}}
{{--                                        <span class="text-sm">Pending Balance<i data-feather="info" class="h-4 w-4 inline"></i></span>--}}
{{--                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">&#8358;299.00</h4>--}}
{{--                                    </div>--}}
                                </div>

                                <a href="{{ route('transaction.withdrawal.create') }}" class="btn bg-light text-slate-900 dark:text-slate-200"><i class="mgc_add_fill text-base me-4"></i> Withdraw Funds</a>
                            </div>

                        </div>
                    </div>
                </div>

                <a href="{{ route('transaction.buy-awg.create') }}" class="my-3 btn bg-light text-slate-900 dark:text-slate-200">
                    <i class="mgc_copper_coin_line"></i> Buy Aruba (AWG)
                </a>

                {{--Exchange rate modal toggle --}}
                <button class="btn bg-primary text-white" data-fc-type="modal" type="button">
                    View Exchange Rates
                </button>

                {{--Exchange rate modal --}}
                <div class="fixed top-0 left-0 z-50 transition-all duration-500 fc-modal hidden w-full h-full min-h-full items-center fc-modal-open:flex">
                    <div class="fc-modal-open:opacity-100 duration-500 opacity-0 ease-out transition-[opacity] sm:max-w-lg sm:w-full sm:mx-auto  flex-col bg-white border shadow-sm rounded-md dark:bg-slate-800 dark:border-gray-700">
                        <div class="flex justify-between items-center py-2.5 px-4 border-b dark:border-gray-700">
                            <h3 class="font-medium text-gray-800 dark:text-white text-lg">
                                Exchange Rates
                            </h3>
                            <button class="inline-flex flex-shrink-0 justify-center items-center h-8 w-8 "
                                    data-fc-dismiss type="button">
                                <span class="material-symbols-rounded">close</span>
                            </button>
                        </div>
                        <div class="px-4 py-8 overflow-y-auto">
                            <p class="font-bold text-primary">Kindly be aware that exchange rates may fluctuate based on currency market prices.</p>
                            @php
                                $settings = app(\App\Settings\GeneralSetting::class);
                            @endphp
                            <div class="rounded-md mt-3 space-y-4">
                                <div class="flex justify-between p-4 border rounded">
                                    <span class="flex items-center gap-1 font-bold">
                                        <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                                        1 ARUBA(AWG)
                                    </span>
                                    <span class="flex items-center gap-1 font-bold">
                                        ₦{{ $settings->awg_rate }}
                                    </span>
                                </div>

                                <div class="flex justify-between p-4 border rounded">
                                    <span class="flex items-center gap-1 font-bold">
                                        <img src="{{ asset('images/flags/us.jpg') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                                        1 USD
                                    </span>
                                    <span class="flex items-center gap-1 font-bold">
                                        ₦{{ $settings->usd_rate_official }} (Official Market Rate)
                                    </span>
                                </div>

                                <div class="flex justify-between p-4 border rounded">
                                    <span class="flex items-center gap-1 font-bold">
                                        <img src="{{ asset('images/flags/us.jpg') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                                        1 USD
                                    </span>
                                    <span class="flex items-center gap-1 font-bold">
                                        ₦{{ $settings->usd_rate_parallel }} (Parallel Market Rate)
                                    </span>
                                </div>


                                <p class="mt-4">Aruba to USD exchange processing time: <span class="font-bold text-primary">up to {{ $settings->aruba_to_usd_processing_time / 60 }} hours.</span></p>
                                <p>USD to Naira exchange processing time (Official rate): <span class="font-bold text-primary">up to {{ $settings->usd_to_naira_processing_time_official / 60 }} hours.</span></p>
                                <p>USD to Naira exchange processing time (Parallel rate): <span class="font-bold text-primary">up to {{ $settings->usd_to_naira_processing_time_parallel_market / 60 }} hours.</span></p>
                            </div>


                        </div>
                        <div class="flex justify-end items-center gap-4 p-4 border-t dark:border-slate-700">
                            <button class="py-2 px-5 inline-flex justify-center items-center gap-2 rounded  border dark:border-slate-700 font-medium hover:bg-slate-100 hover:dark:bg-slate-700 transition-all" data-fc-dismiss type="button">Close</button>
                        </div>
                    </div>
                </div>

                @if(str($settings->whatsapp_group_link)->startsWith('https://'))
                    <a href="{{ $settings->whatsapp_group_link }}" class="my-3 text-primary underline inline-flex">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.213 9.787a3.391 3.391 0 0 0-4.795 0l-3.425 3.426a3.39 3.39 0 0 0 4.795 4.794l.321-.304m-.321-4.49a3.39 3.39 0 0 0 4.795 0l3.424-3.426a3.39 3.39 0 0 0-4.794-4.795l-1.028.961"/>
                        </svg>
                        Join Our WhatsApp Group
                    </a>
                @endif
            </div>
        </div>

        <!-- Connected bank account details -->
        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title text-sm lg:text-xl capitalize">Your <span class="hidden md:inline">Connected</span> Bank account details</p>
                    <a href="{{ route('dashboard.profile') }}" class="btn text-white bg-primary">Edit <span class="hidden md:inline ms-1" >Account Details</span></a>
                </div>

                <div class="p-6">
                    <div class="flex flex-col lg:flex-row gap-16">
                        <!-- stat 1 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="users" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">{{ $user->accountname }}</h4>
                                <span class="text-sm">Account Holder</span>
                            </div>
                        </div>

                        <!-- stat 2 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="hash" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">{{ $user->accountnumber }}</h4>
                                <span class="text-sm">Account Number</span>
                            </div>
                        </div>

                        <!-- stat 3 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="briefcase" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">{{ $user->bankname }}</h4>
                                <span class="text-sm">Bank Name</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>


    {{--        Transactions--}}
    <div class="card p-6 mt-6">
        <div class="flex justify-between items-center mb-1">
            <p class="card-title">Recent Transactions</p>
        </div>

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
                            {{-- <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th> --}}
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($transactions as $transaction)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 ">
                                    <span class="uppercase">{{ $transaction->reference }}</span>
                                    @if(($transaction->type == \App\Enums\TransactionType::CONVERSION || $transaction->type == \App\Enums\TransactionType::ORDER) && $transaction->status == \App\Enums\TradeStatus::PENDING)
                                        @php
                                            $timeLeft = $transaction->type == \App\Enums\TransactionType::CONVERSION
                                                        ? $transaction->conversion->getTimeLeft()
                                                        : $transaction->order->getTimeLeft();
                                        @endphp
                                        @if($timeLeft > 0)
                                            <x-countdown :timeRemaining="$timeLeft" />
                                        @else
                                            <p class="italic font-light">{{ \Carbon\Carbon::parse($transaction->created_at)->diffForHumans() }} <br /></p>
                                        @endif
                                    @else
                                        <p class="italic font-light">{{ \Carbon\Carbon::parse($transaction->created_at)->diffForHumans() }} <br /></p>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">{{ $transaction->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 ">{{ $transaction->currency->toString() }} {{ \Illuminate\Support\Number::format($transaction->amount/100) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                    <span style="color: {{ $transaction->status->color() }}">{{ $transaction->status }}</span>
                                </td>
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
@endsection


@push('scripts')
    @livewireScripts
@endpush
