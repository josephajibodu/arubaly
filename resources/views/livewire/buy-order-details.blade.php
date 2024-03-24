<div class="flex justify-center">
    <div class="card max-w-lg w-full">
        <div class="p-6 flex flex-col gap-4">
            <div class="flex justify-between p-4 border rounded">
                <span class="flex items-center gap-1 font-bold">
                    Buying
                </span>
                <span class="flex items-center gap-1">
                    <img src="{{ asset('images/flags/awg.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                    ({{ $transaction->currency->toString() }}) {{ $transaction->amount / 100 }}
                </span>
            </div>

            <div class="flex justify-between p-4 border rounded">
                <span class="flex items-center gap-1 font-bold">
                    Please pay
                </span>
                <span class="flex items-center gap-1">
                    <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full"  alt="awg icon"/>
                    ({{ $transaction->order->payable_currency->toString() }}) {{ \Illuminate\Support\Number::format($transaction->order->payable_amount / 100) }}
                </span>
            </div>

            <div class="p-4 border rounded">
                <div class="flex flex-col">
                    <span class="flex items-center gap-1 font-bold">
                    Merchant Username
                    </span>
                    <p class="mt-2">
                        {{ $transaction->order->merchant->username }}
                    </p>
                </div>

                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    Merchant WhatsApp
                    </span>
                    <p class="mt-2">
                        {{ $transaction->order->merchant->whatsappnumber }}
                    </p>
                </div>

                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    Merchant Terms
                    </span>
                    <p class="mt-2">
                        {{ $transaction->order->merchant->terms }}
                    </p>
                </div>

                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    Order Created
                    </span>
                    <p class="mt-2">
                        {{ \Carbon\Carbon::parse($transaction->created_at)->diffForHumans() }}
                    </p>
                </div>

                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    Order ID
                    </span>
                    <p class="mt-2">
                        {{ $transaction->reference }}
                    </p>
                </div>

                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    Order Status
                    </span>
                    <p class="mt-2 w-fit bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded border border-gray-500">
                        {{ \Illuminate\Support\Str::title($transaction->status->value) }}
                    </p>
                </div>

                @if($transaction->status == \App\Enums\TradeStatus::PENDING)
                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    Payment Time Limit
                    </span>
                    <p class="mt-2">
                        {{ $transaction->order->payment_limit }} minutes

                        @php
                            $timeLeft = $transaction->order->getTimeLeft();
                        @endphp

                        @if ($timeLeft > 0)
                            <x-countdown :timeRemaining="$timeLeft" />
                        @endif
                    </p>
                </div>
                @endif
            </div>

            @if($transaction->status == \App\Enums\TradeStatus::PENDING)
            <div class="p-4 border rounded">
                <p>Transfer amount to the merchant account provided below.</p>
                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    Merchant Bank Name
                    </span>
                    <p class="mt-1">
                        {{ $transaction->order->merchant->bankname }}
                    </p>
                </div>

                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    Merchant Account Name
                    </span>
                    <p class="mt-1">
                        {{ $transaction->order->merchant->accountname }}
                    </p>
                </div>

                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    Merchant Account Number
                    </span>
                    <p class="mt-1">
                        {{ $transaction->order->merchant->accountnumber }}
                    </p>
                </div>

                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                    WhatsApp Number
                    </span>
                    <p class="mt-1">
                        {{ $transaction->order->merchant->whatsappnumber }}
                    </p>
                </div>

            </div>
            @endif

            <div class="p-4 border rounded">
                @if($transaction->status == \App\Enums\TradeStatus::PENDING && !$transactionExpired)
                    <p class="">After transferring the amount, upload screenshot and click on “Transferred, Notify
                        Merchant” button.</p>
                    <div class="w-full mt-4">
                    <div class="space-y-12" x-data="{
                            uploading: false,
                            progress: 0,
                            filename: '',
                         }"
                         x-on:livewire-upload-start="uploading = true"
                         x-on:livewire-upload-finish="uploading = false"
                         x-on:livewire-upload-cancel="uploading = false"
                         x-on:livewire-upload-error="uploading = false"
                         x-on:livewire-upload-progress="progress = $event.detail.progress;">
                        <div class="border-b border-gray-900/10 pb-12 flex flex-col items-center">

                            <div class="flex flex-col justify-center w-full max-w-lg mb-8">
                                <label for="payment_proof"
                                       class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-4 text-primary1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                             fill="none" viewBox="0 0 20 16">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400"><span
                                                class="font-semibold text-primary1">Click
                                to upload</span> or drag and drop</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 uppercase">jpg, jpeg, png, bmp, gif, svg, or
                                            webp <span class="text-gray-900 font-bold">(MAX.
                                2MB)</span>
                                        </p>
                                        <div x-show="uploading"
                                             class="w-full bg-gray-200 rounded-full h-1.5 mb-4 dark:bg-gray-700 mt-4">
                                            <div class="bg-gray-600 h-1.5 rounded-full  transition-all duration-700" style="width: 0%"
                                                 :style="{ width: progress + '%' }" :class="progress > 99 && 'bg-green-600'"></div>
                                        </div>
                                        <div class="w-24 h-24 bg-gray-400 mt-2 rounded overflow-hidden shadow-lg border">
                                            @if ($payment_proof)
                                                <img class="w-full h-full object-cover"
                                                     src="{{ $payment_proof->temporaryUrl() }}">
                                            @endif
                                        </div>

                                    </div>
                                    <input id="payment_proof" type="file" wire:model="payment_proof" class="hidden"
                                           accept=".jpg, .jpeg, .png, .webp, .bmp"
                                           x-on:change="filename = $event.target.files[0]" />

                                </label>
                                @error('payment_proof')
                                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <div class="mt-6 flex items-center justify-center gap-x-6">
                        <button type="submit" wire:loading.class="opacity-30" wire:loading.attr="disabled" wire:click="saveUploadProof"
                                class="rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pribg-primary1 flex items-center gap-2">
                            Transferred, Notify Merchant

                            <div role="status" wire:loading>
                                <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                     viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                        <button type="submit" wire:loading.class="opacity-30" wire:loading.attr="disabled" wire:click="cancelTrade"
                                class="rounded-md bg-red-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pribg-primary1 flex items-center gap-2">
                            Cancel

                            <div role="status" wire:loading>
                                <svg aria-hidden="true" class="w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                     viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                        fill="currentColor" />
                                    <path
                                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                        fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                        </button>
                    </div>
                </div>
                @elseif($transaction->status == \App\Enums\TradeStatus::PENDING && $transactionExpired)
                    <div>
                        <p class="animate__animated animate__shakeX text-red-500 font-bold">Payment window has elapsed. Reach out to the merchant on WhatsApp</p>

                        <a href="{{ route('dashboard') }}"
                           class="mt-6 w-fit rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pribg-primary1 flex items-center gap-2">
                            Return to Dashboard
                        </a>
                    </div>
                @elseif($transaction->status == \App\Enums\TradeStatus::PAYMENT_SENT)
                    <div>
                        <p class="animate__animated animate__shakeX text-green-500 font-bold">The Merchant has been notified, your payment will be confirmed within 1hour by the
                            merchant and your ARUBA(AWG) will be credited into your Arubaly balance.</p>

                        <p class="mt-4">Check your <a href="orders" class="underline text-primary font-bold">ORDER LIST</a> to view your transaction status.</p>
                        <a href="{{ route('dashboard') }}"
                           class="mt-6 w-fit rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pribg-primary1 flex items-center gap-2">
                            Return to Dashboard
                        </a>
                    </div>
                @elseif($transaction->status == \App\Enums\TradeStatus::PAYMENT_UNCONFIRMED)
                    <div>
                        <p class="mt-4">PAYMENT not RECEIVED. <a href="http://api.whatsapp.com/+234{{ $transaction->order->merchant->whatsappnumber }}" class="underline text-primary font-bold">Contact Merchant</a></p>
                        <a href="{{ route('dashboard') }}"
                           class="mt-6 w-fit rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pribg-primary1 flex items-center gap-2">
                            Return to Dashboard
                        </a>
                    </div>
                @elseif($transaction->status == \App\Enums\TradeStatus::CANCELLED)
                    <div>
                        <p class="animate__animated animate__shakeX text-red-500">Order cancelled, please click the below link to return to dashboard.</p>
                        <a href="{{ route('dashboard') }}"
                                class="mt-6 w-fit rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pribg-primary1 flex items-center gap-2">
                            Back to Dashboard
                        </a>

                    </div>
                @endif
            </div>

        </div>
    </div>

</div>
