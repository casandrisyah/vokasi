<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <thead>
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                </div>
            </th>
            <th class="min-w-125px">Nama Dosen</th>
            <th class="min-w-125px">Email</th>
            <th class="min-w-125px">Aktif/Non Aktif</th>
            <th class="min-w-125px">Dibuat Tanggal</th>
            <th class="text-end min-w-70px">Aksi</th>
        </tr>
    </thead>
    <tbody class="fw-semibold text-gray-600">
        @foreach ($collection as $item)
        <tr>
            <td>
                <div class="form-check form-check-sm form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" />
                </div>
            </td>
            <td>
                <a href="{{route('office.civitas.dosen.personal.index',$item->id)}}" class="menu-link text-gray-600 text-hover-primary mb-1">{{$item->name}}</a>
            </td>
            <td>
                <a href="{{route('office.civitas.dosen.edit',$item->id)}}" class="menu-link text-gray-600 text-hover-primary mb-1">{{$item->email}}</a>
            </td>
            <td>
                @if ($item->is_active == 1)
                <span class="badge badge-light-success py-3 px-4 fs-7">Aktif</span>
                @else
                <span class="badge badge-light-danger py-3 px-4 fs-7">Tidak Aktif</span>
                @endif
            </td>
            <td>{{$item->created_at->format('d F Y, H:i A')}}</td>
            <td class="text-end text-nowrap">
                <button type="button" class="btn btn-info rotate" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-offset="30px, 5px">
                    <i class="bi bi-person-lines-fill text-white fs-3"></i>
                    <span class="svg-icon svg-icon-5 rotate-180 m-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="white" />
                        </svg>
                    </span>
                </button>
                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-700 menu-state-bg-light-primary py-4 fw-semibold w-200px text-start" data-kt-menu="true">
                    <div id="kt_menu" class="menu-item px-3" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="-20px, 5px">
                        <a href="#" class="menu-link px-3">
                            <span class="menu-icon">
                                <i class="fa-solid fa-user"></i>
                            </span>
                            <span class="menu-title">Profil</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div id="kt_menu_item" class="menu-sub menu-sub-dropdown w-200px py-4">
                            <div class="menu-item px-3">
                                <a href="{{ route('office.civitas.dosen.personal.index', $item->id) }}" class="menu-link px-3">
                                    <span class="menu-icon">
                                        <i class="fa-solid fa-id-card-clip"></i>
                                    </span>
                                    Identitas
                                </a>
                            </div>
                        </div>
                    </div>
                    <div id="kt_menu_second" class="menu-item px-3" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="left-start" data-kt-menu-offset="30px, 5px">
                        <a href="#" class="menu-link px-3">
                            <span class="menu-icon">
                                <i class="fa-solid fa-star"></i>
                            </span>
                            <span class="menu-title">Portofolio</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div id="kt_menu_item_second" class="menu-sub menu-sub-dropdown w-280px py-4">
                            <div class="menu-item px-3">
                                <a href="{{ route('office.civitas.dosen.about.index', $item->id) }}" class="menu-link px-3">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="fa-solid fa-circle-info"></i>
                                    </span>
                                    <span class="menu-title">Tentang</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="{{ route('office.civitas.dosen.research.index', $item->id) }}" class="menu-link px-3">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="fa-solid fa-newspaper"></i>
                                    </span>
                                    <span class="menu-title">Penelitian</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="{{ route('office.civitas.dosen.funding.index', $item->id) }}" class="menu-link px-3">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="fa-solid fa-money-check-dollar"></i>
                                    </span>
                                    <span class="menu-title">Pendanaan</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="{{ route('office.civitas.dosen.education.index', $item->id) }}" class="menu-link px-3">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="fa-solid fa-graduation-cap"></i>
                                    </span>
                                    <span class="menu-title">Riwayat Pendidikan</span>
                                </a>
                            </div>
                            <div class="menu-item px-3">
                                <a href="{{ route('office.civitas.dosen.teaching-mentoring.index', $item->id) }}" class="menu-link px-3">
                                    <span class="menu-icon" data-kt-element="icon">
                                        <i class="fa-solid fa-school"></i>
                                    </span>
                                    <span class="menu-title">Pengajaran dan Pembimbingan</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{route('office.civitas.dosen.edit',$item->id)}}" class="menu-link btn btn-icon btn-warning"><i class="las la-edit text-black fs-2"></i></a>
                @if ($item->is_active == 1)
                <button type="button" title="Non Aktifkan" id="tombol_non_aktif" data-redirect-url="{{route('office.civitas.dosen.index')}}" onclick="handle_is_active('PATCH','{{route('office.civitas.dosen.update',$item->id)}}','#tombol_non_aktif', 0);" class="btn btn-icon btn-danger"><i class="las la-times fs-2"></i></button>
                @else
                <button type="button" title="Aktifkan" id="tombol_aktif" data-redirect-url="{{route('office.civitas.dosen.index')}}" onclick="handle_is_active('PATCH','{{route('office.civitas.dosen.update',$item->id)}}','#tombol_aktif', 1);" class="btn btn-icon btn-success"><i class="las la-check fs-2"></i></button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
    KTMenu.createInstances();
    var menuElement = document.querySelector("#kt_menu");
    var menu = KTMenu.getInstance(menuElement)
    var item = document.querySelector("#kt_menu_item");
    menuElement.each(function() {
        $(this).hover(function() {
           menu.show(item);
        });
        $(this).click(function() {
            menu.show(item);
        });
    });

    var menuElementSecond = document.querySelector("#kt_menu_second");
    var menuSecond = KTMenu.getInstance(menuElementSecond)
</script>
{{$collection->links('themes.app.pagination')}}
