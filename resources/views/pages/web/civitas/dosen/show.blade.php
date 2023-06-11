<x-web-layout title="Dosen - {{ $dosen->name ?? '' }}">
    @include('themes.web.styling.show_civitas_styling')
    <!-- Content ============================================= -->
    <section id="content" style="background: #ebe8e879" class="my-font">
        <div class="row align-items-center bg-white m-0">
            <div class="col-3">
                <a href="{{ route('web.civitas.dosen') }}" class="menu-link my-link text-dark text-small fw-light">
                    <i class="fa-solid fa-arrow-left me-3"></i>
                    kembali<span class="d-none d-lg-inline"> ke halaman dosen</span>
                </a>
            </div>
            <div class="col-9">
                <ul class="nav my-tabs flex-nowrap text-nowrap border-0 mt-0 ms-5 overflow-auto">
                    <li class="nav-item">
                        <a class="nav-link active px-5 py-3 text-dark text-uppercase" data-bs-toggle="tab" href="#tentang">Tentang</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-5 py-3 text-dark text-uppercase" data-bs-toggle="tab" href="#penelitian">Hasil Penelitian</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-5 py-3 text-dark text-uppercase" data-bs-toggle="tab" href="#pendanaan">Pendanaan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-5 py-3 text-dark text-uppercase" data-bs-toggle="tab" href="#pengajaran">Pengajaran dan Pembimbingan</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="content-wrap" style="padding-top: 25px !important;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card my-card border-0">
                            <div class="card-body py-4">
                                <div class="d-flex justify-content-center align-items-cemter mt-2">
                                    <img src="{{ $dosen->avatar ? Storage::url($dosen->avatar) : asset('web/images/no-img-profile.jpg') }}" class="my-image rounded rounded-circle">
                                </div>
                                <div class="text-center mt-3 border-bottom-dashed">
                                    <div class="text-muted fw-light text-uppercase" style="font-size: 12px">{{ $dosen->position ?? '' }}</div>
                                    <h4 class="text-center fw-500 mb-3">{{ $dosen->name ?? '-' }}</h2>
                                </div>
                                <div class="text-center text-muted mt-2 border-bottom-dashed pb-2">
                                    <div>NIDN : {{ $dosen->nidn ?? '-' }}</div>
                                    <div>SINTA ID : {{ $dosen->sinta_id ?? '-' }}</div>
                                </div>
                                <div class="text-start text-muted mt-2 border-bottom-dashed pb-3 pt-2 px-2">
                                    <i class="fa-solid fa-building-columns me-3"></i>  {{ $dosen->user_category->name ?? '-' }}
                                </div>
                                <div class="text-start text-muted mt-2 border-bottom-dashed pb-3 pt-2 px-2">
                                    <i class="fa-solid fa-phone me-3"></i>  {{ $dosen->phone ?? '-' }}
                                </div>
                                <div class="text-start text-muted mt-2 border-bottom-dashed pb-3 pt-2 px-2">
                                    <i class="fa-solid fa-envelope me-3"></i>  {{ $dosen->email ?? '-' }}
                                </div>
                                <div class="text-start text-muted mt-2 border-bottom-dashed pb-3 pt-2 px-2">
                                    <i class="fa-solid fa-link me-3"></i>  {{ $dosen->url ?? '-' }}
                                </div>
                            </div>
                            <a href="{{ route('office.auth.index') }}" class="are-you-is">
                                <div class="d-flex justify-content-center align-items-center">
                                    <i class="fa-solid fa-user-pen fs-4 me-2"></i>
                                    <div>
                                        <div class="fs-6">Apakah Anda {{ $dosen->name }} ?</div>
                                        <div class="fw-light mt-1">Edit Profilmu *</div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-9 mt-4 mt-lg-0">
                        <div class="tab-container">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane active" id="tentang" role="tabpanel">
                                    <div class="card my-card border-0">
                                        <div class="card-body px-4">
                                            <div class="card-title text-uppercase">Bio</div>
                                            <div class="text-muted fw-light">
                                                {!! $dosen->bio ?? 'Belum ada deskripsi apa pun yang ditambahkan' !!}
                                            </div>
                                        </div>
                                    </div>
                                    @if ($dosen->education->count() > 0)
                                    <div class="card my-card border-0 mt-4">
                                        <div class="card-body px-4">
                                            <div class="card-title text-uppercase">Riwayat Pendidikan</div>
                                            @foreach ($education as $item)
                                            <div class="fs-6">{{ $item->university }}</div>
                                            <div class="fw-light {{ $loop->last ? 'mb-2' : '' }}">{{ $item->year . ' - ' . $item->knowledge_field }}</div>
                                            @if (!$loop->last)
                                            <hr>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                    @if ($dosen->skill != null)
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
                                        }
                                    </style>
                                    <div class="card my-card border-0 mt-4">
                                        <div class="card-body px-4">
                                            <div class="card-title text-uppercase">Keahlian</div>
                                            <div class="text-muted">
                                               {!! $dosen->skill !!}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="tab-pane" id="penelitian" role="tabpanel">
                                    <div class="card my-card border-0">
                                        <div class="card-body px-4">
                                            <div class="card-title text-uppercase">Hasil Penelitian</div>
                                            @if ($research->count() > 0)
                                                @foreach ($research as $item)
                                                <div class="card rounded-6 my-shadow border-0 mt-3 {{ $loop->last ? 'mb-3' : '' }}">
                                                    <div class="card-body">
                                                        <div class="fw-semibold" style="font-size: 17px; text-transform: capitalize">{{ $item->title }}</div>
                                                        <div class="text-muted fw-light">Dipublikasikan di {{ $item->published . ', ' . date('d M Y', strtotime($item->date)) }}</div>
                                                        <a href="{{ $item->url ?? '#' }}" target="_blank" class="fw-light text-primary">{{ $item->url }}</a>
                                                        <div class="text-muted mt-1 fw-light">
                                                            {!! $item->desc ?? '' !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @else
                                            <span class="text-muted fw-light">Belum ada hasil penelitian yang ditambahkan</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pendanaan" role="tabpanel">
                                    <div class="card my-card border-0">
                                        <div class="card-body px-4">
                                            <div class="card-title text-uppercase">Pendanaan</div>
                                            @if ($funding->count() > 0)
                                                @foreach ($funding as $item)
                                                <div class="card rounded-6 my-shadow border-0 mt-3 {{ $loop->last ? 'mb-3' : '' }}">
                                                    <div class="card-body">
                                                        <span class="text-uppercase fw-light" style="font-size: 12px">{{ $item->type }}</span>
                                                        <div class="fw-semibold" style="font-size: 17px !important; text-transform: capitalize">{{ $item->project_name }}</div>
                                                        <div>{{ $item->organizer }}</div>
                                                        <div class="text-muted mt-1 fw-light">
                                                            {{ $item->working_area }},
                                                            {{ App\Helpers\FedHelper::formatWorkingTime($item->working_time) }}
                                                        </div>
                                                        <div class="text-muted fw-light">
                                                            <i class="bi bi-people-fill me-2"></i>
                                                            {{ $item->involved_parties }}
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @else
                                            <span class="text-muted fw-light">Belum ada Pendanaan yang ditambahkan</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane" id="pengajaran" role="tabpanel">
                                    <div class="card my-card border-0">
                                        <div class="card-body px-4">
                                            <div class="card-title text-uppercase">Pengajaran & Pembimbingan</div>
                                            <div class="d-flex justify-content-start mb-4">
                                                <span class="text-muted me-3">Urutkan Berdasarkan:</span>
                                                <select name="category" id="filter-category" class="text-muted">
                                                    <option value="semua">Tampilkan Semua</option>
                                                    <option value="Pengajaran">Pengajaran</option>
                                                    <option value="Pembimbingan">Pembimbingan</option>
                                                </select>
                                            </div>
                                            <input type="hidden" name="dosen_id" id="dosen_id" value="{{ $dosen->id }}">
                                            @if ($teaching_mentoring->count() > 0)
                                            <div id="card-teaching-mentoring">
                                                @foreach ($teaching_mentoring as $item)
                                                <div class="card rounded-6 my-shadow border-0 mt-3 {{ $loop->last ? 'mb-3' : '' }}">
                                                    <div class="card-body">
                                                        <span class="text-uppercase fw-light" style="font-size: 12px">{{ $item->category }}</span>
                                                        <div class="fw-semibold" style="font-size: 17px; text-transform: capitalize">{{ $item->title }}</div>
                                                        <div class="text-muted">{!! $item->student_name ? 'Mahasiswa: ' . $item->student_name : '' !!}</div>
                                                        <div class="text-muted mt-1 fw-light">{{ $item->year }}</div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                            @else
                                            <span class="text-muted fw-light">Belum ada pengajaran dan pembimbingan yang ditambahkan</span>
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
    </section><!-- #content end -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(`#filter-category`).change(function() {
            category = $(this).val();
            var dosen_id = $(`#dosen_id`).val();
            var card = $(`#card-teaching-mentoring`);
            card.empty();
            filterTeachingMentoring(category, dosen_id);
        });

        function filterTeachingMentoring(category, dosen_id) {
            $.ajax({
                url: "/teaching-mentoring-filter",
                method: `GET`,
                data: {
                    category: category,
                    dosen_id: dosen_id
                },
                dataType: `json`,
                success: function(response) {
                    if (response.status === `success`) {
                        $(`#card-teaching-mentoring .card`).remove();
                        response.data.forEach(function(item, index) {
                            var cardHtml = `<div class="card rounded-6 my-shadow border-0 mt-3 ` + (index === response.data.length - 1 ? `mb-3` : ``) + `">` +
                                `<div class="card-body">` +
                                `<span class="text-uppercase fw-light" style="font-size: 12px">` + item.category + `</span>` +
                                `<div class="fw-semibold" style="font-size: 17px; text-transform: capitalize">` + item.title + `</div>` +
                                `<div class="text-muted">` + (item.student_name ? `Mahasiswa: ` + item.student_name : ``) + `</div>` +
                                `<div class="text-muted mt-1 fw-light">` + item.year + `</div>` +
                                `</div>` +
                                `</div>`;

                            $(`#card-teaching-mentoring`).append(cardHtml);
                        });
                    } else {
                        var message = `<span class="text-muted fw-light">Belum ada pengajaran dan pembimbingan yang ditambahkan</span>`;
                        $(`#card-teaching-mentoring`).append(message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }
    </script>
</x-web-layout>
