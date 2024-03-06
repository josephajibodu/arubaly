<div class="flex justify-center w-full">
    <div class="card max-w-lg w-full animate__animated animate__fadeIn">
            <div class="p-6 flex flex-col gap-4">

                <div class="flex justify-between p-4 border rounded">
                    <span class="flex items-center gap-1">
                        <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/> Balance
                    </span>
                    <span class="font-bold text-gray-900 text-base">&#8358; {{ \Illuminate\Support\Number::format($user->ngn->balance / 100) }}</span>
                </div>

                <div class="flex flex-col gap-2">
                    <label for="amount-to-convert">Amount to withdraw</label>
                    <div class="flex">
                        <div
                            class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                        >
                            <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        </div>
                        <input
                            wire:model.live.debounce.500ms="amount"
                            id="amount"
                            type="number"
                            placeholder="0.00"
                            step="0.01"
                            class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                        />
                    </div>
                    @error('amount')
                    <p class="mt-0 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="p-4 border rounded">
                    <div class="flex flex-col mt-4">
                        <span class="flex items-center gap-1 font-bold">
                        Bank Name
                        </span>
                        <p class="mt-1">
                            {{ $user->bankname }}
                        </p>
                    </div>

                    <div class="flex flex-col mt-4">
                        <span class="flex items-center gap-1 font-bold">
                        Account Name
                        </span>
                        <p class="mt-1">
                            {{ $user->accountname }}
                        </p>
                    </div>

                    <div class="flex flex-col mt-4">
                        <span class="flex items-center gap-1 font-bold">
                        Account Number
                        </span>
                        <p class="mt-1">
                            {{ $user->accountnumber }}
                        </p>
                    </div>

                </div>

                <button wire:click="withdraw" class="btn bg-primary text-white mt-2">
                    Proceed
                </button>
            </div>
        </div>
</div>
