<div class="card max-w-lg w-full">
    <div class="p-6 flex flex-col gap-4">
        <div class="flex justify-between p-4 border rounded">
                    <span class="flex items-center gap-1">
                        @php
                            $fromImageUrl = match ($from) {
                                \App\Enums\Currency::NGN => 'images/flags/ng.png',
                                \App\Enums\Currency::USD => 'images/flags/us.jpg',
                                \App\Enums\Currency::AWG => 'images/logo-sm.png',
                            };

                            $toImageUrl = match ($to) {
                                \App\Enums\Currency::NGN => 'images/flags/ng.png',
                                \App\Enums\Currency::USD => 'images/flags/us.jpg',
                                \App\Enums\Currency::AWG => 'images/logo-sm.png',
                            };
                        @endphp
                        <img src="{{ asset($fromImageUrl) }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                        {{ $from->label() }}({{ $from->toString() }}) Balance
                    </span>
            <span class="font-bold text-gray-900 text-base">3.456</span>
        </div>


        <div class="flex flex-col gap-2">
            <label for="amount-to-convert">Amount to convert</label>
            <div class="flex">
                <div
                    class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                >
                    <img src="{{ asset($fromImageUrl) }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                </div>
                <input
                    id="amount-to-convert"
                    type="text"
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
                <span class="text-gray-900 text-base">3.456</span>
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
                <span class="text-gray-900">x 3.456</span>
            </div>
        </div>

        <div class="flex flex-col gap-2">
            <label for="amount-to-convert">Amount you will receive</label>
            <div class="flex">
                <div
                    class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                >
                    <img src="{{ asset($toImageUrl) }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                </div>
                <input
                    id="amount-to-convert"
                    type="text"
                    placeholder="0.00"
                    class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                />
            </div>
        </div>

        <button class="btn bg-primary text-white mt-2">
            Convert
        </button>
    </div>
</div>
