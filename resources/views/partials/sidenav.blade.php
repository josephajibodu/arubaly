<div class="app-menu overflow-auto">
    <!-- Sidenav Brand Logo -->
    <a href="{{ url('/') }}" class="logo-box">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img
                src="{{ asset('images/logo-light.png') }}"
                class="logo-lg h-6"
                alt="Light logo"
            />
            <img
                src="{{ asset('images/logo-sm.png') }}"
                class="logo-sm"
                alt="Small logo"
            />
        </div>

        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img
                src="{{ asset('images/logo-dark.png') }}"
                class="logo-lg h-6"
                alt="Dark logo"
            />
            <img
                src="{{ asset('images/logo-sm.png') }}"
                class="logo-sm"
                alt="Small logo"
            />
        </div>
    </a>

    <!-- Sidenav Menu Toggle Button -->
    <button
        id="button-hover-toggle"
        class="absolute top-5 end-2 rounded-full p-1.5"
    >
        <span class="sr-only">Menu Toggle Button</span>
        <i class="mgc_round_line text-xl"></i>
    </button>

    <!--- Menu -->
    <div class="srcollbar" data-simplebar>
        <ul class="menu" data-fc-type="accordion">
            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a href="{{ route('dashboard') }}" class="menu-link">
                    <span class="menu-icon"><i class="mgc_home_3_line"></i></span>
                    <span class="menu-text"> Dashboard </span>
                </a>
            </li>

            <li class="menu-title">Menu</li>

            <li class="menu-item">
                <a
                    href="javascript:void(0)"
                    data-fc-type="collapse"
                    class="menu-link"
                >
                <span class="menu-icon"
                ><i class="mgc_bank_line"></i
                    ></span>
                    <span class="menu-text"> Withdraw </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('transaction.withdrawal.index') }}" class="menu-link">
                            <span class="menu-text">Withdrawals</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('transaction.withdrawal.create') }}" class="menu-link">
                            <span class="menu-text">Withdraw funds</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a
                    href="javascript:void(0)"
                    data-fc-type="collapse"
                    class="menu-link"
                >
                <span class="menu-icon"
                ><i class="mgc_pig_money_line"></i
                    ></span>
                    <span class="menu-text"> Transfer </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('transaction.transfer.index') }}" class="menu-link">
                            <span class="menu-text">Transfer History</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('transaction.transfer.create') }}" class="menu-link">
                            <span class="menu-text">Transfer funds</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a
                    href="javascript:void(0)"
                    data-fc-type="collapse"
                    class="menu-link"
                >
                <span class="menu-icon"
                ><i class="mgc_copper_coin_line"></i
                    ></span>
                    <span class="menu-text"> Buy Aruba </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('transaction.buy-awg.index') }}" class="menu-link">
                            <span class="menu-text">Orders</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('transaction.buy-awg.create') }}" class="menu-link">
                            <span class="menu-text">Create Buy Order</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a
                    href="javascript:void(0)"
                    data-fc-type="collapse"
                    class="menu-link"
                >
                <span class="menu-icon"
                ><i class="mgc_counter_line"></i
                    ></span>
                    <span class="menu-text"> Convert </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('transaction.convert.index') }}" class="menu-link">
                            <span class="menu-text">Transactions</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('transaction.convert', ['from' => \App\Enums\Currency::AWG->value, 'to' => \App\Enums\Currency::USD->value]) }}" class="menu-link">
                            <span class="menu-text">AWG to USD</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('transaction.convert', ['from' => \App\Enums\Currency::USD->value, 'to' => \App\Enums\Currency::NGN->value]) }}" class="menu-link">
                            <span class="menu-text">USD to NGN</span>
                        </a>
                    </li>
                </ul>
            </li>

            @if(auth()->user()->hasRole('merchant'))
            <li class="menu-item">
                <a
                    href="javascript:void(0)"
                    data-fc-type="collapse"
                    class="menu-link"
                >
                <span class="menu-icon"
                ><i class="mgc_user_1_line"></i
                    ></span>
                    <span class="menu-text"> Merchant </span>
                    <span class="menu-arrow"></span>
                </a>

                <ul class="sub-menu hidden">
                    <li class="menu-item">
                        <a href="{{ route('dashboard.merchant') }}" class="menu-link">
                            <span class="menu-text">Account Details</span>
                        </a>
                    </li>
                    <li class="menu-item">
                        <a href="{{ route('dashboard.merchant.orders') }}" class="menu-link">
                            <span class="menu-text">Order List</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endif
        </ul>

        <!-- Help Box Widget -->
{{--        <div class="my-10 mx-5">--}}
{{--            <div class="help-box p-6 bg-black/5 text-center rounded-md">--}}
{{--                <div class="flex justify-center mb-4">--}}
{{--                    <svg width="30" height="18" aria-hidden="true">--}}
{{--                        <path--}}
{{--                            fill-rule="evenodd"--}}
{{--                            clip-rule="evenodd"--}}
{{--                            d="M15 0c-4 0-6.5 2-7.5 6 1.5-2 3.25-2.75 5.25-2.25 1.141.285 1.957 1.113 2.86 2.03C17.08 7.271 18.782 9 22.5 9c4 0 6.5-2 7.5-6-1.5 2-3.25 2.75-5.25 2.25-1.141-.285-1.957-1.113-2.86-2.03C20.42 1.728 18.718 0 15 0ZM7.5 9C3.5 9 1 11 0 15c1.5-2 3.25-2.75 5.25-2.25 1.141.285 1.957 1.113 2.86 2.03C9.58 16.271 11.282 18 15 18c4 0 6.5-2 7.5-6-1.5 2-3.25 2.75-5.25 2.25-1.141-.285-1.957-1.113-2.86-2.03C12.92 10.729 11.218 9 7.5 9Z"--}}
{{--                            fill="#38BDF8"--}}
{{--                        ></path>--}}
{{--                    </svg>--}}
{{--                </div>--}}
{{--                <h5 class="mb-2">Unlimited Access</h5>--}}
{{--                <p class="mb-3">--}}
{{--                    Upgrade to plan to get access to unlimited reports--}}
{{--                </p>--}}
{{--                <a--}}
{{--                    href="javascript: void(0);"--}}
{{--                    class="btn btn-sm bg-secondary text-white"--}}
{{--                >Upgrade</a--}}
{{--                >--}}
{{--            </div>--}}
{{--        </div>--}}
    </div>
</div>
<!-- Sidenav Menu End  -->
