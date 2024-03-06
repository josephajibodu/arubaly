<div class="flex justify-center">
    @if(!$merchant)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
       @foreach($merchants as $merchant)
            <!-- Merchant Cards -->
            <!-- Repeat this card structure for each merchant -->
            <div class="card px-4 py-4 ">
                <h2 class="text-xl font-semibold mb-2 text-primary">Merchant (Username)</h2>
                <p class="mb-2">Selling Price: ₦497</p>
                <p class="mb-2">Available Aruba (AWG): 400 Aruba Florin (AWG)</p>
                <p class="mb-2">Amount Limit: ₦20,000 - ₦600,000</p>
                <p class="mb-2">Status: Available</p>
                <p class="mb-2">Payment: Bank Transfer</p>
                <button wire:click="selectMerchant({{ $merchant->id }})" class="btn bg-primary text-white" data-modal-target="buy-awg" data-modal-toggle="buy-awg">BUY ARUBA(AWG)</button>
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
        <div class="card max-w-lg w-full">
            <div class="p-6 flex flex-col gap-4">
                <div class="flex justify-between p-4 border rounded">
                <span class="flex items-center gap-1">
                    <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                    AWG Balance
                </span>
                    <span class="font-bold text-gray-900 text-base">3.456</span>
                </div>


                <div class="flex flex-col gap-2">
                    <label for="amount-to-convert">Amount to convert</label>
                    <div class="flex">
                        <div
                            class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        >
                            <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        </div>
                        <input
                            wire:model.live="amount"
                            id="amount-to-convert"
                            type="number"
                            placeholder="0.00"
                            class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                        />
                    </div>
                </div>

                <div class="border bg-gray-200 rounded-xl p-4 flex flex-col gap-3">
                    <div class="flex justify-between">
                    <span class="flex items-center gap-1">
                        Conversion Fee
                    </span>
                        <span class="text-gray-900">8%</span>
                    </div>
                    <div class="flex justify-between">
                    <span class="flex items-center gap-1">
                        Amount we'll convert
                    </span>
                        <span class="text-gray-900">{{ $amount ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between">
                    <span class="flex items-center gap-1">
                        Exchange Duration
                    </span>
                        <span class="text-gray-900">4hr</span>
                    </div>
                    <div class="flex justify-between">
                    <span class="flex items-center gap-1">
                        Today's rate
                    </span>
                    </div>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="amount-to-convert">Amount you will receive</label>
                    <div class="flex">
                        <div
                            class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        >
                            <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        </div>
                        <input
                            wire:model="amountReceived"
                            id="amount-to-receive"
                            type="number"
                            placeholder="0.00"
                            step="0.01"
                            class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                        />
                    </div>
                </div>

                <button class="btn bg-primary text-white mt-2">
                    Convert
                </button>
            </div>
        </div>
    @endif
</div>
