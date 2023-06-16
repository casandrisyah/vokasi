<style>
    .container {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    @media (min-width: 768px) {
        .card {
            padding: 30px;
            width: 500px;
            height: 550px;
        }
    }
</style>

<x-web-layout title="Ganti Password">
    <div class="container">
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="card">
                    <div class="d-flex justify-content-center">
                        <div style="text-align: center">
                            <img src="{{ asset('web/images/logodel.png') }}" alt="Logo IT Del" style="width: 70px; height:auto">
                            <h3 class="mt-4">Sistem Informasi Fakultas Vokasi</h3>
                        </div>
                    </div>
                    <hr>
                    <div class="card-body">
                        <form action="{{ route('web.auth.do_reset') }}" method="post">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="row mb-3">
                                <label for="password" class="col-md-12 col-form-label text-md-start font-weight-bold"><b>{{ __('Password Baru') }}</b></label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror {{ session('error') != null ? 'is-invalid' : '' }}" name="password" autocomplete="current-password">
                                    <strong class="invalid-feedback">{{ session('error') }}</strong>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password_confirmation" class="col-md-12 col-form-label text-md-start font-weight-bold"><b>{{ __('Konfirmasi Password Baru') }}</b></label>

                                <div class="col-md-12">
                                    <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror {{ session('error') != null ? 'is-invalid' : '' }}" name="password_confirmation" autocomplete="current-password">
                                    <strong class="invalid-feedback">{{ session('error') }}</strong>
                                    @error('password_confirmation')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3" style="padding-top: 20px">

                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                        {{ __('Ganti Password') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelector('form').addEventListener('submit', function(e) {
            e.preventDefault();
            this.querySelector('button').innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...';
            this.querySelector('button').setAttribute('disabled', true);
            this.submit();
        })
        document.querySelector('button').addEventListener('click', function(e) {
            e.preventDefault();
            this.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Loading...';
            this.setAttribute('disabled', true);
            this.closest('form').submit();
        })
    </script>
</x-web-layout>
