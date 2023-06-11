<x-app-layout title="{{$data->id ? 'Perbarui' : 'Tambah'}} Aktivitas Mahasiswa">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Aktivitas Mahasiswa</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('office.timeline.activity.index')}}" class="menu-link text-gray-800 text-hover-primary">Aktivitas Mahasiswa</a>
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
            <form id="form_input" class="form" data-redirect-url="{{route('office.timeline.activity.index')}}" action="{{$data->id ? route('office.timeline.activity.update',$data->id) : route('office.timeline.activity.store')}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-10">
                            <div class="col-4">
                                <label class="required fw-semibold fs-6 mb-2">Kategori</label>
                                <select name="category" id="category" class="form-select form-select-solid">
                                    <option disabled selected>Pilih Kategori</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->name}}" {{$data->category == $item->name ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label class="required fw-semibold fs-6 mb-2">Judul</label>
                                <input type="text" class="form-control form-control-solid" name="judul" id="judul" value="{{$data->title}}">
                            </div>
                            <div class="col-4">
                                <label class="required fw-semibold fs-6 mb-2">Waktu Pelaksanaan</label>
                                <input type="text" class="form-control form-control-solid" name="tanggal" id="tanggal" value="{{$data->date}}">
                            </div>
                            {{-- <div class="col-4 mt-5">
                                <label class="required fw-semibold fs-6 mb-2">Jenis Kegiatan</label>
                                <select class="form-select form-select-solid" name="jenis_kegiatan" id="jenis_kegiatan">
                                    <option disabled selected>Pilih Jenis Kegiatan</option>
                                    <option value="Offline" {{$data->type == "Offline" ? 'selected' : ''}}>Offline</option>
                                    <option value="Online" {{$data->type == "Online" ? 'selected' : ''}}>Online</option>
                                </select>
                            </div> --}}
                            <div class="col-4 mt-5" id="div_show">
                                <label class="fw-semibold fs-6 mb-2" id="title">Tempat Pelaksanaan  </label>
                                <input type="text" class="form-control form-control-solid" name="lokasi" id="lokasi" value="{{$data->location}}">
                            </div>
                            {{-- <div class="col-4 mt-5">
                                <label class="fw-semibold fs-6 mb-2">Link Pendaftaran</label>
                                <input type="text" class="form-control form-control-solid" name="link_pendaftaran" id="link_pendaftaran" value="{{$data->url}}">
                            </div> --}}
                            <div class="col-md-12 mt-5">
                                <label class="required fw-semibold fs-6 mb-2">Deskripsi</label>
                                <input id="description" type="hidden" name="description" value="{{ $data->description }}">
                                <trix-editor input="description"></trix-editor>
                            </div>
                            <div class="col-4 mt-5">
                                <label class="d-block required fw-semibold fs-6 mb-2">Gambar</label>
                                <img
                                    src="{{$data->thumbnail ? Storage::url($data->thumbnail) : ''}}"
                                    data-src="{{$data->thumbnail ? Storage::url($data->thumbnail) : ''}}"
                                    class="lozad rounded mb-3 {{$data->thumbnail ?? 'd-none'}}"
                                    id="thumbnail-preview" style="height: 200px;"
                                />
                                <input class="form-control form-control-solid" type="file" name="gambar" id="thumbnail">
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.timeline.activity.index')}}" class="menu-link btn btn-light me-3">Batal</a>
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
        obj_date_time("tanggal");
        obj_select("jenis_kegiatan");
        obj_select("category");
        $("#div_show").hide();
        if($("#jenis_kegiatan").val() == "Online") {
            $("#div_show").show();
            $("#title").text("Link Pertemuan");
        } else {
            $("#div_show").show();
            $("#title").text("Tempat Pelaksanaan");
        }
        $("#jenis_kegiatan").change(function() {
            if ($(this).val() == "Online") {
                $("#div_show").show();
                $("#title").text("Link Pertemuan");
            } else if ($(this).val() == "Offline") {
                $("#div_show").show();
                $("#title").text("Tempat Pelaksanaan");
            } else {
                $("#div_show").hide();
            }
        });
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
    </script>
    @endsection
</x-office-layout>
