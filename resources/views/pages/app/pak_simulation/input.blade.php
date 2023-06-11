<x-app-layout title="Simulasi PAK">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Simulasi PAK</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Lainnya</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Simulasi PAK</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid transition-fade">
        <div id="kt_app_content_container" class="app-container container-fluid">
        <form id="form_input" class="form" data-redirect-url="{{route('office.pak-simulation.index')}}" action="{{route('office.pak-simulation.update')}}" method="PATCH">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Link</label>
                                <input type="url" class="form-control form-control-solid mb-3" name="url" id="url" value="{{$data->url}}">
                            </div>
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
        </div>
    </div>
</x-office-layout>
