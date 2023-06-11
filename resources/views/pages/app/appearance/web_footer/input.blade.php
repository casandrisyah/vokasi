<x-app-layout title="{{$data->id ? 'Perbarui' : 'Tambah'}} Web Footer">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Web Footer</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">
                        <a href="{{route('office.appearance.web-footer.index')}}" class="menu-link text-gray-800 text-hover-primary">Web Footer</a>
                    </li>
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
            <form id="form_input" class="form" data-redirect-url="{{route('office.appearance.web-footer.index')}}" action="{{$data->id ? route('office.appearance.web-footer.update',$data->id) : route('office.appearance.web-footer.store')}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Section</label>
                                <select name="section" id="footer_section" class="form-select form-select-solid mb-3">
                                    <option disabled selected>Pilih Section</option>
                                    <option value="tentang" {{ $data->url == 'tentang' ? 'selected' : '' }}>Tentang</option>
                                    <option value="program studi" {{ $data->url == 'program' ? 'selected' : '' }}>Program Studi</option>
                                    <option value="aktivitas mahasiswa" {{ $data->url == 'aktivitas' ? 'selected' : '' }}>Aktivitas Mahasiswa</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Teks</label>
                                <input type="text" class="form-control form-control-solid" name="text" id="text" value="{{$data->text}}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Url</label>
                                <input type="text" class="form-control form-control-solid" name="url" id="url" value="{{$data->url}}">
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.appearance.web-footer.index')}}" class="menu-link btn btn-light me-3">Batal</a>
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
        obj_select("footer_section")
    </script>
    @endsection
</x-office-layout>
