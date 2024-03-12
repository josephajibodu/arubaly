<div class="flex justify-center" x-data>
    <div class="card max-w-lg w-full">
        <div class="p-6 flex flex-col gap-4">
            <div class="flex justify-between p-4 border rounded">
                <span class="flex items-center gap-1 font-bold">
                    <span class="uppercase">{{ $transaction->user->username }}</span> will pay you
                </span>
                <span class="flex items-center gap-1">
                    <img src="{{ asset('images/flags/ng.png') }}?v1" class="h-4 w-4 rounded-full" alt="awg icon" />
                    ({{ $transaction->order->payable_currency->toString() }})
                    {{ \Illuminate\Support\Number::format($transaction->order->payable_amount / 100) }}
                </span>
            </div>

            <div class="flex justify-between p-4 border rounded">
                <span class="flex items-center gap-1 font-bold">
                    To get
                </span>
                <span class="flex items-center gap-1">
                    <img src="{{ asset('images/flags/awg.png') }}?v1" class="h-4 w-4 rounded-full" alt="awg icon" />
                    ({{ $transaction->currency->toString() }}) {{ $transaction->amount / 100 }}
                </span>
            </div>

            <div class="p-4 border rounded">

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

                <div class="flex flex-col mt-4">
                    <span class="flex items-center gap-1 font-bold">
                        User AWG Balance
                    </span>
                    <p class="mt-2">
                        {{ \Illuminate\Support\Number::format($transaction->user->awg->balance / 100) }}
                    </p>
                </div>

                @if ($transaction->status == \App\Enums\TradeStatus::PENDING)
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

            @if ($transaction->status == \App\Enums\TradeStatus::PENDING && !$transactionExpired)
                <div class="p-4 border rounded">
                    <p>Once the user makes payment and uploads the proof, it will appear here.
                        You can then proceed to confirm the payment.
                    </p>
                </div>
            @endif

            @if ($transaction->status == \App\Enums\TradeStatus::PENDING && $transactionExpired)
                <div class="p-4 border rounded">
                    <p>
                        Payment window has elapsed. The user has not uploaded the payment proof.
                    </p>

                    <p>
                        If you eventually received the payment, you can approve it directly here.
                    </p>

                    <p>If you still haven't received the payment. Click on payment not received.</p>

                    <div class="flex justify-between">
                        <button
                            x-on:click="
                            let confirmed = confirm('Are you sure you want to proceed.');
                            if (confirmed) {
                                $wire.updateStatus('{{ \App\Enums\TradeStatus::PAYMENT_UNCONFIRMED }}')
                            }
                        "
                            class="mt-6 w-fit rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pribg-primary1 flex items-center gap-2">
                            Payment Not Received
                        </button>

                        <button
                            x-on:click="
                            let confirmed = confirm('Are you sure you want to confirm the transaction.');
                            if (confirmed) {
                                $wire.confirmTransaction()
                            }
                            "
                            class="mt-6 w-fit rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 flex items-center gap-2">
                            Payment Received
                        </button>
                    </div>
                </div>
            @endif

            @if ($transaction->status == \App\Enums\TradeStatus::PAYMENT_SENT)
                <div class="p-4 border rounded">
                    <p>
                        User has uploaded payment proof. Confirm and approve the trade.
                    </p>

                    <div class="flex justify-between">
                        <button
                            x-on:click="
                            let confirmed = confirm('Are you sure you want to proceed.');
                            if (confirmed) {
                                $wire.updateStatus('{{ \App\Enums\TradeStatus::PAYMENT_UNCONFIRMED }}')
                            }
                        "
                            class="mt-6 w-fit rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/80 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-pribg-primary1 flex items-center gap-2">
                            Payment Not Received
                        </button>

                        <button
                            x-on:click="
                            let confirmed = confirm('Are you sure you want to confirm the transaction.');
                            if (confirmed) {
                                $wire.confirmTransaction()
                            }
                            "
                            class="mt-6 w-fit rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 flex items-center gap-2">
                            Payment Received
                        </button>
                    </div>
                </div>
            @endif

            @if ($transaction->status == \App\Enums\TradeStatus::PAYMENT_UNCONFIRMED)
                <div class="p-4 border rounded">
                    <p>
                        If you eventually received the payment, you can approve it directly here.
                    </p>

                    <div class="flex justify-between">
                        <button
                            x-on:click="
                            let confirmed = confirm('Are you sure you want to confirm the transaction.');
                            if (confirmed) {
                                $wire.confirmTransaction()
                            }
                            "
                            class="mt-6 w-fit rounded-md bg-green-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-green-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-500 flex items-center gap-2">
                            Payment Received
                        </button>
                    </div>
                </div>
            @endif

            @if($transaction->status == \App\Enums\TradeStatus::CANCELLED)
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



@script
<script>
    $wire.on('success', (message) => {
        Swal.fire({
            title: 'Awesome!',
            text: message,
            icon: 'success',
        })
    });

    $wire.on('info', (message) => {
        Swal.fire({
            title: 'Hey!',
            text: message,
            icon: 'info',
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
