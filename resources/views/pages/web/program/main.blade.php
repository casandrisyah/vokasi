<x-web-layout title="program {{ $category->name ?? '-' }}">
    <!-- Page Title
  ============================================= -->
    <section class="page-title page-title-parallax parallax dark">
        <div class="container">
            <div class="page-title-row">

                <div class="page-title-content">
                    <h2>Program Studi {{ $category->name ?? '-' }}</h2>
                    <span>
                        {!! $program->definisi ?? '-' !!}
                    </span>
                </div>
            </div>
        </div>
    </section><!-- .page-title end -->
    <!-- Content
  ============================================= -->
    <section id="content" class="pb-5">
        <div class="container">
            <div id="section-features" class=" page-section" style="margin-top: -35px">
                <div style="margin-top: -20px; border-top:3px; padding-top: 30px">
                    <h3 style="color: #003966"><b>SEJARAH</b></h3>
                </div>
                <hr class="col-4" style="margin-top: -20px; padding: 1px; border-top: 5px solid; color:#EE771D">
                <p>
                    {!! $program->sejarah ?? '-' !!}
                </p>
            </div>
        </div>
        <div style="background: #003966">
            <div class="container">
                <div id="section-features" class=" page-section">
                    <div style="border-top:3px; padding-top: 30px">
                        <h3 style="color: white"><b>Visi dan Misi D3 - Teknologi Informasi</b></h3>
                    </div>

                    <hr class="col-4" style="margin-top: -20px; padding: 1px; border-top: 5px solid; color:#EE771D">
                    <div class="row" style="margin-top: 20px">
                        <div class="col-6 col-md-6" id="color-white-important">
                            <h4 style="color: white"><b> Visi </b></h4>
                            <p style="margin-top: -20px; color: white !important;">
                                {!! $program->visi ?? '-' !!}
                            </p>
                        </div>
                        <div class="col-6 col-md-6" id="color-white-important">
                            <h4 style="color: white"><b> Misi </b></h4>
                            <p style="margin-top: -20px; color: white !important;">
                                {!! $program->misi ?? '-' !!}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div id="section-features" class=" page-section">
                <div style="border-top:3px; padding-top: 30px">
                    <h3 style="color: #003966"><b>Tujuan Profil Lulusan</b></h3>
                </div>
                <hr class="col-4" style="margin-top: -20px; padding: 1px; border-top: 5px solid; color:#EE771D">
                <div class="col-md-6" id="color-black-important">
                    {!! $program->tujuan ?? '-' !!}
                </div>
                @if ($program)
                    @if ($program->link != null)
                    <div class="mt-4">
                        <span>Kunjungi link berikut untuk informasi lebih lanjut: </span>
                        <a href="{{ $program->link }}" style="color: #0081e3" target="_blank">{{ $program->link }}</a>
                    </div>
                    @endif
                @endif
            </div>

        </div>
    </section><!-- #content end -->

    <script>
        document.querySelectorAll('#color-white-important *').forEach(function(node) {
            node.style.color = 'white';
        });
        document.querySelectorAll('#color-black-important *').forEach(function(node) {
            node.style.color = 'black';
        });
    </script>
</x-web-layout>
