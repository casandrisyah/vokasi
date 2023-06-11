
<nav class="navbar navbar-expand-lg bg-body-tertiary" style=" padding-left: 30px;">
    <div style="display: flex; gap: 10px; mr-5">
        <img src="{{ asset('web/images/logodel.png') }}" alt="Logo IT Del" style="width: 65px; height:75px">
        <a href="" class="navbar-brand" style="font-weight: bolder">
            <div style="display: flex; flex-direction: column;">
                <span style="color: #13005a; font-size: 20px">FAKULTAS VOKASI</span>
                <span style="font-size: 15px; font-weight: semi-bold">Institut Teknologi Del</span>
            </div>
        </a>
    </div>

    <div class="container-fluid">
        <div class="collapse navbar-collapse ml-5" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item px-3">
                    <a class="nav-link active" aria-current="page" href="/">Beranda</a>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link active" aria-current="page" href="{{route('web.tentang')}}">Tentang</a>
                </li>
                <li class="nav-item dropdown px-3">
                    <a class="nav-link active dropdown-toggle " href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Program Studi
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">D-III Teknologi Komputer</a></li>
                        <li><a class="dropdown-item" href="#">D-III Teknologi Informasi</a></li>
                        <li><a class="dropdown-item" href="#">Sarjana Terapan Teknologi Rekayasa Perangkat
                                Lunak</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown px-3">
                    <a class="nav-link dropdown-toggle active " href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Civitas
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Dosen</a></li>
                        <li><a class="dropdown-item" href="#">Staff</a></li>
                    </ul>
                </li>
                <li class="nav-item px-3">
                    <a class="nav-link active" href="{{route('web.berita')}}">Berita</a>
                </li>
                <li class="nav-item dropdown px-3">
                    <a class="nav-link dropdown-toggle active " href="aktivitass" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Aktivitas Mahasiswa
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{route('web.activity','Himatek')}}">HIMATEK</a></li>
                        <li><a class="dropdown-item" href="{{route('web.activity','Himatif')}}">HIMATIF</a></li>
                        <li><a class="dropdown-item" href="{{route('web.activity','Himatera')}}">HIMATERA</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown px-3">
                    <a class="nav-link dropdown-toggle active " href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Program
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Pengajaran</a></li>
                        <li><a class="dropdown-item" href="#">Penelitian</a></li>
                        <li><a class="dropdown-item" href="#">Pengabdian Kepada Masyarakat</a></li>
                    </ul>
                </li>
                @guest
                <li class="px-3"><a href="{{ route('office.auth.index') }}" class="btn btn-primary">Login</a></li>
                @else
                    <li class="nav-item px-3 dropdown">

                        <a id="navbarDropdown" class="nav-link dropdown-toggle active" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre><i
                                class="bi bi-person-circle"></i> {{ Auth::user()->name }}</a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('office.auth.logout') }}"
                                onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('office.auth.logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>

                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
