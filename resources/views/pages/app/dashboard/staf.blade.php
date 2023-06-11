<x-app-layout title="Staff Dasbor">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Dashboard</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Staff</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid transition-fade">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card">
                <div class="card-body pt-6">
                    <div class="row">
                        <div class="col-sm-4 col-lg-3">
                            <img class="rounded-3" src="{{ $data->avatar ? Storage::url($data->avatar) : asset('web/images/no-img-profile.jpg') }}" alt="" style="width: 100%; min-height:250px; max-height: 350px; object-fit: cover; object-position: top center">
                        </div>
                        <div class="col-sm-8 col-lg-9">
                            <div class="bg-gray-300 p-5 rounded-2">
                                <i class="fa-solid fa-user fs-5 text-dark"></i>
                                <span class="fs-5 fw-bold ms-2">Profile Staff</span>
                            </div>
                            <div class="py-5 px-10 fw-semibold">
                                <table class="table">
                                    <tr>
                                        <td>Nama</td>
                                        <td>:</td>
                                        <td>{{ $data->name ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>ID Karyawan</td>
                                        <td>:</td>
                                        <td>{{ $data->employee_id ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Kategori</td>
                                        <td>:</td>
                                        <td>{{ $data->position ?? '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Fakultas</td>
                                        <td>:</td>
                                        <td>Vokasi</td>
                                    </tr>
                                </table>
                            </div>
                            {{-- make the position of the button to be at the very bottom  --}}
                            <div class="d-flex justify-content-end">
                                <a href="{{ route('office.staff.identitas.index') }}" class="menu-link btn btn-primary">Edit Data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
