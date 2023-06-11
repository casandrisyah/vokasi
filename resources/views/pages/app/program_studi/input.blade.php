<x-app-layout title="{{$data->id ? 'Perbarui' : 'Tambah'}} Program Studi">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Program Studi</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('office.program-studi.index')}}" class="menu-link text-gray-800 text-hover-primary">Program Studi</a>
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
            <form id="form_input" class="form" data-redirect-url="{{route('office.program-studi.index')}}" action="{{$data->id ? route('office.program-studi.update',$data->id) : route('office.program-studi.store')}}" method="{{$data->id ? 'PATCH' : 'POST'}}">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-10">
                            <div class="col-md-6 mb-3">
                                <label class="required fw-semibold fs-6 mb-2">Kategori</label>
                                <select name="category_prodi_id" id="category" class="form-select form-select-solid">
                                    <option disabled selected>Pilih Kategori</option>
                                    @foreach ($category_prodi as $item)
                                    <option value="{{$item->id}}" {{$data->category_prodi_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="required fw-semibold fs-6 mb-2">Definisi</label>
                                <input id="definisi" type="hidden" name="definisi" value="{{ $data->definisi }}">
                                <trix-editor input="definisi"></trix-editor>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="required fw-semibold fs-6 mb-2">Sejarah</label>
                                <input id="sejarah" type="hidden" name="sejarah" value="{{ $data->sejarah }}">
                                <trix-editor input="sejarah"></trix-editor>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="required fw-semibold fs-6 mb-2">Visi</label>
                                <input id="visi" type="hidden" name="visi" value="{{ $data->visi }}">
                                <trix-editor input="visi"></trix-editor>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="required fw-semibold fs-6 mb-2">Misi</label>
                                <input id="misi" type="hidden" name="misi" value="{{ $data->misi }}">
                                <trix-editor input="misi"></trix-editor>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="required fw-semibold fs-6 mb-2">Tujuan</label>
                                <input id="tujuan" type="hidden" name="tujuan" value="{{ $data->tujuan }}">
                                <trix-editor input="tujuan"></trix-editor>
                            </div>
                            <div class="col-6">
                                <label class="fw-semibold fs-6 mb-2">Link Program Studi</label>
                                <input type="url" class="form-control form-control-solid mb-3" name="link" id="link" value="{{$data->link}}">
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.program-studi.index')}}" class="menu-link btn btn-light me-3">Batal</a>
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
        obj_select('category');
    </script>
    @endsection
</x-office-layout>
