<x-web-layout title="Berita">
    <section id="content">
        <div class="content-wrap">
            <div class="container">

                <div class="row gx-5 col-mb-80">
                    <!-- Post Content
                    ============================================= -->
                    <main class="postcontent col-lg-9">

                        <div class="single-post mb-0">

                            <!-- Single Post
                            ============================================= -->
                            <div class="entry">

                                <!-- Entry Title
                                ============================================= -->
                                <div class="entry-title">
                                    <h2>{{ $news->title }}</h2>
                                </div><!-- .entry-title end -->

                                <!-- Entry Meta
                                ============================================= -->
                                <div class="entry-meta">
                                    <ul>
                                        <li><i class="uil uil-schedule"></i> {{ $news->created_at->format(' d F Y') }}</li>
                                        <li><a href="#"><i class="uil uil-user"></i> {{ $news->created_by }}</a></li>
                                    </ul>
                                </div><!-- .entry-meta end -->

                                <!-- Entry Image
                                ============================================= -->
                                <div class="entry-image">
                                    <a href="{{ Storage::url($news->thumbnail) }}" data-lightbox="image">
                                        <img src="{{ Storage::url($news->thumbnail) }}" alt="Blog Single">
                                    </a>
                                </div><!-- .entry-image end -->

                                <!-- Entry Content
                                ============================================= -->
                                <div class="entry-content mt-0 text-dark">

                                    <p>
                                        {!! $news->desc !!}
                                    </p>
                                    <!-- Post Single - Content End -->

                                </div>
                            </div><!-- .entry end -->

                        </div>

                    </main><!-- .postcontent end -->

                    <!-- Sidebar
                    ============================================= -->
                    <aside class="sidebar col-lg-3">
                        <div class="sidebar-widgets-wrap">
                            <div class="widget">

                                <ul class="nav canvas-tabs tabs nav-tabs size-sm mb-3" id="canvas-tab" style="background-color: #1C82AD" role="tablist">
                                    <li class="nav-item" role="presentation" style="background-color: #1C82AD">
                                        <div class="nav-link text-white fs-6" id="canvas-tab-1" data-bs-target="#tab-1" role="tab" aria-controls="canvas-tab-1"
                                            style="background-color: #1C82AD;border-left:0px;border-right:0px;">Berita Lainnya</div>
                                    </li>
                                </ul>

                                <div id="canvas-TabContent" class="tab-content">

                                    <div class="tab-pane show active" id="tab-1" role="tabpanel" aria-labelledby="canvas-tab-1" tabindex="0">
                                        <div class="posts-sm row col-mb-30" id="popular-post-list-sidebar">
                                            @if ($latest->count())
                                            @foreach ($latest as $l)
                                                <div class="entry col-12">
                                                    <div class="grid-inner row g-0">
                                                        <div class="col ps-3">
                                                            <div class="entry-title">
                                                                <h4 class="fs-5">
                                                                    <a href="{{ route('web.berita.show', $l->slug) }}">{{ $l->title }}</a>
                                                                </h4>
                                                                <p style="padding: 0 !important; margin: 0 !important;">{!! \Illuminate\Support\Str::limit($l->desc, 100, '...') !!}</p>
                                                            </div>
                                                            <div class="entry-meta" style="margin-top: -30px">
                                                                <ul>
                                                                    <li>
                                                                        <i class="uil uil-schedule"></i> {{ $l->created_at->format(' d F Y') }}
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                            @endforeach
                                            @else
                                                <p class="text-center">Tidak Ada Berita terkait</p>
                                            @endif
                                        </div>


                                    </div>



                                </div>
                            </div>
                    </aside><!-- .sidebar end -->

                    <div class="d-flex justify-content-between mb-5">
                        <button type="button" onclick="history.back()" class="btn btn-outline-secondary">&larr; Sebelumnya</button>
                    </div>

                </div>
            </div>
    </section><!-- #content end -->

</x-web-layout>
