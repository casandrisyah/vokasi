<x-app-layout title="{{$data->id ? 'Perbarui' : 'Tambah'}} Struktur Organisasi">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Struktur Organisasi</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('office.about.organization.index')}}" class="menu-link text-gray-800 text-hover-primary">Struktur Organisasi</a>
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
            <form id="form_input" class="form" data-redirect-url="{{route('office.about.organization.index')}}" action="{{$data->id ? route('office.about.organization.update',$data->id) : route('office.about.organization.store')}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-10">
                            <div class="col-sm-2">
                                <label class="required fw-semibold fs-6 mb-2">Urutan</label>
                                <input type="text" class="form-control form-control-solid number_only" name="order" id="order" value="{{$data->order}}">
                            </div>
                            <div class="col-sm-6">
                                <label class="required fw-semibold fs-6 mb-2">Nama</label>
                                <input type="text" class="form-control form-control-solid" name="nama" id="nama" value="{{$data->name}}">
                            </div>
                            <div class="col-sm-4">
                                <label class="required fw-semibold fs-6 mb-2">Posisi</label>
                                <select name="posisi" id="select_role" class="form-select form-select-solid">
                                    <option disabled selected>Pilih Posisi</option>
                                    <option value="Dekan Fakultas Vokasi" {{ $data->position == 'Dekan Fakultas Vokasi' ? 'selected' : '' }}>Dekan Fakultas Vokasi</option>
                                    <option value="Kaprodi D-III TI" {{ $data->position == 'Kaprodi D-III TI' ? 'selected' : '' }}>Kaprodi D-III Teknologi Informasi</option>
                                    <option value="Kaprodi D-III TK" {{ $data->position == 'Kaprodi D-III TK' ? 'selected' : '' }}>Kaprodi D-III Teknologi Komputer</option>
                                    <option value="Kaprodi Sarjana Terapan TRPL" {{ $data->position == 'Kaprodi Sarjana Terapan TRPL' ? 'selected' : '' }}>Kaprodi Sarjana Terapan Teknologi Rekayasa Perangkat Lunak</option>
                                    <option value="NN" {{ $data->position == 'NN' ? 'selected' : '' }}>NN</option>
                                </select>
                            </div>
                            <div class="col-sm-6 mt-4">
                                <label class="required fw-semibold fs-6 mb-3 d-block">Gambar</label>
                                <img
                                    src="{{$data->thumbnail ? Storage::url($data->thumbnail) : ''}}"
                                    data-src="{{$data->thumbnail ? Storage::url($data->thumbnail) : ''}}"
                                    class="lozad rounded {{$data->thumbnail ?? 'd-none'}}"
                                    id="thumbnail-preview" style="height: 200px;"
                                />
                                <input class="form-control form-control-solid mt-3" type="file" name="gambar" id="thumbnail">
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.about.organization.index')}}" class="menu-link btn btn-light me-3">Batal</a>
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
        obj_select("select_role");

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
