<x-app-layout title="Lupa Password">
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-450 w-100 p-10 order-2 order-lg-1">
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            @if (session('session_data') !== null)
            <div class="alert alert-dismissible bg-light-primary d-flex align-items-center flex-column flex-sm-row p-3 mb-10">
                <i class="ki-duotone ki-notification-bing fs-2hx text-primary me-4 mb-5 mb-sm-0"><span class="path1"></span><span class="path2"></span><span class="path3"></span></i>
                <div class="d-flex flex-column pe-0 pe-sm-10">
                    <span>{{ $session_data['message'] }}</span>
                </div>
                <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert">
                    <i class="ki-duotone ki-cross fs-1 text-primary"><span class="path1"></span><span class="path2"></span></i>
                </button>
            </div>
            @endif
            <div class="d-flex justify-content-center">
                <div style="text-align: center">
                    <img src="{{ asset('web/images/logodel.png') }}" alt="Logo IT Del" style="width: 70px; height:auto">
                    <h3 style="padding: 30px">Sistem Informasi Fakultas Vokasi</h3>
                    <hr>
                </div>
            </div>
            <div class="w-lg-450px w-sm-75 w-md-50 w-100 p-10">
                <form class="form w-100" novalidate="novalidate" id="form_forgot" data-redirect-url="{{route('office.auth.forgot')}}" action="{{route('office.auth.doforgot')}}" method="post">
                    <div class="fv-row mb-8">
                        <input type="email" placeholder="Masukkan Email" id="email" name="email" autocomplete="email" class="form-control bg-transparent" data-login="1" data-validation="The email field is required" data-format="The email must be a valid email address" autofocus />
                    </div>
                    <div class="row mb-10 mt-10">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button type="submit" onclick="handle_post_noswup('#tombol_forgot','#form_forgot')" id="tombol_forgot" class="btn btn-primary">
                                <span class="indicator-label">Kirim Link Reset Password</span>
                                <span class="indicator-progress">Tunggu...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
