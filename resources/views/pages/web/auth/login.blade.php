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

<x-web-layout title="Login">
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
                        <form action="{{ route('web.auth.login') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="email" class="col-md-12 col-form-label text-md-start"><b>{{ __('Email') }}</b>
                                </label>

                                <div class="col-md-12">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-12 col-form-label text-md-start font-weight-bold"><b>{{ __('Password') }}</b></label>

                                <div class="col-md-12">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror {{ session('error') != null ? 'is-invalid' : '' }}" name="password" required autocomplete="current-password">
                                    <strong class="invalid-feedback">{{ session('error') }}</strong>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3" style="padding-top: 20px">
                                <div class="col-md-6 d-flex justify-content-start" style="padding-left: 30px;">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                            {{ __('Ingat saya') }}
                                        </label>
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary px-4">
                                        {{ __('Login') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-web-layout>
