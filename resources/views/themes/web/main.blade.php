@php
$themes = \App\Models\Appearance\Theme::where('is_admin',false)->where('is_active',true)->first();
// dd($themes);
$logo = \App\Models\Setting\Config::where('key','APP_LOGO')->first();
// $layout = $themes->layout->where('type','office_layout')->where('is_active',true)->first();
@endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @include('themes.web.head')
    <body class="stretched">
        <div id="wrapper" class="cms_web">

            @if (!request()->is('auth'))
                <!-- Header ============================================= -->
                @include('themes.web.header')
                <!-- #header end -->
                @if (request()->is('civitas/dosen/*') || request()->is('civitas/staf/*'))
                @else
                    @include('themes.web.slider')
                @endif
            @endif

            <!-- Content ============================================= -->
            <div class="cms_app">
                {{$slot}}
            </div>
            <!-- #content end -->
            @if (!request()->is('auth'))
                <!-- Footer ============================================= -->
                @include('themes.web.footer')
                <!-- #footer end -->
            @endif
        </div>
        <div id="gotoTop" class="uil uil-angle-up"></div>

		@include('themes.web.js')
        @include('sweetalert::alert')
        @yield('custom_js')
    </body>
</html>
