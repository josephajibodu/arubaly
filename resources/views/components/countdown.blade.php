@props([
    'timeRemaining',
    'message'
])

<div
    x-data="{
        countdown: {{ $timeRemaining }},
        intervalRef: null,
        message: null,
        showMessage: false,
        init() {
            this.intervalRef = setInterval(() => {
                --this.countdown;

                if (this.countdown <= 0) {
                    clearInterval(this.intervalRef);
                    this.showMessage = true;
                }
            }, 1000);
        }
    }"
>
    <div x-show="!showMessage" class="inline-flex items-center text-sm font-medium bg-primary text-white px-2 py-1 rounded-xl">
        <span x-text="Math.floor(countdown / 3600).toString().padStart(2, '0')"></span>:
        <span x-text="Math.floor((countdown % 3600) / 60).toString().padStart(2, '0')"></span>:
        <span x-text="(countdown % 60).toString().padStart(2, '0')"></span>
    </div>

    <div x-show="showMessage" x-text="message ?? 'Done ✅'" class="inline-flex items-center text-[10px] font-medium bg-primary text-white px-2 py-1 rounded-xl"></div>
</div>
