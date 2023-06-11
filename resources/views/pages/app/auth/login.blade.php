<x-app-layout title="Halaman Masuk">
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
                <form class="form w-100" novalidate="novalidate" id="form_login" data-redirect-url="{{route('office.dashboard.index')}}" action="{{route('office.auth.login')}}">
                    <div class="fv-row mb-8">
                        <input type="email" placeholder="Email" id="email" name="email" autocomplete="email" class="form-control bg-transparent" data-login="1" data-validation="The email field is required" data-format="The email must be a valid email address" autofocus />
                    </div>
                    <div class="fv-row mb-3">
                        <input type="password" placeholder="Password" id="password" name="password" autocomplete="off" class="form-control bg-transparent" data-cms-translate="input-password" data-login="2"  data-validation="The password field is required" data-format="The password must be at least 8 characters" />
                    </div>
                    {{-- <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8">
                        <div></div>
                        <a href="{{route('office.auth.forgot')}}" class="link-primary menu-link">Lupa Kata Sandi ?</a>
                    </div> --}}
                    <div class="row mb-10 mt-10">
                        <div class="col-md-6 d-flex justify-content-start">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                <label class="form-check-label" for="remember">
                                    {{ __('Ingat saya') }}
                                </label>
                            </div>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end">
                            <button onclick="handle_post('#tombol_login','#form_login')" id="tombol_login" class="btn btn-primary">
                                <span class="indicator-label">Login</span>
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
