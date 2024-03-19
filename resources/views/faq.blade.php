@extends('layouts.guest')

@section('title', 'Frequently Asked Questions')

@section('content')
    @php
        $faqs = config('faq');
    @endphp

    <div class="overflow-hidden bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-screen-lg px-6 lg:px-8">
            <div class="mx-auto gap-x-8">
                <div class="lg:pt-4">
                    <div class="">
                        <h1 class="mt-2 text-center text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Frequently Asked Questions</h1>
                    </div>

                    <div class="py-12 flex flex-col justify-center items-center">

                        <div id="accordion-collapse" data-accordion="collapse" class="max-w-screen-md w-full flex flex-col gap-4">
                            @foreach ($faqs as $faq)
                                <div class="bg-white rounded-xl overflow-hidden shadow-md">
                                    <h2 id="accordion-collapse-heading-{{ $loop->index }}">
                                        <button type="button"
                                                class="flex items-center justify-between w-full p-5 bg-transparent font-medium text-start text-xl gap-3 text-black dark:bg-transparent dark:text-black"
                                                data-accordion-target="#accordion-collapse-body-{{ $loop->index }}" aria-expanded="true"
                                                aria-controls="accordion-collapse-body-{{ $loop->index }}">
                                            <span>{{ $faq['question'] }}</span>
                                            <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                                                 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                      stroke-width="2" d="M9 5 5 1 1 5" />
                                            </svg>
                                        </button>
                                    </h2>
                                    <div id="accordion-collapse-body-{{ $loop->index }}" class="hidden transition-all duration-700"
                                         aria-labelledby="accordion-collapse-heading-{{ $loop->index }}">
                                        <div class="p-5 pt-0 flex flex-col gap-3">
                                            @if(is_array($faq['answer']))
                                                @foreach($faq['answer'] as $answer)
                                                    <p class="mb-2 text-gray-500 text-base">{!! $answer !!}</p>
                                                @endforeach
                                            @else
                                                <p class="mb-2 text-gray-500 text-base">{!! $faq['answer'] !!}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
