<x-app-layout title="Komentar">
    <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6 transition-fade">
        <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
            <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Komentar</h1>
                <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                    <li class="breadcrumb-item">
                        <a href="{{route('office.dashboard.index')}}" class="menu-link text-gray-800 text-hover-primary">Dasbor</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('office.comment.index') }}" class="menu-link text-gray-800 text-hover-primary">Komentar</a>
                    </li>
                    <li class="breadcrumb-item">
                        <span class="bullet bg-gray-800 w-5px h-2px"></span>
                    </li>
                    <li class="breadcrumb-item text-gray-800">Detail</li>
                </ul>
            </div>
            {{-- <div class="d-flex align-items-center gap-2 gap-lg-3">
            </div> --}}
        </div>
    </div>
    <div id="kt_app_content" class="app-content flex-column-fluid transition-fade">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="row mb-10">
                        <div class="col-12">
                            <label class="required fw-semibold fs-6 mb-2">Komentar</label>
                            <div class="border border-gray-500 rounded p-5" style="min-height: 200px">{!!$data->body!!}</div>
                        </div>
                    </div>
                    <div class="text-center pt-15">
                        <a href="{{route('office.comment.index')}}" class="menu-link btn btn-primary me-3">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-office-layout>
