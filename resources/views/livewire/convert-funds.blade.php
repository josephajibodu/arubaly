<form wire:submit="convert" class="card max-w-lg w-full">
    <div class="p-6 flex flex-col gap-4">
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

            $settings = app(\App\Settings\GeneralSetting::class);

            $processingTime = match ($from) {
                \App\Enums\Currency::USD => $isParallel ? $settings->usd_to_naira_processing_time_parallel_market / 60 : $settings->usd_to_naira_processing_time_official / 60,
                \App\Enums\Currency::AWG => $settings->aruba_to_usd_processing_time / 60
            }
        @endphp

        @if($from == \App\Enums\Currency::USD)
            <div class="flex justify-between p-4 border rounded">
                    <span class="flex items-center gap-1">
                        <img src="{{ asset('images/flags/us.jpg') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/> Balance
                    </span>
                <span class="font-bold text-gray-900 text-base">$ {{ \Illuminate\Support\Number::format($user->usd->balance / 100) }}</span>
            </div>
        @elseif($from == \App\Enums\Currency::AWG)
            <div class="flex justify-between p-4 border rounded">
                    <span class="flex items-center gap-1">
                        <img src="{{ asset('images/flags/awg.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/> Balance
                    </span>
                <span class="font-bold text-gray-900 text-base"> {{ \Illuminate\Support\Number::format($user->awg->balance / 100) }}</span>
            </div>
        @endif

        @if($from == \App\Enums\Currency::USD)
        <div class="flex gap-4">
            <div wire:click="setParallel('{{ false }}')" class="cursor-pointer flex justify-between p-4 @if(!$isParallel) border-4 border-primary bg-primary/30 @else border @endif rounded w-full">
                <span class="flex items-center gap-1">
                    Official
                </span>
                <span class="font-bold text-gray-900 text-base">₦{{ \Illuminate\Support\Number::format($settings->usd_rate_official) }}</span>
            </div>

            <div wire:click="setParallel('{{ true }}')" class="cursor-pointer flex justify-between p-4 @if($isParallel) border-4 border-primary bg-primary/30 @else border @endif rounded w-full">
                <span class="flex items-center gap-1">
                    Parallel
                </span>
                <span class="font-bold text-gray-900 text-base">₦{{ \Illuminate\Support\Number::format($settings->usd_rate_parallel) }}</span>
            </div>
        </div>
        @endif


        <div class="flex flex-col gap-2">
            <label for="amount-to-convert">Amount to convert</label>
            <div class="flex">
                <div
                    class="inline-flex items-center px-4 rounded-s border border-e-0 border-gray-200 bg-gray-50 text-gray-500 dark:bg-gray-700 dark:border-gray-700 dark:text-gray-400"
                >
                    <img src="{{ asset($fromImageUrl) }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                </div>
                <input
                    wire:model.live.debounce.1000ms="amount"
                    id="amount-to-convert"
                    type="number"
                    placeholder="0.00"
                    class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                />
            </div>
            @error('amount')
            <p class="mt-0 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="border bg-gray-200 rounded-xl p-4 flex flex-col gap-3">
            <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Conversion Fee
                        </span>
                <span class="text-gray-900">{{ $settings->exchange_fee_percentage }}%</span>
            </div>
            <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Amount we'll convert
                        </span>
                <span class="text-gray-900">{{ \Illuminate\Support\Number::format(($amount ?? 0) * (100 - $settings->exchange_fee_percentage) * 0.01) }}</span>
            </div>
            <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Exchange Duration
                        </span>
                <span class="text-gray-900">{{ $processingTime }} hr</span>
            </div>
            <div class="flex justify-between">
                        <span class="flex items-center gap-1">
                            Today's rate
                        </span>
                <span class="text-gray-900">  {{ $rate }}</span>
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
                    wire:model.live.debounce.1000ms="amountReceived"
                    id="amount-to-receive"
                    type="number"
                    placeholder="0.00"
                    step="0.01"
                    class="form-input ltr:rounded-l-none rtl:rounded-r-none"
                />
            </div>
            @error('amountReceived')
            <p class="mt-0 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn bg-primary text-white mt-2 flex gap-1 items-center" wire:loading.class="opacity-50" wire:loading.attr="disabled">
            Convert
            <div role="status" wire:loading>
                <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin fill-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                </svg>
                <span class="sr-only">Loading...</span>
            </div>
        </button>
    </div>
</form>


@script
<script>
    $wire.on('success', (message) => {
        Swal.fire({
            title: 'Awesome!',
            text: message,
            icon: 'success',
        })
    });

    $wire.on('error', (message) => {
        Swal.fire({
            title: 'Error!',
            text: message,
            icon: 'error',
        })
    });
</script>
@endscript
