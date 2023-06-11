<x-app-layout title="Beranda - Item Eksplor Fakultas">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Item Eksplor Fakultas</h1>
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
                    <li class="breadcrumb-item text-gray-800">Item Eksplor Fakultas</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid transition-fade">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form id="form_input" class="form" data-redirect-url="{{route('office.appearance.faculty-explore-section.index')}}" action="{{$data->id ? route('office.appearance.faculty-items-section.update', $data->id) : route('office.appearance.faculty-items-section.store')}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-lg-4 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2 d-block">Gambar</label>
                                <img
                                    src="{{$data->thumbnail ? Storage::url($data->thumbnail) : ''}}"
                                    data-src="{{$data->thumbnail ? Storage::url($data->thumbnail) : ''}}"
                                    class="lozad rounded {{$data->thumbnail ?? 'd-none'}}"
                                    id="thumbnail-preview" style="height: 200px;"
                                />
                                <input class="form-control form-control-solid mt-4" type="file" name="thumbnail" id="thumbnail">
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-md-6 mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Judul</label>
                                <input type="text" class="form-control form-control-solid" name="title" id="title" value="{{$data->title}}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Url Tujuan</label>
                                <input type="text" class="form-control form-control-solid" name="url" id="url" value="{{$data->url}}" placeholder="contoh: route('web.home') atau /home">
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.appearance.faculty-explore-section.index')}}" class="menu-link btn btn-light me-3">Batal</a>
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
        $(document).ready(function() {
            if ($("#thumbnail").length > 0) {
                $("#thumbnail").change(function(e) {
                    e.preventDefault();
                    if ($("#thumbnail-preview").attr("src") === "") {
                        $("#thumbnail-preview").removeClass("d-none")
                    }
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $("#thumbnail-preview").attr("src", e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            }
        });
    </script>
    @endsection
</x-office-layout>
