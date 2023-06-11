<x-app-layout title="{{$data->id ? 'Perbarui' : 'Tambah'}} Carousel">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Carousel</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">
                        <a href="{{route('office.appearance.carousel.index')}}" class="menu-link text-gray-800 text-hover-primary">Carousel</a>
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
            <form id="form_input" class="form" data-redirect-url="{{route('office.appearance.carousel.index')}}" action="{{$data->id ? route('office.appearance.carousel.update',$data->id) : route('office.appearance.carousel.store')}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label class="d-block required fw-semibold fs-6 mb-2">Gambar</label>
                                <a href="{{$data->thumbnail ? Storage::url($data->thumbnail) : '#'}}"><img
                                    src="{{$data->thumbnail ? Storage::url($data->thumbnail) : ''}}"
                                    data-src="{{$data->thumbnail ? Storage::url($data->thumbnail) : ''}}"
                                    class="lozad rounded {{$data->thumbnail ?? 'd-none'}}"
                                    id="thumbnail-preview" style="height: 200px; max-width: 100%;"
                                /></a>
                                <div class="col-md-6">
                                    <input class="form-control mt-3" type="file" name="gambar" id="thumbnail">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Tampilkan di</label>
                                <select name="url" id="carousel_url" class="form-select form-select-solid mb-3">
                                    <option disabled selected>Pilih Halaman</option>
                                    <option value="home" {{ $data->url == 'home' ? 'selected' : '' }}>Home</option>
                                    <option value="tentang" {{ $data->url == 'tentang' ? 'selected' : '' }}>Tentang</option>
                                    <option value="berita" {{ $data->url == 'berita' ? 'selected' : '' }}>Berita</option>
                                    <option value="civitas" {{ $data->url == 'civitas' ? 'selected' : '' }}>Civitas</option>
                                    <option value="program" {{ $data->url == 'program' ? 'selected' : '' }}>Program</option>
                                    <option value="aktivitas" {{ $data->url == 'aktivitas' ? 'selected' : '' }}>Aktivitas</option>
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="fw-semibold fs-6 mb-2">Judul</label>
                                <input id="title" type="hidden" name="title" value="{{ $data->title }}">
                                <trix-editor input="title"></trix-editor>
                            </div>
                            <div class="col-12">
                                <label class="fw-semibold fs-6 mb-2">Deskripsi</label>
                                <input id="deskripsi" type="hidden" name="deskripsi" value="{{ $data->desc }}">
                                <trix-editor input="deskripsi"></trix-editor>
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.appearance.carousel.index')}}" class="menu-link btn btn-light me-3">Batal</a>
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
        obj_select("carousel_url")

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
