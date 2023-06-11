<x-app-layout title="{{$data->id ? 'Perbarui' : 'Tambah'}} Kategori Staff">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Kategori Staff</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('office.civitas.category-staff.index')}}" class="menu-link text-gray-800 text-hover-primary">Kategori Staff</a>
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
            <form id="form_input" class="form" data-redirect-url="{{route('office.civitas.category-staff.index')}}" action="{{$data->id ? route('office.civitas.category-staff.update',$data->id) : route('office.civitas.category-staff.store')}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-10">
                            <div class="col-md-6 mb-3">
                                <label class="required fw-semibold fs-6 mb-2">Nama Kategori</label>
                                <input type="text" class="form-control form-control-solid" name="name" id="name" value="{{$data->name}}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="required fw-semibold fs-6 mb-2">Slug Kategori</label>
                                <input type="text" class="form-control form-control-solid" name="slug" id="slug" value="{{$data->slug}}">
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.civitas.category-staff.index')}}" class="menu-link btn btn-light me-3">Batal</a>
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
        if ($("#name").length > 0 && $("#slug").length > 0) {
            $("#name").on("input", function() {
                $("#slug").val($(this).val().toLowerCase()
                    .trim()
                    .replace(/[^\w\s-]/g, "")
                    .replace(/[\s_-]+/g, "-")
                    .replace(/^-+|-+$/g, ""));
            });
        }
    </script>
    @endsection
</x-office-layout>

