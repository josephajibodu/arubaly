@extends('layouts.app')

@section('title', 'Account Dashboard')

@section('content')
    <div class="grid lg:grid-cols-3 gap-6">

        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
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
                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">53.42</h4>
                                    </div>

                                    <div class="text-center space-y-3">
                                        <span class="text-sm">Pending Balance<i data-feather="info" class="h-4 w-4 inline"></i></span>
                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">0.00</h4>
                                    </div>
                                </div>

                                <div class="flex gap-2">
                                    <button type="button" class="btn bg-light text-slate-900 dark:text-slate-200"><i class="mgc_add_fill text-base me-4"></i> Convert AWG to USD</button>
                                </div>
                            </div>
                        </div>
                        <div id="pills-with-brand-color-2" class="hidden" role="tabpanel" aria-labelledby="pills-with-brand-color-item-2">

                            <div class="p-6 flex flex-col items-center gap-6">
                                <div class="flex items-center justify-center gap-16">
                                    <div class="text-center space-y-3">
                                        <span class="text-sm">Available Balance <i data-feather="info" class="h-4 w-4 inline"></i></span>
                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">$999.80</h4>
                                    </div>

                                    <div class="text-center space-y-3">
                                        <span class="text-sm">Pending Balance<i data-feather="info" class="h-4 w-4 inline"></i></span>
                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">$299.00</h4>
                                    </div>
                                </div>

                                <button type="button" class="btn bg-light text-slate-900 dark:text-slate-200"><i class="mgc_add_fill text-base me-4"></i> Convert USD to Naira</button>
                            </div>

                        </div>
                        <div id="pills-with-brand-color-3" class="hidden" role="tabpanel" aria-labelledby="pills-with-brand-color-item-3">

                            <div class="p-6 flex flex-col items-center gap-6">
                                <div class="flex items-center justify-center gap-16">
                                    <div class="text-center space-y-3">
                                        <span class="text-sm">Available Balance <i data-feather="info" class="h-4 w-4 inline"></i></span>
                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">&#8358;100,000.80</h4>
                                    </div>

                                    <div class="text-center space-y-3">
                                        <span class="text-sm">Pending Balance<i data-feather="info" class="h-4 w-4 inline"></i></span>
                                        <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">&#8358;299.00</h4>
                                    </div>
                                </div>

                                <button type="button" class="btn bg-light text-slate-900 dark:text-slate-200"><i class="mgc_add_fill text-base me-4"></i> Withdraw Funds</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Connected bank account details -->
        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">Your Connected Bank account details</p>
                    <button class="btn text-white bg-primary">Edit Account Details</button>
                </div>

                <div class="p-6">
                    <div class="flex gap-16">
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

        <!-- Transactions -->
        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">Recent Transactions</p>
                </div>

                <div class="p-6">

                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="border rounded-lg overflow-hidden dark:border-gray-700">
                                <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                                    <thead>
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Age</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Address</th>
                                        <th scope="col" class="px-6 py-3 text-end text-xs font-medium text-gray-500 uppercase">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">John Brown</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">45</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">New York No. 1 Lake Park</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <a class="text-primary hover:text-sky-700" href="#">Delete</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">Jim Green</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">27</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">London No. 1 Lake Park</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <a class="text-primary hover:text-sky-700" href="#">Delete</a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800 dark:text-gray-200">Joe Black</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">31</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800 dark:text-gray-200">Sidney No. 1 Lake Park</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-end text-sm font-medium">
                                            <a class="text-primary hover:text-sky-700" href="#">Delete</a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection
