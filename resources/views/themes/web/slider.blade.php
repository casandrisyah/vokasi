@php
    use App\Models\Appearance\Carousel as Carousel;

    $carousels = Carousel::where('is_active', 1)->orderBy('created_at', 'desc')->whereIn('url', ['home', 'program', 'tentang', 'berita', 'civitas', 'aktivitas'])->get();

    $home_carousel = $carousels->firstWhere('url', 'home');
    $program_carousel = $carousels->firstWhere('url', 'program');
    $tentang_carousel = $carousels->firstWhere('url', 'tentang');
    $berita_carousel = $carousels->firstWhere('url', 'berita');
    $civitas_carousel = $carousels->firstWhere('url', 'civitas');
    $aktivitas_carousel = $carousels->firstWhere('url', 'aktivitas');
@endphp
{{-- @dd($tentang_carousel) --}}
<style>
    .h2 {
        font-size: 58px !important;
        font-weight: 500;
        line-height: 1.2;
    }
    #parent-element {
        margin-top: 2rem !important;
        margin-bottom: 0.75rem !important;
        font-size: var(--cnvs-slider-caption-p-size) !important;
    }
</style>

<section id="slider" class="slider-element slider-parallax swiper_wrapper min-vh-60 min-vh-md-100">
    <div class="slider-inner">
        <div class="swiper-container swiper-parent">
            <div class="swiper-wrapper">
                <div class="swiper-slide dark">
                    <div class="container-fluid p-0" style="background: rgba(0, 0, 0, 0.1); width: 100%; height: 100%;">
                        <div class="slider-caption slider-caption-center">
                            @if (request()->is('program*'))
                            <h2 class="text-white fw-bold h2" data-animate="fadeInUp">{!! $program_carousel->title ?? '' !!}</h2>
                            <div class="text-white d-none d-sm-block" id="parent-element" data-animate="fadeInUp" data-delay="200">{!! $program_carousel->desc ?? '' !!}</div>
                            @elseif (request()->is('home'))
                            <h2 class="text-white fw-bold h2" data-animate="fadeInUp">{!! $home_carousel->title ?? '' !!}</h2>
                            <div class="text-white d-none d-sm-block" id="parent-element" data-animate="fadeInUp" data-delay="200">{!! $home_carousel->desc ?? '' !!}</div>
                            @elseif (request()->is('tentang-kami*'))
                            <h2 class="text-white fw-bold h2" data-animate="fadeInUp">{!! $tentang_carousel->title ?? '' !!}</h2>
                            <div class="text-white d-none d-sm-block" id="parent-element" data-animate="fadeInUp" data-delay="200">{!! $tentang_carousel->desc ?? '' !!}</div>
                            @elseif (request()->is('civitas*'))
                            <h2 class="text-white fw-bold h2" data-animate="fadeInUp">{!! $civitas_carousel->title ?? '' !!}</h2>
                            <div class="text-white d-none d-sm-block" id="parent-element" data-animate="fadeInUp" data-delay="200">{!! $civitas_carousel->desc ?? '' !!}</div>
                            @elseif (request()->is('berita*'))
                            <h2 class="text-white fw-bold h2" data-animate="fadeInUp">{!! $berita_carousel->title ?? '' !!}</h2>
                            <div class="text-white d-none d-sm-block" id="parent-element" data-animate="fadeInUp" data-delay="200">{!! $berita_carousel->desc ?? '' !!}</div>
                            @elseif (request()->is('aktivitas*'))
                            <h2 class="text-white fw-bold h2" data-animate="fadeInUp">{!! $aktivitas_carousel->title ?? '' !!}</h2>
                            <div class="text-white d-none d-sm-block" id="parent-element" data-animate="fadeInUp" data-delay="200">{!! $aktivitas_carousel->desc ?? '' !!}</div>
                            @else
                            <h2 data-animate="fadeInUp">Fakultas Vokasi</h2>
                            <p class="d-none d-sm-block" data-animate="fadeInUp" data-delay="200">Create just what you need for your Perfect Website. Choose from a wide range of Elements &amp; simply put them on our Canvas.</p>
                            @endif
                        </div>
                    </div>
                    @if (request()->is('home*'))
                        @if ($home_carousel !== null)
                        <div class="swiper-slide-bg" style="background-image: url('{{ Storage::url($home_carousel->thumbnail) }}');"></div>
                        @else
                        <div class="swiper-slide-bg" style="background-image: url('{{ asset('web/images/home-page.png') }}');"></div>
                        @endif
                    @elseif (request()->is('program*'))
                        @if ($program_carousel !== null)
                        <div class="swiper-slide-bg" style="background-image: url('{{ Storage::url($program_carousel->thumbnail) }}');"></div>
                        @else
                        <div class="swiper-slide-bg" style="background-image: url('{{ asset('web/images/tentang1.png') }}');"></div>
                        @endif
                    @elseif (request()->is('tentang-kami*'))
                        @if ($tentang_carousel !== null)
                        <div class="swiper-slide-bg" style="background-image: url('{{ Storage::url($tentang_carousel->thumbnail) }}');"></div>
                        @else
                        <div class="swiper-slide-bg" style="background-image: url('{{ asset('web/images/tentang1.png') }}');"></div>
                        @endif
                    @elseif (request()->is('civitas*'))
                        @if ($civitas_carousel !== null)
                        <div class="swiper-slide-bg" style="background-image: url('{{ Storage::url($civitas_carousel->thumbnail) }}');"></div>
                        @else
                        <div class="swiper-slide-bg" style="background-image: url('{{ asset('web/images/civitas-page.png') }}');"></div>
                        @endif
                    @elseif (request()->is('berita*'))
                        @if ($berita_carousel !== null)
                        <div class="swiper-slide-bg" style="background-image: url('{{ Storage::url($berita_carousel->thumbnail) }}');"></div>
                        @else
                        <div class="swiper-slide-bg" style="background-image: url('{{ asset('web/images/berita.png') }}');"></div>
                        @endif
                    @elseif (request()->is('aktivitas*'))
                        @if ($aktivitas_carousel !== null)
                        <div class="swiper-slide-bg" style="background-image: url('{{ Storage::url($aktivitas_carousel->thumbnail) }}');"></div>
                        @else
                        <div class="swiper-slide-bg" style="background-image: url('{{ asset('web/images/himatera2.jpeg') }}');"></div>
                        @endif
                    @else
                    <div class="swiper-slide-bg" style="background-image: url('{{ asset('web/images/tentang1.png') }}');"></div>
                    @endif
                </div>
            </div>
            <div class="slider-arrow-left"><i class="uil uil-angle-left-b"></i></div>
            <div class="slider-arrow-right"><i class="uil uil-angle-right-b"></i></div>
            <div class="slide-number"><div class="slide-number-current"></div><span>/</span><div class="slide-number-total"></div></div>
        </div>
    </div>
</section>

<script>
    var parentElement = document.getElementById('parent-element');

    var childElements = parentElement

    for (var i = 0; i < childElements.length; i++) {
    var element = childElements[i];
    element.classList.add('text-white', 'd-none', 'd-sm-block');
    element.setAttribute('data-animate', 'fadeInUp');
    element.setAttribute('data-delay', '200');
    }

</script>
