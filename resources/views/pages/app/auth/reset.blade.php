<x-app-layout title="Reset Password">
    <div class="d-flex flex-column flex-lg-row-fluid w-lg-450 w-100 p-10 order-2 order-lg-1">
        <div class="d-flex flex-center flex-column flex-lg-row-fluid">
            <div class="d-flex justify-content-center">
                <div style="text-align: center">
                    <img src="{{ asset('web/images/logodel.png') }}" alt="Logo IT Del" style="width: 70px; height:auto">
                    <h3 style="padding: 30px">Sistem Informasi Fakultas Vokasi</h3>
                    <hr>
                </div>
            </div>
            <div class="w-lg-450px w-sm-75 w-md-50 w-100 p-10">
                <form class="form w-100" novalidate="novalidate" id="form_input" data-redirect-url="{{route('office.auth.index')}}" action="{{route('office.auth.doreset')}}" method="post">
                    <input type="hidden" name="token" value="{{ request()->token }}">
                    <div class="fv-row mb-8">
                        <input type="password" placeholder="Password Baru" id="password" name="password" autocomplete="off" class="form-control bg-transparent" data-cms-translate="input-password" data-validation="The password field is required" data-format="The password must be at least 8 characters" />
                    </div>
                    <div class="fv-row mb-8">
                        <input type="password" placeholder="Konfirmasi Password Baru" id="password_confirmation" name="password_confirmation" autocomplete="off" class="form-control bg-transparent" data-cms-translate="input-password-confirmation" data-validation="The password-confirmation field is required" data-format="The password confirmation must be at least 8 characters" />
                    </div>
                    <div class="row mb-10">
                        <div class="col-md-12 d-flex justify-content-end">
                            <button onclick="handle_post_two('#tombol_simpan','#form_input')" id="tombol_simpan" class="btn btn-primary">
                                <span class="indicator-label">Ganti Password</span>
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
