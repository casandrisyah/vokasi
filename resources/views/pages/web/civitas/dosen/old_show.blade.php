<style>
    .list-none {
        list-style: none;
        padding-left: 10px;
    }
</style>
<x-web-layout title="Dosen - {{ $dosen->name ?? '' }}">
    <!-- Content ============================================= -->
    <section id="content">
        <div class="content-wrap" style="padding-top: 0 !important;">
            <div class="container-fluid px-md-5" style="background: #e9e7e7">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-3 col-md-4">
                        <img class="my-5" src="{{ $dosen->avatar ? Storage::url($dosen->avatar) : asset('web/images/no-img-profile.jpg') }}" alt="{{ $dosen->name }}"
                            style="width: 100%; height: 350px; object-fit: cover; object-position: top center; border-radius: 20px">
                    </div>
                    <div class="col-lg-9 col-md-8 ps-4">
                        <h2 class="d-inline fw-semibold">{{ $dosen->name ?? '' }}</h2>
                        <p class="fs-5 fw-semibold">{{ $dosen->position ?? '' }}</p>
                        <div class="fw-bold d-flex justify-content-end">
                            <div>
                                <span class="d-block text-end">
                                    <a href="mailto:{{ $dosen->email }}" class="text-dark">{{ $dosen->email }}</a>
                                    <i class="bi bi-envelope-at-fill me-2"></i>
                                </span>
                                @if ($dosen->phone)
                                <span class="d-block text-end">
                                    <span class="text-dark">{{ $dosen->phone }}</span>
                                    <i class="bi bi-telephone-fill me-2"></i>
                                </span>
                                @endif
                                @if ($dosen->url)
                                <span class="d-block text-end">
                                    <a href="{{ $dosen->url }}" target="_blank" class="text-dark">{{ $dosen->url }}</a>
                                    <i class="bi bi-link-45deg me-2"></i>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid px-0" style="padding-left: -20px !important;">
                <div class="overflow-x-auto" style="background: rgb(124, 190, 224)">
                    <ul class="nav nav-tabs flex-nowrap text-nowrap justify-content-around border-0 mt-0">
                        <li class="nav-item">
                            <a class="nav-link active px-5 py-3 text-dark fw-semibold" data-bs-toggle="tab" href="#tentang">Tentang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-5 py-3 text-dark fw-semibold" data-bs-toggle="tab" href="#penelitian">Penelitian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-5 py-3 text-dark fw-semibold" data-bs-toggle="tab" href="#pendanaan">Pendanaan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-5 py-3 text-dark fw-semibold" data-bs-toggle="tab" href="#latar">Latar Belakang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link px-5 py-3 text-dark fw-semibold" data-bs-toggle="tab" href="#identitas">Identitas</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-container">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tentang" role="tabpanel">
                            <div class="container">
                                <div class="row mt-5 g-3">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-0">Tentang</h4>
                                                <hr>
                                                <p class="text-justify my-0">{!! $dosen->bio ?? 'Belum Tersedia' !!}</p>

                                                <h4 class="mt-5 mb-0">Gugus Bidang Kajian</h4>
                                                <hr>
                                                @if ($studies->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <ul class="list-none">
                                                    @foreach ($studies as $s)
                                                    <li>{{ $s->code . ' - ' . $s->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif

                                                <h4 class="mt-5 mb-0">Publikasi Teratas</h4>
                                                <hr>
                                                @if ($publication->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <table class="table p-3">
                                                    <thead>
                                                        <tr>
                                                            <th>Tahun</th>
                                                            <th>Judul</th>
                                                        </tr>
                                                        @foreach ($publication as $p)
                                                        <tr>
                                                            <td>{{ $p->year }}</td>
                                                            <td>{{ $p->title }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </thead>
                                                </table>
                                                @endif

                                                <h4 class="mt-5 mb-0">Ikhtisar Penelitian</h4>
                                                <hr>
                                                <span class="d-block">{!! $dosen->ikhtisar ?? 'Belum Tersedia' !!}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header" style="background: rgb(29, 163, 220)">
                                                <h4 class="mb-0 text-white">Gugus Bidang Kajian</h4>
                                            </div>
                                            <div class="card-body">
                                                @if ($studies->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <ul class="list-none">
                                                    @foreach ($studies as $s)
                                                    <li>{{ $s->code . ' - ' . $s->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card mt-5">
                                            <div class="card-body">
                                            @if ($contact)
                                                @if ($contact->facebook_url != null)
                                                <a href="{{ $contact->facebook_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-facebook fs-4 me-2"></i>
                                                    <span>Facebook</span>
                                                </a>
                                                @endif
                                                @if ($contact->instagram_url != null)
                                                <a href="{{ $contact->instagram_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-instagram fs-4 me-2"></i>
                                                    <span>Instagram</span>
                                                </a>
                                                @endif
                                                @if ($contact->linkedin_url != null)
                                                <a href="{{ $contact->linkedin_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-linkedin fs-4 me-2"></i>
                                                    <span>Linkedin</span>
                                                </a>
                                                @endif
                                            @else
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-facebook fs-4 me-2"></i>
                                                <span>Facebook <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-instagram fs-4 me-2"></i>
                                                <span>Instagram <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-linkedin fs-4 me-2"></i>
                                                <span>Linkedin <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="penelitian" role="tabpanel">
                            <div class="container">
                                <div class="row mt-5 g-3">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-0">Artikel Jurnal</h4>
                                                <hr>
                                                @if ($article->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <table class="table table-borderless">
                                                    @foreach ($article as $a)
                                                    <tr>
                                                        <th>Tahun</th>
                                                        <th>Judul</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $a->year }}</td>
                                                        <td>
                                                            {{ $a->title }}
                                                            <hr>
                                                            <strong>Diterbitkan di </strong>{{ $a->published }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                                @endif

                                                <h4 class="mt-5 mb-0">Buku</h4>
                                                <hr>
                                                @if ($books->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <table class="table table-borderless">
                                                    @foreach ($books as $b)
                                                    <tr>
                                                        <th>Tahun</th>
                                                        <th>Judul</th>
                                                    </tr>
                                                    <tr>
                                                        <td>{{ $b->year }}</td>
                                                        <td>
                                                            {{ $b->title }}
                                                            <hr>
                                                            <strong>Penerbit </strong>{{ $b->published }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header" style="background: rgb(29, 163, 220)">
                                                <h4 class="mb-0 text-white">Gugus Bidang Kajian</h4>
                                            </div>
                                            <div class="card-body">
                                                @if ($studies->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <ul class="list-none">
                                                    @foreach ($studies as $s)
                                                    <li>{{ $s->code . ' - ' . $s->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card mt-5">
                                            <div class="card-body">
                                            @if ($contact)
                                                @if ($contact->facebook_url != null)
                                                <a href="{{ $contact->facebook_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-facebook fs-4 me-2"></i>
                                                    <span>Facebook</span>
                                                </a>
                                                @endif
                                                @if ($contact->instagram_url != null)
                                                <a href="{{ $contact->instagram_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-instagram fs-4 me-2"></i>
                                                    <span>Instagram</span>
                                                </a>
                                                @endif
                                                @if ($contact->linkedin_url != null)
                                                <a href="{{ $contact->linkedin_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-linkedin fs-4 me-2"></i>
                                                    <span>Linkedin</span>
                                                </a>
                                                @endif
                                            @else
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-facebook fs-4 me-2"></i>
                                                <span>Facebook <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-instagram fs-4 me-2"></i>
                                                <span>Instagram <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-linkedin fs-4 me-2"></i>
                                                <span>Linkedin <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane tab-p fade" id="pendanaan" role="tabpanel">
                            <div class="container">
                                <div class="row mt-5 g-3">
                                    <div class="col-md-8">
                                        <h4 class="mb-0">Pendanaan</h4>
                                        <hr>
                                        @if ($funding->count() == 0)
                                            <p>Belum Tersedia</p>
                                        @else
                                        @foreach ($funding as $f)
                                        <div class="card shadow-sm mb-4 border-1" style="border-radius: 15px">
                                            <div class="card-body">
                                                <div style="font-size: 12px">{{ $f->type }}</div>
                                                <div class="card-title fw-semibold mb-1">{{ $f->project_name }}</div>
                                                <div class="card-text" style="font-size: 14px">{{ $f->organizer }}</div>
                                                <div class="card-text" style="font-size: 14px">
                                                   {{ App\Helpers\FedHelper::formatWorkingTime($f->working_time) }}
                                                </div>
                                                <div class="card-text" style="font-size: 14px">
                                                    <i class="bi bi-people-fill"></i>
                                                    {{ $f->involved_parties }}
                                                </div>
                                                <div class="card-text" style="font-size: 14px">{{ $f->working_area }}</div>
                                            </div>
                                        </div>
                                        @endforeach
                                        @endif
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header" style="background: rgb(29, 163, 220)">
                                                <h4 class="mb-0 text-white">Gugus Bidang Kajian</h4>
                                            </div>
                                            <div class="card-body">
                                                @if ($studies->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <ul class="list-none">
                                                    @foreach ($studies as $s)
                                                    <li>{{ $s->code . ' - ' . $s->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card mt-5">
                                            <div class="card-body">
                                            @if ($contact)
                                                @if ($contact->facebook_url != null)
                                                <a href="{{ $contact->facebook_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-facebook fs-4 me-2"></i>
                                                    <span>Facebook</span>
                                                </a>
                                                @endif
                                                @if ($contact->instagram_url != null)
                                                <a href="{{ $contact->instagram_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-instagram fs-4 me-2"></i>
                                                    <span>Instagram</span>
                                                </a>
                                                @endif
                                                @if ($contact->linkedin_url != null)
                                                <a href="{{ $contact->linkedin_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-linkedin fs-4 me-2"></i>
                                                    <span>Linkedin</span>
                                                </a>
                                                @endif
                                            @else
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-facebook fs-4 me-2"></i>
                                                <span>Facebook <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-instagram fs-4 me-2"></i>
                                                <span>Instagram <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-linkedin fs-4 me-2"></i>
                                                <span>Linkedin <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="latar" role="tabpanel">
                            <div class="container">
                                <div class="row mt-5 g-3">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-0">Kata Kunci</h4>
                                                <hr>
                                                <p class="text-justify my-0">{!! $dosen->background()->first() != null ? $dosen->background()->first()->keyword : 'Belum Tersedia' !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header" style="background: rgb(29, 163, 220)">
                                                <h4 class="mb-0 text-white">Gugus Bidang Kajian</h4>
                                            </div>
                                            <div class="card-body">
                                                @if ($studies->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <ul class="list-none">
                                                    @foreach ($studies as $s)
                                                    <li>{{ $s->code . ' - ' . $s->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card mt-5">
                                            <div class="card-body">
                                            @if ($contact)
                                                @if ($contact->facebook_url != null)
                                                <a href="{{ $contact->facebook_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-facebook fs-4 me-2"></i>
                                                    <span>Facebook</span>
                                                </a>
                                                @endif
                                                @if ($contact->instagram_url != null)
                                                <a href="{{ $contact->instagram_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-instagram fs-4 me-2"></i>
                                                    <span>Instagram</span>
                                                </a>
                                                @endif
                                                @if ($contact->linkedin_url != null)
                                                <a href="{{ $contact->linkedin_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-linkedin fs-4 me-2"></i>
                                                    <span>Linkedin</span>
                                                </a>
                                                @endif
                                            @else
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-facebook fs-4 me-2"></i>
                                                <span>Facebook <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-instagram fs-4 me-2"></i>
                                                <span>Instagram <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-linkedin fs-4 me-2"></i>
                                                <span>Linkedin <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="identitas" role="tabpanel">
                            <style>
                                ol {
                                    display: block;
                                    list-style-type: decimal;
                                    margin-top: 0;
                                    margin-bottom: 1em;
                                    margin-left: 0;
                                    margin-right: 0;
                                    padding-left: 20px;
                                }

                                ul {
                                    display: block;
                                    list-style-type: disc;
                                    margin-top: 0;
                                    margin-bottom: 1em;
                                    margin-left: 0;
                                    margin-right: 0;
                                    padding-left: 20px;
                                }

                                li {
                                    display: list-item;
                                    padding-block: 0.25em;
                                }
                            </style>
                            <div class="container">
                                <div class="row mt-5 g-3">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-0">Data Diri</h4>
                                                <hr>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td>{{ $dosen->name ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tempat Lahir</td>
                                                        <td>:</td>
                                                        <td>{{ $dosen->place_birth ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Lahir</td>
                                                        <td>:</td>
                                                        <td>{{ date('d M Y', strtotime($dosen->date_birth)) ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keahlian</td>
                                                        <td>:</td>
                                                        <td>{!! $dosen->skill ?? '-' !!}</td>
                                                    </tr>
                                                </table>

                                                <h4 class="mt-5 mb-0">Riwayat Pendidikan</h4>
                                                <hr>
                                                @if ($education->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <table class="table p-3">
                                                    <thead>
                                                        <tr>
                                                            <th>Tahun</th>
                                                            <th>Bidang Ilmu</th>
                                                            <th>Universitas</th>
                                                        </tr>
                                                        @foreach ($education as $e)
                                                        <tr>
                                                            <td>{{ $e->year }}</td>
                                                            <td>{{ $e->knowledge_field }}</td>
                                                            <td>{{ $e->university }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </thead>
                                                </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card">
                                            <div class="card-header" style="background: rgb(29, 163, 220)">
                                                <h4 class="mb-0 text-white">Gugus Bidang Kajian</h4>
                                            </div>
                                            <div class="card-body">
                                                @if ($studies->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <ul class="list-none">
                                                    @foreach ($studies as $s)
                                                    <li>{{ $s->code . ' - ' . $s->name }}</li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="card mt-5">
                                            <div class="card-body">
                                            @if ($contact)
                                                @if ($contact->facebook_url != null)
                                                <a href="{{ $contact->facebook_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-facebook fs-4 me-2"></i>
                                                    <span>Facebook</span>
                                                </a>
                                                @endif
                                                @if ($contact->instagram_url != null)
                                                <a href="{{ $contact->instagram_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-instagram fs-4 me-2"></i>
                                                    <span>Instagram</span>
                                                </a>
                                                @endif
                                                @if ($contact->linkedin_url != null)
                                                <a href="{{ $contact->linkedin_url }}" class="text-dark d-flex align-items-center">
                                                    <i class="bi bi-linkedin fs-4 me-2"></i>
                                                    <span>Linkedin</span>
                                                </a>
                                                @endif
                                            @else
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-facebook fs-4 me-2"></i>
                                                <span>Facebook <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-instagram fs-4 me-2"></i>
                                                <span>Instagram <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            <a href="#" class="text-dark d-flex align-items-center">
                                                <i class="bi bi-linkedin fs-4 me-2"></i>
                                                <span>Linkedin <span class="text-muted">(Belum tersedia)</span></span>
                                            </a>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container mt-5">
                <button class="button button-border button-rounded text-end" onclick="history.back()"><i class="bi-arrow-left-circle-fill me-2"></i> Kembali</button>
            </div>
        </div>
    </section><!-- #content end -->

</x-web-layout>
