<x-app-layout title="Beranda - Eksplor Fakultas">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Eksplor Fakultas</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Menu Beranda</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Eksplor Fakultas</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid transition-fade">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form id="form_input" class="form" data-redirect-url="{{route('office.appearance.faculty-explore-section.index')}}" action="{{route('office.appearance.faculty-explore-section.update')}}" method="PATCH">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-10">
                            <div class="col-md-5 mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Judul</label>
                                <input type="text" class="form-control form-control-solid" name="title" id="title" value="{{$data->title}}">
                            </div>
                            {{-- <div class="col-md-6 col-lg-5 mb-4">
                                <label class="fw-semibold fs-6 mb-2">Teks Dibawah Judul</label>
                                <input type="text" class="form-control form-control-solid" name="text_under_title" id="text_under_title" value="{{$data->text_under_title}}">
                            </div> --}}
                            <div class="col-md-2">
                                <label class="fw-semibold fs-6 mb-2">Tampilkan ?</label>
                                <div class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                    <input class="form-check-input " type="checkbox" value="1" {{$data->is_active == 1 ? 'checked' : ''}} id="is_active" name="is_active"/>
                                    <label class="form-check-label" for="is_active">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.dashboard.index')}}" class="menu-link btn btn-light me-3">Batal</a>
                            <button id="tombol_simpan" onclick="handle_post('#tombol_simpan','#form_input');" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Harap tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
            <div class="card">
                <div class="card-header border-0 pt-6">
                    <div class="card-toolbar">
                        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
                            <a href="{{route('office.appearance.faculty-items-section.create')}}" class="menu-link btn btn-primary">Tambah Item Eksplor Fakultas</a>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div id="list_result" class="table-responsive"></div>
                </div>
            </div>
        </div>
    </div>
    @section('custom_js')
    <script>
        load_list(1)
    </script>
    @endsection
</x-office-layout>
