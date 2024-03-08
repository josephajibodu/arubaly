@extends('layouts.app')

@section('title', 'Merchant Profile')

@section('content')
    <!-- Page Title Start -->
    <div class="flex justify-between items-center mb-6">
        <h4 class="text-slate-900 dark:text-slate-200 text-lg font-medium">Merchant Settings</h4>

    </div>
    <!-- Page Title End -->

    <div class="gap-6 w-full max-w-screen-xl space-y-8">

        <div class="">
            <div class="card">
                <div class="card-header">
                    <div class="flex justify-between items-center">
                        <h4 class="card-title">Merchant Settings</h4>
                        <div class="flex items-center gap-2">
                            {{--                            <button type="button" class="btn-code">--}}
                            {{--                                <i class="mgc_eye_line text-lg"></i>--}}
                            {{--                                <span class="ms-2">Code</span>--}}
                            {{--                            </button>--}}
                        </div>
                    </div>
                </div>

                <div class="p-6">
                    <form action="{{ route('dashboard.merchant.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1  gap-6">

                            <div>
                                <label for="rate" class="text-gray-800 text-sm font-medium inline-block mb-2 ">Aruba Selling Price</label>
                                <input type="number" name="rate" class="form-input w-fit" id="rate" value="{{ old('rate') ?? $user->rate / 100 }}">

                                @error('rate')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="availability" class="text-gray-800 text-sm font-medium inline-block mb-2 ">Availability</label>
                                <div>
                                    <label class="inline-flex items-center mb-5 cursor-pointer gap-1">
                                        <span class="ms-3 text-sm font-medium text-gray-900 dark:text-gray-300">Sold out</span>
                                        <input type="checkbox" name="availability" @if($user->availability == \App\Enums\MerchantAvailability::AVAILABLE) checked @endif class="sr-only peer">
                                        <div class="relative w-11 h-6 bg-primary/50 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-primary rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:w-5 after:h-5 after:transition-all dark:border-gray-600 peer-checked:bg-primary"></div>
                                        <span class="text-sm font-medium text-gray-900 dark:text-gray-300">Available</span>
                                    </label>
                                </div>

                                @error('availability')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="min_amount" class="text-gray-800 text-sm font-medium inline-block mb-2 ">Min Amount</label>
                                <input type="number" name="min_amount" class="form-input w-fit" id="min_amount" value="{{ old('min_amount') ?? $user->min_amount / 100 }}">

                                @error('min_amount')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="max_amount" class="text-gray-800 text-sm font-medium inline-block mb-2 ">Max Amount</label>
                                <input type="number" name="max_amount" class="form-input w-fit" id="max_amount" value="{{ old('max_amount') ?? $user->max_amount / 100 }}">

                                @error('max_amount')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="payment_type" class="text-gray-800 text-sm font-medium inline-block mb-2">Payment Type</label>
                                <input placeholder="e.g. Bank Transfer" type="text" class="form-input w-fit" id="payment_type" name="payment_type" value="{{ old('payment_type') ?? "$user->payment_type" }}">

                                @error('payment_type')
                                    <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="terms" class="text-gray-800 text-sm font-medium inline-block mb-2">Terms</label>
                                <textarea
                                    id="terms"
                                    name="terms"
                                    rows="4"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                                    placeholder="Leave instructions for buyers..."
                                >{{ old('terms') ?? "$user->terms" }}</textarea>
                                @error('terms')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                        <button type="submit" class="btn bg-primary text-white mt-4">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
