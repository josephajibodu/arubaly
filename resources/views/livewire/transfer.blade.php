<div class="flex justify-center w-full">
    <div class="card max-w-lg w-full animate__animated animate__fadeIn">
        <div class="p-6 flex flex-col gap-4">

            @if($currency == \App\Enums\Currency::USD)
                <div class="flex justify-between p-4 border rounded">
                    <span class="flex items-center gap-1">
                        <img src="{{ asset('images/flags/us.jpg') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/> Balance
                    </span>
                    <span class="font-bold text-gray-900 text-base">$ {{ \Illuminate\Support\Number::format($user->usd->balance / 100) }}</span>
                </div>
            @elseif($currency == \App\Enums\Currency::AWG)
                <div class="flex justify-between p-4 border rounded">
                    <span class="flex items-center gap-1">
                        <img src="{{ asset('images/flags/awg.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/> Balance
                    </span>
                    <span class="font-bold text-gray-900 text-base"> {{ \Illuminate\Support\Number::format($user->awg->balance / 100) }}</span>
                </div>
            @endif

            <div class="flex flex-col gap-2">
                <label for="currency">Select Currency</label>
                <select wire:model.live="currency" id="currency" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected>Choose a currency</option>
                    @foreach(\App\Enums\Currency::cases() as $currency)
                        @if($currency == \App\Enums\Currency::NGN)
                        @else
                        <option value="{{ $currency }}">{{ $currency->label() }}</option>
                        @endif
                    @endforeach
                </select>
                @error('currency')
                <p class="mt-0 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col gap-2">
                <label for="amount">Amount to transfer</label>
                <div class="flex">
                    <div
                        class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                    >
                        @if($currency == \App\Enums\Currency::USD)
                            <img src="{{ asset('images/flags/us.jpg') }}?v1" class="h-4 w-4 rounded-full"  alt="us icon"/>
                        @else
                            <img src="{{ asset('images/flags/awg.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        @endif
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

            <div class="flex flex-col gap-2">
                <label for="recipient">Username</label>
                <div class="flex">
                    <div
                        class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                    >
                        @
                    </div>
                    <input
                        wire:model.live.debounce.2000ms="recipient"
                        id="username"
                        type="text"
                        class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                    />
                </div>
                @error('recipient')
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

            <button wire:click="transfer" class="btn bg-primary text-white mt-2">
                Proceed
            </button>
        </div>
    </div>
</div>
