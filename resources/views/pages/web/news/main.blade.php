<x-web-layout title="Berita">
    <section id="content">
        <div class="content-wrap">
            <div class="container">
                <div id="posts" class="row grid-container gutter-30">
                    @if ($primary != null)
                    <h4 style="padding: 1px; color:#073C64"><b>Berita Utama</b></h4>
                    <hr style="padding: 1px; margin-top: -20px; border-top: 5px solid; color: #EFCC11">
                    <center>
                        <div class="rounded">
                            <div class="grid-inner">
                                <div>
                                    <a href="{{ Storage::url($primary->thumbnail) }}" data-lightbox="image">
                                        <img src="{{ Storage::url($primary->thumbnail) }}" alt="{{ $primary->slug }}"
                                            style="top: 5%; width: 50%; height:350px; object-fit: cover; object-position: center"
                                            class="rounded-top"
                                        >
                                    </a>
                                </div>
                                <center>
                                <div class="entry-title" style="background-color: #3d9fca; width: 50%;">
                                    <h4 class="p-3" style="font-size: 16px; overflow: hidden; text-overflow: ellipsis; color: white"><a class="text-white text-nowrap" href="{{ route('web.berita.show',$primary->slug) }}">{{ $primary->title }}</a></h4>
                                </div>
                                <div class="entry-meta rounded-bottom px-3 py-1" style="background-color: #013880; width: 50%; margin-top : -2px" >
                                    <ul>
                                        <li style="color: white !important"><i class="uil uil-schedule"></i> {{ $primary->created_at->format('d F Y') }}</li>
                                    </ul>
                                </div>
                            </center>
                            </div>
                        </div>
                    </center>
                    @endif
                </div>
                <br> <br>
                <!-- Posts
                ============================================= -->
                <div id="posts" class="row grid-container gutter-30">
                    <h4 style="padding: 1px; color:#073C64"><b>Berita Terbaru</b></h4>
                    <hr style="padding: 1px; margin-top: -20px; border-top: 5px solid; color: #EFCC11">
                </div>
                <div id="posts" class="post-grid row grid-container gutter-40" data-layout="fitRows">

                    @if ($news->count())
                        @foreach ($news as $item)
                        <div class="entry col-lg-4 col-md-6 col-12">
                            <div class="grid-inner">
                                <div class="entry-image">
                                    <a href="{{ Storage::url($item->thumbnail) }}" data-lightbox="image">
                                        <img src="{{ Storage::url($item->thumbnail) }}" alt="{{ $item->slug }}" style="height: 270px; object-fit: cover; object-position: center">
                                    </a>
                                </div>
                                <div class="entry-title">
                                    <h4 class="text-nowrap overflow-hidden fs-6" style="text-overflow: ellipsis"><a href="{{ route('web.berita.show', $item->slug) }}" class="menu-link">{{ $item->title }}</a></h4>
                                </div>
                                <div class="entry-meta">
                                    <ul>
                                        <li><i class="uil uil-schedule"></i> {{ $item->created_at->format(' d F Y') }}</li>
                                    </ul>
                                </div>
                                <a href="{{ route('web.berita.show', $item->slug) }}" class="menu-link more-link">Baca Selengkapnya</a>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="col-md-6 mx-auto mt-5">
                        <div class="alert alert-primary text-center" role="alert">
                            <i class="bi-exclamation-circle fs-5 me-2"></i> Tidak ada berita yang tersedia.
                        </div>
                    </div>
                    @endif

                </div><!-- #posts end -->

                <div class="clear mt-5"></div>

                <!-- Pagination ============================================= -->
                {{ $news->links('themes.web.pagination') }}
                <!-- .pager end -->

            </div>
        </div>
    </section>
</x-web-layout>
