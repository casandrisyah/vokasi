@php
    $logo = \App\Models\Setting\Logo::where('is_active', 1)->first();
    $logo_thumbnail = null;
    if ($logo) {
        $logo_thumbnail = $logo->thumbnail ? Storage::url($logo->thumbnail) : null;
    }
@endphp

<header id="header" data-sticky-shrink="false">
    <div id="header-wrap" class="shadow">
        <div class="header-row">

            <!-- Logo
            ============================================= -->
            <div id="logo">
                <div style="height: 50px !important" class="ms-4">
                    <a href="{{route('web.home')}}">
                        <img class="logo-default" style="height: 50px !important" srcset="{{ $logo_thumbnail ?? asset('web/images/logodel.png') }}, {{ $logo_thumbnail ?? asset('web/images/logodel.png') }}" src="{{ $logo_thumbnail ?? asset('web/images/logodel.png') }}" alt="Canvas Logo">
                        <img class="logo-dark" style="height: 50px !important" srcset="{{ $logo_thumbnail ?? asset('web/images/logodel.png') }}, {{ $logo_thumbnail ?? asset('web/images/logodel.png') }}" src="{{ $logo_thumbnail ?? asset('web/images/logodel.png') }}" alt="Canvas Logo">
                    </a>
                </div>
                <a href="{{ route('web.home') }}" class="text-nowrap ms-3 my-4" style="margin-right:-90px;">
                    <div class="text-uppercase" style="color: #13005a; font-size: 15px; font-weight: 600">{{ $logo->faculty ?? 'FAKULTAS VOKASI' }}</div>
                    <div class="text-uppercase" style="font-size: 15px; font-weight: semi-bold;">{{ $logo->university ?? 'Institut Teknologi Del' }}</div>
                </a>
            </div><!-- #logo end -->

            <div class="header-misc">
                @guest
                <a href="{{ route('web.auth.index') }}" class="button button-small button-rounded button-blue" style="margin-right: 40px !important">Login</a>
                @else
                {{-- <form action="{{ route('web.auth.logout') }}" method="post" class="d-inline m-0 p-0">
                    @csrf
                    <a href="#" onclick="this.closest('form').submit()" class="button button-small button-border button-rounded button-red" style="margin-right: 40px !important">
                        Logout
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </form> --}}
                @endguest
                <!-- Top Search
                ============================================= -->
                <div id="top-search" class="d-none header-misc-icon">
                    <a href="#" id="top-search-trigger"><i class="uil uil-search"></i><i class="bi-x-lg"></i></a>
                </div><!-- #top-search end -->

                <!-- Top Cart
                ============================================= -->
                <div id="top-cart" class="header-misc-icon d-none">
                    <a href="#" id="top-cart-trigger"><i class="uil uil-shopping-bag"></i><span class="top-cart-number">5</span></a>
                    <div class="top-cart-content">
                        <div class="top-cart-title">
                            <h4>Shopping Cart</h4>
                        </div>
                        <div class="top-cart-items">
                            <div class="top-cart-item">
                                <div class="top-cart-item-image">
                                    <a href="#"><img src="#" alt="Blue Round-Neck Tshirt"></a>
                                </div>
                                <div class="top-cart-item-desc">
                                    <div class="top-cart-item-desc-title">
                                        <a href="#">Blue Round-Neck Tshirt with a Button</a>
                                        <span class="top-cart-item-price d-block">$19.99</span>
                                    </div>
                                    <div class="top-cart-item-quantity">x 2</div>
                                </div>
                            </div>
                            <div class="top-cart-item">
                                <div class="top-cart-item-image">
                                    <a href="#"><img src="#" alt="Light Blue Denim Dress"></a>
                                </div>
                                <div class="top-cart-item-desc">
                                    <div class="top-cart-item-desc-title">
                                        <a href="#">Light Blue Denim Dress</a>
                                        <span class="top-cart-item-price d-block">$24.99</span>
                                    </div>
                                    <div class="top-cart-item-quantity">x 3</div>
                                </div>
                            </div>
                        </div>
                        <div class="top-cart-action">
                            <span class="top-checkout-price">$114.95</span>
                            <a href="#" class="button button-3d button-small m-0">View Cart</a>
                        </div>
                    </div>
                </div><!-- #top-cart end -->

            </div>

            <div class="primary-menu-trigger">
                <button class="cnvs-hamburger" type="button" title="Open Mobile Menu">
                    <span class="cnvs-hamburger-box"><span class="cnvs-hamburger-inner"></span></span>
                </button>
            </div>

            <!-- Primary Navigation
            ============================================= -->
            <nav class="primary-menu me-lg-auto">

                <ul class="menu-container">
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('web.home') }}"><div>Beranda</div></a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('web.tentang') }}"><div>Tentang</div></a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="javascript:;"><div>Program Studi <i class="bi-chevron-down"></i></div></a>
                        <ul class="sub-menu-container">
                            @foreach (\App\Models\CategoryProdi::all() as $category)
                            <li class="menu-item">
                                <a class="menu-link" href="{{ route('web.program', $category->slug) }}"><div>{{ $category->name }}</div></a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="javascript:;"><div>Civitas <i class="bi-chevron-down"></i></div></a>
                        <ul class="sub-menu-container">
                            <li class="menu-item">
                                <a class="menu-link" href="{{ route('web.civitas.dosen') }}"><div>Dosen</div></a>
                            </li>
                            <li class="menu-item">
                                <a class="menu-link" href="{{ route('web.civitas.staf') }}"><div>Staff</div></a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="{{ route('web.berita') }}"><div>Berita</div></a>
                    </li>
                    <li class="menu-item">
                        <a class="menu-link" href="javascript:;"><div>Aktivitas Mahasiswa <i class="bi-chevron-down"></i></div></a>
                        <ul class="sub-menu-container">
                            @foreach (\App\Models\Account\UserCategory::where('role', 6)->where('is_active', true)->get() as $himpunan)
                            <li class="menu-item">
                                <a class="menu-link" href="{{ route('web.activity', $himpunan->slug) }}"><div>{{ $himpunan->name }}</div></a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @guest
                    {{-- <a class="menu-link" href="{{ route('web.auth.index') }}"><div>Login</div></a> --}}
                    @else
                    <li class="menu-item">
                        <a class="menu-link" href="javascript:;"><div><i class="bi bi-person-circle fs-4"></i> <i class="bi-chevron-down"></i></div></a>
                        <ul class="sub-menu-container">
                            {{-- <form action="{{ route('web.auth.logout') }}" method="post" class="d-inline m-0 p-0">
                                @csrf --}}
                                <li class="menu-item">
                                    <a class="menu-link" href="{{ route('office.dashboard.index') }}">
                                        <div><i class="fa-solid fa-table-columns"></i>{{ auth()->user()->name }}</div>
                                    </a>
                                </li>
                                <hr class="p-0 m-0">
                                <li class="menu-item">
                                    {{-- <a class="menu-link" href="javascript:;" onclick="this.closest('form').submit()"> --}}
                                    <a class="menu-link" href="{{ route('web.auth.logout') }}">
                                        <div><i class="fa-solid fa-right-from-bracket fa-rotate-180"></i>Keluar</div>
                                    </a>
                                </li>
                            {{-- </form> --}}
                        </ul>
                    </li>
                    @endguest
                    {{-- <li class="menu-item">
                        <a href="#" class="button button-3d button-rounded button-blue">Login</a>
                    </li> --}}
                </ul>

            </nav><!-- #primary-menu end -->

            <form class="top-search-form" action="search.html" method="get">
                <input type="text" name="q" class="form-control" value="" placeholder="Type &amp; Hit Enter.." autocomplete="off">
            </form>

        </div>
    </div>
    <div class="header-wrap-clone"></div>
</header>
