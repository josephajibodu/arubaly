@extends('layouts.app')

@section('title', 'Buy Airtime, Data and make Bills payments and get cash rewards.')

@section('content')
    <div class="grid lg:grid-cols-3 gap-6">

        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">My Balance</p>
                    <button type="button" class="btn bg-dark text-white"><i class="mgc_add_fill text-base me-4"></i> Add Funds</button>
                </div>

                <div class="p-6 flex flex-col items-center gap-6">
                    <div class="flex items-center justify-center gap-16">
                        <div class="text-center space-y-3">
                            <span class="text-sm">Available Balance <i data-feather="info" class="h-4 w-4 inline"></i></span>
                            <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">&#8358;4,999.80</h4>
                        </div>

                        <div class="text-center space-y-3">
                            <span class="text-sm">Bonus/Cash Back <i data-feather="info" class="h-4 w-4 inline"></i></span>
                            <h4 class="text-4xl text-gray-700 dark:text-gray-300 font-bold">&#8358;299.00</h4>
                        </div>
                    </div>

                    <button type="button" class="btn bg-light text-slate-900 dark:text-slate-200"><i class="mgc_add_fill text-base me-4"></i> Add Funds</button>
                </div>
            </div>
        </div>

        <!-- Virtual bank account details -->
        <div class="lg:col-span-3 space-y-6">
            <div class="card p-6">
                <div class="flex justify-between items-center mb-4">
                    <p class="card-title">Your Virtual Bank account details</p>
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800"><i class="mgc_copy_2_line"></i> Copy Account Number</span>
                </div>

                <div class="p-6">
                    <div class="flex gap-16">
                        <!-- stat 1 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="users" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">Joseph Oluwayomi Ajibodu</h4>
                                <span class="text-sm">Account Holder</span>
                            </div>
                        </div>

                        <!-- stat 2 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="hash" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">8167297386</h4>
                                <span class="text-sm">Account Number</span>
                            </div>
                        </div>

                        <!-- stat 3 -->
                        <div class="flex items-center gap-5">
                            <i data-feather="briefcase" class="h-10 w-10"></i>
                            <div class="">
                                <h4 class="text-lg text-gray-700 dark:text-gray-300 font-medium">Opay Ltd</h4>
                                <span class="text-sm">Bank Name</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4" role="alert">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="mgc_information_line text-xl"></i>
                        </div>
                        <div class="ms-4">
                            <h3 class="text-sm text-yellow-800 font-semibold">
                                Please note the following:
                            </h3>
                            <div class="mt-1 text-sm text-yellow-700">
                                <ul>
                                    <li>- We charge a flat fee of 100 Naira for every deposit</li>
                                    <li>- You deposit reflects in the shortest time possible(few seconds)</li>
                                </ul>
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
                    <span class="inline-flex items-center gap-1.5 py-1.5 px-3 rounded-full text-xs font-medium bg-gray-100 text-gray-800"><i class="mgc_copy_2_line"></i> Copy Account Number</span>
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
