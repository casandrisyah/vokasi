<x-web-layout title="Staf - {{ $staf->name ?? '' }}">
    <!-- Content ============================================= -->
    <section id="content">
        <div class="content-wrap" style="padding-top: 0 !important;">
            <div class="container-fluid px-md-5" style="background: #e9e7e7">
                <div class="row d-flex align-items-center">
                    <div class="col-lg-3 col-md-4">
                        <img class="my-5" src="{{ $staf->avatar ? Storage::url($staf->avatar) : asset('web/images/no-img-profile.jpg') }}" alt="{{ $staf->name }}"
                            style="width: 100%; height: 350px; object-fit: cover; object-position: top center; border-radius: 20px">
                    </div>
                    <div class="col-lg-9 col-md-8 ps-4">
                        <h2 class="d-inline fw-semibold">{{ $staf->name ?? '' }}</h2>
                        <p class="fs-5 fw-semibold">{{ $staf->position ?? '-' }}</p>
                        <div class="fw-bold d-flex justify-content-end">
                            <div>
                                <span class="d-block text-end">
                                    <a href="mailto:{{ $staf->email }}" class="text-dark me-2">{{ $staf->email }}</a>
                                    <i class="bi bi-envelope-at-fill me-2"></i>
                                </span>
                                @if ($staf->phone)
                                <span class="d-block text-end">
                                    <span class="text-dark me-2">{{ $staf->phone }}</span>
                                    <i class="bi bi-telephone-fill me-2"></i>
                                </span>
                                @else
                                <span class="d-block text-end">
                                    <a href="#" class="text-dark me-2">-</a>
                                    <i class="bi bi-telephone-fill me-2"></i>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid px-0" style="padding-left: -20px !important">
                <ul class="nav nav-tabs flex-nowrap text-nowrap justify-content-around border-0 mt-0" style="background: rgb(124, 190, 224)">
                    <li class="nav-item">
                        <a class="nav-link active px-5 py-3 text-dark fw-semibold" data-bs-toggle="tab" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-5 py-3 text-dark fw-semibold" data-bs-toggle="tab" href="#latar">Latar Belakang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-5 py-3 text-dark fw-semibold" data-bs-toggle="tab" href="#identitas">Identitas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-5 py-3 text-dark fw-semibold" data-bs-toggle="tab" href="#kegiatan">Kegiatan</a>
                    </li>
                </ul>
                <div class="tab-container">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tentang" role="tabpanel">
                            <div class="container">
                                <div class="row mt-5">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-0">Tentang</h4>
                                                <hr>
                                                <p class="text-justify my-0">{!! $staf->bio ?? 'Belum Tersedia' !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card ">
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
                                <div class="row mt-5">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-0">Kata Kunci</h4>
                                                <hr>
                                                <p class="text-justify my-0">{!! $staf->background()->first() != null ? $staf->background()->first()->keyword : 'Belum Tersedia' !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card ">
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
                            <div class="container">
                                <div class="row mt-5">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-0">Data Diri</h4>
                                                <hr>
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <td>Nama</td>
                                                        <td>:</td>
                                                        <td>{{ $staf->name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>ID Karyawan</td>
                                                        <td>:</td>
                                                        <td>{{ $staf->employee_id ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tempat Lahir</td>
                                                        <td>:</td>
                                                        <td>{{ $staf->place_birth ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tanggal Lahir</td>
                                                        <td>:</td>
                                                        <td>{{ date('d M Y', strtotime($staf->date_birth)) ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Keahlian</td>
                                                        <td>:</td>
                                                        <td>{!! $staf->skill ?? '-' !!}</td>
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
                                        <div class="card ">
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
                        <div class="tab-pane fade" id="kegiatan" role="tabpanel">
                            <div class="container">
                                <div class="row mt-5">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-body">
                                                <h4 class="mb-0">Pengalaman</h4>
                                                <hr>
                                                @if ($experience->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <table class="table p-3">
                                                    <thead>
                                                        <tr>
                                                            <th>Tahun</th>
                                                            <th>Mata Kuilah</th>
                                                            <th>Program Studi</th>
                                                        </tr>
                                                        @foreach ($experience as $e)
                                                        <tr>
                                                            <td>{{ $e->year }}</td>
                                                            <td>{{ $e->subject }}</td>
                                                            <td>{{ $e->prodi }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </thead>
                                                </table>
                                                @endif

                                                <h4 class="mt-5 mb-0">Kegiatan Asisten Dosen Sekarang</h4>
                                                <hr>
                                                @if ($activity->count() == 0)
                                                    <p>Belum Tersedia</p>
                                                @else
                                                <table class="table p-3">
                                                    <thead>
                                                        <tr>
                                                            <th>Tahun</th>
                                                            <th>Mata Kuilah</th>
                                                            <th>Program Studi</th>
                                                        </tr>
                                                        @foreach ($activity as $e)
                                                        <tr>
                                                            <td>{{ $e->year }}</td>
                                                            <td>{{ $e->subject }}</td>
                                                            <td>{{ $e->prodi }}</td>
                                                        </tr>
                                                        @endforeach
                                                    </thead>
                                                </table>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="card ">
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

    <script>
        var expText = document.getElementById('exp-text');
        var childNodes = expText.childNodes;

        for (var i = 0; i < childNodes.length; i++) {
            var node = childNodes[i];
            if (node.nodeType === Node.TEXT_NODE && node.nodeValue.trim() !== '') {
                var p = document.createElement('p');
                p.textContent = node.nodeValue;
                expText.replaceChild(p, node);
                console.log(p);
            }
        }

    </script>

</x-web-layout>
