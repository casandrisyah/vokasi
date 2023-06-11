<x-app-layout title="Dashboard">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{ route('office.dashboard.index') }}" class="menu-link text-gray-800 text-hover-primary">Home</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>

    <div id="kt_app_content" class="app-content flex-column-fluid">
        <!--begin::Content container-->
        <div id="kt_app_content_container" class="app-container container-fluid text-gray-800 transition-fade">
            <div class="row">
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow mb-3">
                        <div class="card-body pb-4">
                            <h4 class="card-title mb-7">
                                <i class="fa-solid fa-users text-gray-800 me-2 fs-4"></i>
                                <span>Data Akun</span>
                            </h4>
                            <div class="d-flex justify-content-between fw-bold">
                                <a href="{{ route('office.account.himpunan.index') }}" class="menu-link text-gray-800 text-hover-primary">Himpunan</a>
                                <p class="badge badge-primary">{{ $account['himpunan'] }}</p>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <a href="{{ route('office.civitas.dosen.index') }}" class="menu-link text-gray-800 text-hover-primary">Dosen</a>
                                <p class="badge badge-primary">{{ $civitas['dosen'] }}</p>
                            </div>
                            <div class="d-flex justify-content-between fw-bold">
                                <a href="{{ route('office.civitas.staff.index') }}" class="menu-link text-gray-800 text-hover-primary">Staff</a>
                                <p class="badge badge-primary">{{ $civitas['staff'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="card shadow mb-3">
                        <div class="card-body d-flex justify-content-between py-4">
                            <a href="{{ route('web.home') }}" class="text-gray-800 text-hover-primary">
                                <h5 class="card-title my-2">
                                    <i class="fa-solid fa-globe text-gray-800 me-2 fs-4"></i>
                                    <span>Lihat Halaman Web</span>
                                </h5>
                            </a>
                            <a href="{{ route('web.home') }}" class="text-hover-primary my-2" target="_blank"><i class="fa-solid fa-arrow-up-right-from-square text-gray-800 fs-5"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-body">
                                    <h4 class="card-title mb-7">
                                        <i class="fa-solid fa-circle-info text-gray-800 me-2 fs-4"></i>
                                        <span>Data Tentang</span>
                                    </h4>
                                    <div class="d-flex justify-content-between fw-bold">
                                        <a href="{{ route('office.about.history.index') }}" class="menu-link text-gray-800 text-hover-primary">Sejarah</a>
                                        <p class="badge badge-primary">{{ $about['history'] }}</p>
                                    </div>
                                    <div class="d-flex justify-content-between fw-bold">
                                        <a href="{{ route('office.about.organization.index') }}" class="menu-link text-gray-800 text-hover-primary">Struktur Organisasi</a>
                                        <p class="badge badge-primary">{{ $about['organization'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card shadow mb-3">
                                <div class="card-body d-flex justify-content-between pb-4">
                                    <a href="{{ route('office.program-studi.index') }}" class="menu-link text-gray-800 text-hover-primary">
                                        <h4 class="card-title mb-5">
                                            <i class="fa-solid fa-graduation-cap text-gray-800 me-2 fs-4"></i>
                                            <span>Data Program Studi</span>
                                        </h4>
                                    </a>
                                    <p class="badge badge-primary">{{ $prodi }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-4">
                    <div class="row g-3">
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-body d-flex justify-content-between pb-4">
                                    <a href="{{ route('office.timeline.news.index') }}" class="menu-link text-gray-800 text-hover-primary">
                                        <h4 class="card-title mb-5">
                                            <i class="fa-solid fa-newspaper text-gray-800 me-2 fs-4"></i>
                                            <span>Data Berita</span>
                                        </h4>
                                    </a>
                                    <p class="badge badge-primary">{{ $news }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-body d-flex justify-content-between pb-4">
                                    <a href="{{ route('office.timeline.activity.index') }}" class="menu-link text-gray-800 text-hover-primary">
                                        <h4 class="card-title mb-5">
                                            <i class="fa-solid fa-image text-gray-800 me-2 fs-4"></i>
                                            <span>Data Kegiatan</span>
                                        </h4>
                                    </a>
                                    <p class="badge badge-primary">{{ $activity }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="card shadow">
                                <div class="card-body d-flex justify-content-between pb-4">
                                    <a href="{{ route('office.comment.index') }}" class="menu-link text-gray-800 text-hover-primary">
                                        <h4 class="card-title mb-5">
                                            <i class="fa-solid fa-comment text-gray-800 me-2 fs-4"></i>
                                            <span>Data Komentar</span>
                                        </h4>
                                    </a>
                                    <p class="badge badge-primary">{{ $comment }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end::Content container-->
    </div>
    <!--end::Content-->
</x-app-layout>
