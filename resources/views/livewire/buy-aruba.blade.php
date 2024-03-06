<div class="flex justify-center">
    @if(!$merchant)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
       @foreach($merchants as $merchant)
            <!-- Merchant Cards -->
            <!-- Repeat this card structure for each merchant -->
            <div class="card px-4 py-4 ">
                <h2 class="text-xl font-semibold mb-2 text-primary">Merchant ({{ $merchant->username }})</h2>
                <p class="mb-2">Selling Price: <b>{{ Illuminate\Support\Number::currency($merchant->rate / 100, 'NGN') }}</b></p>
                <p class="mb-2">Available Aruba (AWG): <b>{{ Illuminate\Support\Number::format($merchant->awg->balance / 100) }}</b></p>
                <p class="mb-2">Amount Limit: <b>₦{{ Illuminate\Support\Number::format($merchant->min_amount / 100) }} - ₦{{ Illuminate\Support\Number::format($merchant->max_amount / 100) }}</b></p>
                <p class="mb-2">Status: <b class="@if($merchant->availability == \App\Enums\MerchantAvailability::SOLDOUT) text-danger @endif">{{ $merchant->availability->label() }}</b></p>
                <p class="mb-2">Payment: <b>{{ $merchant->payment_type }}</b></p>


                <button wire:click="selectMerchant({{ $merchant->id }})" @if($merchant->availability == \App\Enums\MerchantAvailability::SOLDOUT) disabled @endif class="btn bg-primary text-white disabled:opacity-20">BUY ARUBA(AWG)</button>

            </div>
            <!-- End Merchant Cards -->
        @endforeach
    </div>
        @if(count($merchants) == 0)
            <div class="border-2 border-dashed rounded-xl w-full max-w-screen-lg py-10 px-8 text-center">
                <p class="text-xl text-primary">No merchant available at the moment</p>
            </div>
        @endif
    @else
        <div class="card max-w-lg w-full animate__animated animate__slideInRight">
            <div class="p-6 flex flex-col gap-4">

                <div class="flex flex-col gap-2">
                    <label for="amount-to-convert">Amount of Aruba Florin (AWG) to buy</label>
                    <div class="flex">
                        <div
                            class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        >
                            <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        </div>
                        <input
                            wire:model.live.debounce.500ms="amount"
                            id="amount-to-buy"
                            type="number"
                            placeholder="0.00"
                            step="0.01"
                            class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                        />
                    </div>
                </div>

                <div class="border bg-gray-200 rounded-xl p-4 flex flex-col gap-3">
                    <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Merchant rate
                        </span>
                        <span class="text-gray-900">{{ Illuminate\Support\Number::currency($merchant->rate / 100, 'NGN') }}/AWG</span>
                    </div>

                    <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Amount Limit
                        </span>
                        <span class="text-gray-900">
                            ₦{{ Illuminate\Support\Number::format($merchant->min_amount / 100) }} - ₦{{ Illuminate\Support\Number::format($merchant->max_amount / 100) }}
                        </span>
                    </div>

                </div>

                <div class="flex flex-col gap-2">
                    <label for="amount-to-convert">Amount of Naira (NGN) to pay</label>
                    <div class="flex">
                        <div
                            class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        >
                            <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        </div>
                        <input
                            wire:model="payableAmount"
                            id="amount-to-pay"
                            type="number"
                            placeholder="0.00"
                            step="0.01"
                            class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                        />
                    </div>
                </div>

                <button wire:click="buy" class="btn bg-primary text-white mt-2">
                    Proceed
                </button>
            </div>
        </div>
    @endif
</div>
