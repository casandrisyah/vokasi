<x-app-layout title="{{$data->id ? 'Perbarui' : 'Tambah'}} Berita">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Berita</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('office.timeline.news.index')}}" class="menu-link text-gray-800 text-hover-primary">Berita</a>
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
            <form id="form_input" class="form" data-redirect-url="{{route('office.timeline.news.index')}}" action="{{$data->id ? route('office.timeline.news.update',$data->id) : route('office.timeline.news.store')}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
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
                                <input class="form-control form-control-solid mt-4" type="file" name="gambar" id="thumbnail">
                            </div>
                        </div>
                        <div class="row mb-10">
                            <div class="col-md-5 mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Judul</label>
                                <input type="text" class="form-control form-control-solid" name="judul" id="judul" value="{{$data->title}}">
                            </div>
                            <div class="col-md-4 mb-4">
                                <label class="required fw-semibold fs-6 mb-2">Dibuat Oleh</label>
                                <input type="text" class="form-control form-control-solid" name="oleh" id="oleh" value="{{$data->created_by}}">
                            </div>
                            <div class="col-md-2">
                                <label class="fw-semibold fs-6 mb-2">Berita Utama ?</label>
                                <div class="form-check form-switch form-check-custom form-check-success form-check-solid">
                                    <input class="form-check-input " type="checkbox" value="1" {{$data->is_primary == 1 ? 'checked' : ''}} id="is_primary" name="utama"/>
                                    <label class="form-check-label" for="is_primary">
                                        Aktif
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-12 mt-5">
                                <label class="required fw-semibold fs-6 mb-2">Deskripsi</label>
                                <input id="description" type="hidden" name="description" value="{{ $data->desc }}">
                                <trix-editor input="description"></trix-editor>
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.timeline.news.index')}}" class="menu-link btn btn-light me-3">Batal</a>
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
