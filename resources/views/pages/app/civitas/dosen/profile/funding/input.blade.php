<x-app-layout title="{{$data->id ? 'Perbarui' : 'Tambah'}} Pendanaan">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pendanaan</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
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
                    <li class="breadcrumb-item text-gray-800">Riwayat Pendidikan</li>
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
            <form id="form_input" class="form" data-redirect-url="{{route('office.civitas.dosen.funding.index', $dosen->id)}}" action="{{$data->id ? route('office.civitas.dosen.funding.update', $data->id) : route('office.civitas.dosen.funding.store', $dosen->id)}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-10">
                            <input type="hidden" name="user_id" id="user_id" value="{{ $dosen->id }}">
                            <div class="col-12">
                                <label class="required fw-semibold fs-6 mb-2">Nama Kegiatan</label>
                                <input type="text" class="form-control form-control-solid mb-3" name="project_name" id="project_name" value="{{$data->project_name}}">
                            </div>
                            <div class="col-6">
                                <label class="required fw-semibold fs-6 mb-2">Pemberi Hibah</label>
                                <input type="text" class="form-control form-control-solid mb-3" name="organizer" id="organizer" value="{{$data->organizer}}">
                            </div>
                            <div class="col-6">
                                <label class="required fw-semibold fs-6 mb-2">Pemberi Dana</label>
                                <input type="text" class="form-control form-control-solid mb-3" name="involved_parties" id="involved_parties" value="{{$data->involved_parties}}">
                            </div>
                            <div class="col-6">
                                <label class="required fw-semibold fs-6 mb-2">Waktu Pengerjaan</label>
                                <input class="form-control form-control-solid mb-3" name="working_time" id="working_time" value="{{$data->working_time}}">
                            </div>
                            <div class="col-6">
                                <label class="required fw-semibold fs-6 mb-2">Tempat Penyelenggaraan</label>
                                <input class="form-control form-control-solid mb-3" name="working_area" id="working_area" value="{{$data->working_area}}">
                            </div>
                            <div class="col-6">
                                <label class="required fw-semibold fs-6 mb-2">Jenis</label>
                                <select name="type" id="funding_type" class="form-select form-select-solid" data-hide-search="true" data-hide-search="true">
                                    <option disabled selected>Pilih Kategori</option>
                                    <option value="Internal" {{ $data->type == 'Internal' ? 'selected' : '' }}>Hibah Internal</option>
                                    <option value="Eksternal" {{ $data->type == 'Eksternal' ? 'selected' : '' }}>Hibah Eksternal</option>
                                </select>
                            </div>
                            <div class="col-md-12 mt-5">
                                <label class="fw-semibold fs-6 mb-2">Deskripsi</label>
                                <input id="desc" type="hidden" name="desc" value="{{ $data->desc }}">
                                <trix-editor input="desc"></trix-editor>
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.civitas.dosen.funding.index', $dosen->id)}}" class="menu-link btn btn-light me-3">Batal</a>
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
    <script type="text/javascript">
        obj_select("funding_type");
        obj_date_range("working_time");
    </script>
    @endsection
</x-office-layout>
