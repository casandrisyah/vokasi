<x-web-layout title="Aktivitas {{ $category }}">
    <style>
        .max-line-2 {
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            line-height: 1.2em;
            font-size: 16px !important;
            -webkit-line-clamp: 2;
                    line-clamp: 2;
            -webkit-box-orient: vertical;
        }
    </style>
    <section id="content">
        <div class="content-wrap bg-light">
            <center>
                <div>
                    <h1 style="color: #031E53; text-transform: uppercase"><b>{{ $category }}</b></h1>
                    @php
                        $text = '';
                        if ($category == 'himatek') {
                            $text = 'Himpunan Mahasiswa Teknologi Komputer';
                        } elseif ($category == 'himatif') {
                            $text = 'Himpunan Mahasiswa Teknik Informasi';
                        } elseif ($category == 'himatera') {
                            $text = 'Himpunan Mahasiswa Rekayasa Perangkat Lunak';
                        }
                    @endphp
                    <h3 style="margin-top: -30px; color: #053084; text-transform: uppercase">{{ $text }}</h3>
                </div>
            </center>
            <div class="container">
                <div class="row">
                    <div class="col-md-3 ms-auto">
                        <div class="float-right">
                            <form action="/aktivitas/{{ $category }}" method="get" id="filter">
                                <div class="form-group" style="margin-top: -30px">
                                    <select class="form-select required" name="jenis_aktivitas" id="jenis_aktivitas">
                                        <option disabled selected>Urutkan Berdasarkan</option>
                                        <option value="tanggal_terbaru">Tanggal Terbaru</option>
                                        <option value="tanggal_terdahulu">Tanggal Terdahulu</option>
                                        {{-- <option value="event_virtual">Event Virtual</option>
                                        <option value="event_offline">Event Offline</option>
                                        <option value="all">Tampilkan Semua</option> --}}
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row col-mb-120">
                    <main class="postcontent col-lg-12">

                        <div class="row g-4 mb-5">

                            @if ($activities->count())
                                @foreach ($activities as $item)
                                <article class="entry event col-md-6 col-lg-4">
                                    <div style="width: 100%; height: 460px; overflow: hidden; border-radius: 20px" class="grid-inner bg-white row g-0 p-3 border-0 rounded-5 shadow-sm h-shadow all-ts h-translate-y-sm">
                                        <div class="col-12 mb-0 pb-0">
                                            <a href="{{ Storage::url($item->thumbnail) }}" class="entry-image" data-lightbox="image">
                                                <img src="{{ Storage::url($item->thumbnail) }}" alt="Inventore voluptates velit totam ipsa tenetur" class="rounded-2" style="height: 250px; object-fit: cover; object-position: center">
                                                <div class="bg-overlay">
                                                    <div class="bg-overlay-content justify-content-start align-items-start">
                                                        <div class="badge bg-light text-dark rounded-pill">
                                                            {{ $item->type }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-12 pb-4 px-2">
                                            <div class="entry-meta no-separator mb-0 p-0 mt-0">
                                                <ul style="margin: 0; padding: 0">
                                                    <li><a class="text-uppercase fw-medium">{{ $item->date->format(' d F Y') }}</a></li>
                                                </ul>
                                            </div>

                                            <div class="entry-title nott">
                                                <a href="javascript:;" id="myBtn" data-bs-toggle="modal" data-bs-target="#exampleModal-{{ $item->id }}">
                                                    <h4 class="max-line-2">{!! \Illuminate\Support\Str::limit($item->title, 50, '...') !!}</h4>
                                                </a>

                                                <div class="entry-meta no-separator">
                                                    <ul style="margin: 0; padding: 0">
                                                        <li class="fw-normal text-nowrap">
                                                            <i class="uil uil-map-marker"></i>
                                                            {{ $item->location }}
                                                        </li>
                                                    </ul>
                                                </div>
                                                    @if ($item->url != null)
                                                    <div style="margin-bottom: -20px">
                                                        <a href="{{ $item->url ?? '#' }}" target="_blank">
                                                            <b> Daftar </b><i class="bi-box-arrow-right"></i>
                                                        </a>
                                                    </div>
                                                    @endif
                                            </div>
                                        </div>
                                </article>
                                <!-- Modal -->
                                <div class="modal modal-lg fade" id="exampleModal-{{ $item->id }}" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">{{ $item->title }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body pb-4">
                                                {!! $item->description ?? 'Deskripsi belum ditambahkan.' !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @else
                                <div class="col-md-6 mx-auto mt-5">
                                    <div class="alert alert-primary text-center" role="alert">
                                        <i class="bi-exclamation-circle fs-5 me-2"></i> Tidak ada aktivitas atau event yang tersedia.
                                    </div>
                                </div>
                            @endif

                        </div>
                        <!-- Pager ============================================= -->
                        {{ $activities->links('themes.web.pagination') }}
                        <!-- .pager end -->

                    </main>

                </div>

                <div class="mt-5">
                    <h3>Memiliki Aktivitas atau event himpunan yang lain?</h3>
                    <p style="margin-top: -30px">Bagikan acara Anda dengan himpunan dengan menggunakan formulir
                        pengiriman acara sederhana ini.</p>
                    <a href="{{ route('office.auth.index') }}" class="button button-border button-rounded text-end" style="margin-top: -30px">Kirim Aktivitas<i class="bi-arrow-right-circle-fill"></i></a>
                </div>

            </div>
        </div>
    </section><!-- #content end -->

    <script>
        document.getElementById('jenis_aktivitas').addEventListener('change', function() {
            document.getElementById('filter').submit();
        });
    </script>
</x-web-layout>
