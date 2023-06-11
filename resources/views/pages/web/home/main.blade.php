<x-web-layout title="Home">
    @include('themes.web.styling.home_styling')
    <section id="content">
        <div class="content-wrap">
            <div class="container">
                <h2 class="fw-bold color-blue-1 mt-0 mx-4">{{ $breaking_news->title ?? 'Berita Terkini' }}</h2>
                @if ($news->count())
                <div class="owl-carousel">
                    @foreach ($news as $n)
                    <div class="card shadow bg-blue-1 text-white mx-3 mb-3">
                        <a href="{{ $n->thumbnail ? Storage::url($n->thumbnail) : asset('web/images/berita.png') }}" data-lightbox="image">
                            <img src="{{ $n->thumbnail ? Storage::url($n->thumbnail) : asset('web/images/berita.png') }}" class="card-img-top card-img-1">
                        </a>
                        <div class="card-body">
                            <a href="{{ route('web.berita.show', $n->slug) }}" class="menu-link">
                                <h4 class="card-title fw-semibold text-nowrap overflow-hidden text-white">{{ $n->title }}</h4>
                            </a>
                            <div class="card-text">{!! $n->desc !!}</div>
                            <a href="{{ route('web.berita.show', $n->slug) }}" class="menu-link d-block text-white fw-semibold mt-3">Selengkapnya</a>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="col-md-6 mx-auto mt-5">
                    <div class="alert alert-primary text-center" role="alert">
                        <i class="bi-exclamation-circle fs-5 me-2"></i> Tidak ada berita yang tersedia.
                    </div>
                </div>
                @endif
            </div>

            <div class="container-fluid bg-blue-1 py-5 px-5 mt-5">
                <div class="row d-flex align-items-center">
                    <div class="col-md-4">
                        <img src="{{ $civitas_section->thumbnail ? Storage::url($civitas_section->thumbnail) : asset('web/images/civitas.png') }}" alt="" class="rounded" style="height: 350px">
                    </div>
                    <div class="col-md-8 text-white mt-4 mt-md-0">
                        <h2 class="text-white fw-semibold">{{ $civitas_section->title ?? 'Civitas Fakultas Vokasi' }}</h2>
                        <p>{!! $civitas_section->desc ?? 'Deskripsi Belum Ditambahkan' !!}</p>
                        <a href="{{ $civitas_section->url ?? route('web.civitas.dosen') }}" class="menu-link button button-orange">Selengkapnya</a>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <h2 class="color-blue-1 fw-bold my-0">{{ $faculty_explore_section->title ?? 'Eksplor Fakultas' }}</h2>
                <p class="mt-0">{{ $faculty_explore_section->text_under_title ?? 'Mari kita eksplor terkait Fakultas Vokasi!' }}</p>
                <div class="row g-5 justify-content-center">
                    @if ($faculty_items !== null)
                        @foreach ($faculty_items as $fi)
                        @php
                            $url = $fi->url;
                            if ((strpos($url, "route('") !== false) || (strpos($url, 'route("') !== false)) {
                                eval("\$url = $url;");
                            }
                        @endphp
                        <div class="col-xl-3 col-lg-4 col-sm-6">
                            <a href="{{ $url }}" class="menu-link">
                                <div class="card shadow bg-blue-1 text-white">
                                    <img src="{{ $fi->thumbnail ? Storage::url($fi->thumbnail) : asset('web/images/blank-imagejpg.jpg') }}" class="card-img-2">
                                    <div class="card-body mx-3">
                                        <a href="{{ $url ?? '#' }}" class="menu-link d-block text-white fw-semibold">{{ $fi->title }}</a>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                    <div class="col-md-6 mx-auto mt-5">
                        <div class="alert alert-primary text-center" role="alert">
                            <i class="bi-exclamation-circle fs-5 me-2"></i> Tidak ada data yang tersedia.
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-7">
                        <h2 class="fw-bold color-blue-1 my-3">{{ $study_program_section->title ?? 'Temukan Program Studi Anda' }}</h2>
                        <div class="my-3">{!! $study_program_section->desc ?? 'Deskripsi Belum ditambahkan' !!}</div>
                        @php
                            $url = $study_program_section->url ?? route('web.civitas.dosen');
                        @endphp
                        <a href="{{$url}}" class="menu-link button button-orange">Selengkapnya</a>
                    </div>
                    <div class="col-md-5 p-5">
                        <div class="card-prodi bg-blue-1">
                            <img src="{{ $study_program_section->thumbnail ? Storage::url($study_program_section->thumbnail) : asset('web/images/prodi.png') }}" alt="" class="img-overlay">
                        </div>
                    </div>
                </div>
            </div>

            <div class="bottom-bg">
                <div class="bg-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <h2 class="fw-bold text-white text-shadow my-4">{{ $meet_our_student_section->title ?? 'Temui Mahasiswa Kami' }}</h2>
                                <div class="text-white text-shadow fw-5 mt-0">{!! $meet_our_student_section->desc ?? 'Ayo berkenalan bersama siswa kami dengan melihat kegiatan-kegiatan menarik lainnya yang nspiratif dan beragam yang dilakukan oleh para siswa kami.' !!}</d>
                                <a href="{{ $meet_our_student_section->url ?? route('web.activity', 'himatek') }}" class="menu-link button button-orange mt-4">Selengkapnya</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
