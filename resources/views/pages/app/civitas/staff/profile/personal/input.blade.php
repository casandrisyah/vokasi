<x-app-layout title="Identitas">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Identitas</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{route('office.civitas.staff.index')}}" class="menu-link text-gray-800 text-hover-primary">Staf</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">{{ $data->name }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Identitas</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid transition-fade">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form id="form_input" class="form" data-redirect-url="{{route('office.civitas.staff.index')}}" action="{{ route('office.civitas.staff.personal.update',$data->id) }}" method="PATCH">
                <div class="card mb-5">
                    <div class="card-body">
                        <h4 class="mb-5">Data Diri</h4>
                        <div class="row mb-10">
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Nama Staf</label>
                                <input type="text" class="form-control form-control-solid mb-3" name="name" id="name" value="{{$data->name}}">
                            </div>
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Posisi</label>
                                <select name="user_category_id" id="staf_position" class="form-select form-select-solid">
                                    <option disabled selected>Pilih Posisi</option>
                                    @foreach ($category as $item)
                                        <option value="{{$item->id}}" {{$data->user_category_id == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Tempat Lahir</label>
                                <input type="text" class="form-control form-control-solid mb-3" name="place_birth" id="place_birth" value="{{$data->place_birth}}">
                            </div>
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Tanggal Lahir</label>
                                <input type="date" class="form-control form-control-solid mb-3" name="date_birth" id="date_birth" value="{{$data->date_birth}}">
                            </div>
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Email</label>
                                <input type="text" class="form-control form-control-solid mb-3" name="email" id="email" value="{{$data->email}}">
                            </div>
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">ID Karyawan</label>
                                <input type="text" class="form-control form-control-solid mb-3" name="employee_id" id="employee_id" value="{{ $data->employee_id }}">
                            </div>
                            <div class="col-md-6">
                                <label class="fw-semibold fs-6 mb-2">No Handphone</label>
                                <input type="tel" class="form-control form-control-solid mb-3" name="phone" id="phone" value="{{ $data->phone }}">
                            </div>
                            <div class="col-12 mb-4">
                                <label class="fw-semibold fs-6 mb-2">Keahlian</label>
                                <input id="skill" type="hidden" name="skill" value="{{ $data->skill }}">
                                <trix-editor input="skill"></trix-editor>
                            </div>
                            <div class="col-md-6">
                                <label class="d-block fw-semibold fs-6 mb-2">Gambar</label>
                                <img
                                    src="{{$data->avatar ? Storage::url($data->avatar) : ''}}"
                                    data-src="{{$data->avatar ? Storage::url($data->avatar) : ''}}"
                                    class="lozad rounded mb-3 {{$data->avatar ?? 'd-none'}}"
                                    id="avatar-image" style="height: 200px;"
                                />
                                <input type="file" class="form-control form-control-solid mb-3" name="avatar" id="avatar">
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.civitas.staff.index')}}" class="menu-link btn btn-light me-3">Batal</a>
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
        obj_date('date_birth')
        obj_select('staf_position')

        $(document).ready(function() {
            if ($("#avatar").length > 0) {
                $("#avatar").change(function(e) {
                    e.preventDefault();
                    if ($("#avatar-image").attr("src") === "") {
                        $("#avatar-image").removeClass("d-none")
                    }
                    let reader = new FileReader();
                    reader.onload = (e) => {
                        $("#avatar-image").attr("src", e.target.result);
                    }
                    reader.readAsDataURL(this.files[0]);
                });
            }
        });
    </script>
    @endsection
</x-office-layout>
