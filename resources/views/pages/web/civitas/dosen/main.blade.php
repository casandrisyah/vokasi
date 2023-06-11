<x-web-layout title="Dosen">
    <style>
        .card-img {
            width: 80% !important;
            height: 14rem;
            object-fit: cover;
            object-position: top center;
            border-radius: 20px
        }
        @media (max-width: 1400px) {
            .card-img {
                width: 95% !important;
                height: 14rem;
            }
        }
        @media (max-width: 576px) {
            .card-img {
                width: 100% !important;
                height: 18rem;
            }
        }
    </style>
    <!-- Content ============================================= -->
    <section id="content">
        <div class="content-wrap">
            <div class="container-sm">
                <form action="/civitas/dosen/" method="GET">
                    <div class="row d-md-flex justify-content-between"  style="margin-top: -40px">
                        <div class="col-md-5">
                            <div class="float-left">
                                <div class="form-group">
                                    <select class="form-select required" name="urutkan" id="urutkan-dosen">
                                        <option value="">Urutkan Berdasarkan</option>
                                        <option value="dosen_d3_tk" {{ request()->urutkan == 'dosen_d3_tk' ? 'selected' : '' }}>Dosen D-III Teknologi Komputer</option>
                                        <option value="dosen_d3_ti" {{ request()->urutkan == 'dosen_d3_ti' ? 'selected' : '' }}>Dosen D-III Teknologi Informasi</option>
                                        <option value="dosen_trpl" {{ request()->urutkan == 'dosen_trpl' ? 'selected' : '' }}>Dosen Sarjana Terapan Teknologi Rekayasa Perangkat Lunak
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" placeholder="Cari..." class="form-control" value="{{ request()->search }}">
                                    <button type="submit" class="btn btn-light">Cari</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="row col-mb-50 mb-0">

                    @if ($dosen->count() < 1 && request('urutkan') && request('search'))
                    <div class="alert alert-primary col-lg-8 mx-auto text-center pb-3 mb-5" role="alert">
                        <i class="bi-exclamation-circle fs-5 me-2"></i> Dosen dengan kategori "{{ $urutkan }}" dan kata kunci "{{ request('search') }}", tidak ditemukan ;_;
                    </div>
                    @elseif ($dosen->count() < 1 && request('search'))
                    <div class="alert alert-primary col-lg-8 mx-auto text-center pb-3 mb-5" role="alert">
                        <i class="bi-exclamation-circle fs-5 me-2"></i> Dosen dengan kata kunci "{{ request('search') }}", tidak ditemukan ;_;
                    </div>
                    @elseif ($dosen->count() < 1 && request('urutkan'))
                    <div class="alert alert-primary col-lg-8 mx-auto text-center pb-3 mb-5" role="alert">
                        <i class="bi-exclamation-circle fs-5 me-2"></i> Dosen dengan kategori "{{ $urutkan }}", tidak ditemukan ;_;
                    </div>
                    @endif

                   @if ($dosen != null)
                       @foreach ($dosen as $item)
                       <div class="col-lg-3 col-sm-6 px-xl-4">
                           <a href="{{ route('web.civitas.dosen.show', $item->id) }}" class="menu-link team">
                               <div class="team-image">
                                   <img src="{{ $item->avatar ? Storage::url($item->avatar) : asset('web/images/no-img-profile.jpg') }}" alt="{{ $item->name }}" class="card-img">
                                   <div class="team-title">
                                       <h5 class="mb-0">{{ $item->name }}</h5>
                                       <span>{{ $item->user_category ? $item->user_category->name : '' }}</span>
                                   </div>
                               </div>
                           </a>
                        </div>
                        @endforeach
                    @else
                    <div class="col-md-6 mx-auto mt-5">
                        <div class="alert alert-primary text-center" role="alert">
                            <i class="bi-exclamation-circle fs-5 me-2"></i> Data dosen belum tersedia.
                        </div>
                    </div>
                   @endif

                </div>

                <!-- Pager ============================================= -->
                {{ $dosen->links('themes.web.pagination') }}
                <!-- .pager end -->
            </div>
        </div>
    </section><!-- #content end -->

</x-web-layout>
