<x-app-layout title="{{$data->id ? 'Perbarui' : 'Tambah'}} Pengajaran dan Pembimbingan">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pengajaran dan Pembimbingan</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('office.civitas.dosen.index')}}" class="menu-link text-gray-800 text-hover-primary">Dosen</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">{{ $dosen->name }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Pengajaran dan Pembimbingan</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">{{$data->id ? 'Perbarui' : 'Tambah'}}</li>
                </ul>
            </div>
            {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
            </div> --}}
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid transition-fade">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form id="form_input" class="form" data-redirect-url="{{route('office.civitas.dosen.teaching-mentoring.index', $dosen->id)}}" action="{{$data->id ? route('office.civitas.dosen.teaching-mentoring.update', $data->id) : route('office.civitas.dosen.teaching-mentoring.store', $dosen->id)}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-10">
                            <input type="hidden" name="user_id" id="user_id" value="{{ $dosen->id }}">
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Kategori</label>
                                <select name="category" id="category" class="form-select form-select-solid" data-hide-search="true" data-hide-search="true">
                                    <option disabled selected>Pilih Kategori</option>
                                    <option value="Pengajaran" {{ $data->category == 'Pengajaran' ? 'selected' : '' }}>Pengajaran</option>
                                    <option value="Pembimbingan" {{ $data->category == 'Pembimbingan' ? 'selected' : '' }}>Pembimbingan</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Judul</label>
                                <input type="text" class="form-control form-control-solid mb-3" name="title" id="title" value="{{$data->title}}">
                            </div>
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Tahun</label>
                                <input type="text" class="form-control form-control-solid number_only mb-3" name="year" id="year" value="{{$data->year}}">
                            </div>
                            <div class="col-md-12">
                                <label class="fw-semibold fs-6 mb-2">Nama Mahasiswa</label>
                                <input id="student_name" type="hidden" name="student_name" value="{{ $data->student_name }}">
                                <trix-editor input="student_name"></trix-editor>
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.civitas.dosen.teaching-mentoring.index', $dosen->id)}}" class="menu-link btn btn-light me-3">Batal</a>
                            <button id="tombol_simpan" onclick="handle_post('#tombol_simpan','#form_input');" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Harap tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    @section('custom_js')
        <script>
            obj_select("category");
        </script>
    @endsection
</x-office-layout>
