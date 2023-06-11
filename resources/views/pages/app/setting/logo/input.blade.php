<x-app-layout title="Pengaturan">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Pengaturan</h1>
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
                    <li class="breadcrumb-item text-gray-800">Pengaturan</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid transition-fade">
        <div id="kt_app_content_container" class="app-container container-fluid">
        <form id="form_input" class="form" data-redirect-url="{{route('office.setting.logo.index')}}" action="{{route('office.setting.logo.update')}}" method="PATCH">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-5">
                            <div class="col-lg-4 col-md-6">
                                <label class="required fw-semibold fs-6 mb-2 d-block">Logo Website</label>
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
                                <label class="required fw-semibold fs-6 mb-2">Nama Fakultas</label>
                                <input type="text" class="form-control form-control-solid" name="faculty" id="faculty" value="{{$data->faculty}}">
                            </div>
                            <div class="col-md-6 mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Nama Universitas</label>
                                <input type="text" class="form-control form-control-solid" name="university" id="university" value="{{$data->university}}">
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2">Link Facebook</label>
                                <input type="url" class="form-control form-control-solid mb-3" name="facebook_url" id="facebook_url" value="{{$data->facebook_url}}">
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2">Link Instagram</label>
                                <input type="url" class="form-control form-control-solid mb-3" name="instagram_url" id="instagram_url" value="{{$data->instagram_url}}">
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2">Link Youtube</label>
                                <input type="url" class="form-control form-control-solid mb-3" name="youtube_url" id="youtube_url" value="{{$data->youtube_url}}">
                            </div>
                            <div class="col-md-4">
                                <label class="fw-semibold fs-6 mb-2">Link Linkedin</label>
                                <input type="url" class="form-control form-control-solid mb-3" name="linkedin_url" id="linkedin_url" value="{{$data->linkedin_url}}">
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
