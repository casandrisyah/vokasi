<x-app-layout title="Ubah Password">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Ubah Password</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dashboard</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">{{ $himatek->name }}</li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Ubah Password</li>
                </ul>
            </div>
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid transition-fade">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <form id="form_input" class="form" data-redirect-url="{{route('office.auth.index')}}" action="{{ route('office.himatek.change-password.update') }}" method="PATCH">
                <div class="card mb-5">
                    <div class="card-body">
                        <div class="row mb-10">
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Password Lama</label>
                                <input type="password" class="form-control form-control-solid mb-3" name="old_password" id="old_password" value="{{request()->old_password}}">
                            </div>
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Password Baru</label>
                                <input type="password" class="form-control form-control-solid mb-3" name="new_password" id="new_password" value="{{request()->new_password}}">
                            </div>
                            <div class="col-md-6">
                                <label class="required fw-semibold fs-6 mb-2">Konfirmasi Password Baru</label>
                                <input type="password" class="form-control form-control-solid mb-3" name="password_confirmation" id="password_confirmation" value="{{request()->password_confirmation}}">
                            </div>
                        </div>
                        <div class="text-center pt-15">
                            <a href="{{route('office.dashboard.index')}}" class="menu-link btn btn-light me-3">Batal</a>
                            <button id="tombol_simpan" onclick="handle_post_noswup('#tombol_simpan','#form_input');" class="btn btn-primary">
                                <span class="indicator-label">Ubah Password</span>
                                <span class="indicator-progress">Harap tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-office-layout>
