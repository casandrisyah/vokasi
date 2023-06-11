<x-web-layout title="Tentang Kami">
    <style>
        .card {
            width: 280px !important;
            flex-basis: 280px !important;
            align-self: stretch;
        }
        .card-img {
            width: 150px;
            height: 150px;
            margin-left: auto;
            margin-right: auto;
            border-radius: 50%;
            object-fit: cover;
            object-position: top center;
        }
        .card-text {
            font-size: 14px
        }
        .bg-gray-400 {
            background-color: #e2e8f0;
        }
    </style>
    @include('themes.web.styling.timeline_styling')
    <section id="content">
        <div class="content-wrap">
        <div class="container-fluid">

            <div class="position-relative">

                {{-- <div class="timeline-border"></div> --}}

                <div id="posts" class="post-grid grid-container row post-timeline" data-basewidth=".entry:not(.entry-date-section):eq(0)">

                    <div class="entry entry-date-section col-12 mb-0" id="sejarah">
                        <span>SEJARAH KAMI</span>
                    </div>
                    @if ($history->count())
                    <section class="timeline">
                        <ul>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($history as $index => $item)
                            <li id="list-item-{{ $no++ }}">
                                <div id="content-item-{{ $no++ }}" class="content text-dark">
                                    <h2>
                                        <time>{{ $item->year }}</time>
                                    </h2>
                                    <p>{!! $item->desc !!}</p>
                                </div>
                            </li>
                            @endforeach
                            </ul>
                    </section>
                    @else
                    <div class="col-md-6 mx-auto mt-5">
                        <div class="alert alert-primary text-center" role="alert">
                            <i class="bi-exclamation-circle fs-5 me-2"></i> Tidak ada sejarah yang tersedia.
                        </div>
                    </div>
                    @endif

                </div>

            </div>
        </div></div>

        <div style="padding-top: 30px; background: #003966" id="visi-misi">
            <div class="container pb-5">
                <style>
                    @import url('{{ asset("web/css/default-list.css") }}');
                </style>
                <div class="entry entry-date-section col-12 mb-3">
                    <span>Visi dan Misi</span>
                </div>
                <div class="row g-5">
                    <div class="col-md-6">
                        <h4 class="text-white fw-bold mb-3">Visi</h4>
                        <div id="color-white-important" class="text-white">{!! $vision->visi ?? '<p class="text-white">Visi belum ditambahkan</p>' !!}</div>
                    </div>
                    <div class="col-md-6">
                        <h4 class="text-white fw-bold mb-3">Misi</h4>
                        <div id="color-white-important" class="text-white">
                            {!! $vision->misi ?? '<p class="text-white">Misi belum ditambahkan</p>'!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container pb-5" id="struktur">
            <div class="entry entry-date-section col-12 mt-5 mb-0">
                <span class="border-0">Struktur Organisasi</span>
                @if ($structure->count())
                <div class="d-flex justify-content-center">
                    <div class="card bg-gray-400 m-2">
                        <img src="{{ $structure[0]->thumbnail ? Storage::url($structure[0]->thumbnail) : asset('web/images/no-img-profile.jpg') }}" class="card-img my-3">
                        <div class="card-body pt-0">
                            <div class="card-text fw-semibold">{{ $structure[0]->position }}</div>
                            <div class="card-text">{!! $structure[0]->name !!}</div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-wrap justify-content-center align-items-center">
                    @foreach ($structure->skip(1) as $item)
                    <div class="card bg-gray-400 m-3">
                        <img src="{{ $item->thumbnail ? Storage::url($item->thumbnail) : asset('web/images/no-img-profile.jpg') }}" class="card-img my-3">
                        <div class="card-body pt-0">
                            <div class="card-text fw-semibold">{{ $item->position }}</div>
                            <div class="card-text">{!! $item->name !!}</div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="col-md-6 mx-auto mt-4">
                    <div class="alert alert-primary text-center" role="alert">
                        <i class="bi-exclamation-circle fs-5 me-2"></i> Struktur organisasi belum ditambahkan.
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>

    <script>
        document.querySelectorAll('#color-white-important *').forEach(function(node) {
            node.style.color = 'white !important';
        });

        function adjustListHeights() {
            var listItemElements = document.querySelectorAll('[id^="list-item-"]');
            var contentItemElements = document.querySelectorAll('[id^="content-item-"]');

            for (var i = 0; i < listItemElements.length; i++) {
                var listItem = listItemElements[i];
                var contentItem = contentItemElements[i];
                var contentHeight = contentItem.offsetHeight;

                listItem.style.height = contentHeight + 'px';
            }
        }


        window.onload = function() {
            adjustListHeight();
        };

    </script>
</x-web-layout>
