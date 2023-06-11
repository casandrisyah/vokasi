<table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_customers_table">
    <thead>
        <tr class="text-start text-gray-400 fw-bold fs-7 text-uppercase gs-0">
            <th class="w-10px pe-2">
                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_customers_table .form-check-input" value="1" />
                </div>
            </th>
            <th class="min-w-125px">Nama Kegiatan</th>
            <th class="min-w-125px">Pemberi Hibah</th>
            <th class="min-w-125px">Jenis</th>
            <th class="min-w-125px">Pemberi Dana</th>
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
            <td>{{ $item->project_name }}</td>
            <td>{{ $item->organizer }}</td>
            <td>{{ $item->type }}</td>
            <td>{{$item->involved_parties}}</td>
            <td>
                @if ($item->is_active == 1)
                <span class="badge badge-light-success py-3 px-4 fs-7">Aktif</span>
                @else
                <span class="badge badge-light-danger py-3 px-4 fs-7">Tidak Aktif</span>
                @endif
            </td>
            <td>{{$item->created_at->format('d F Y, H:i A')}}</td>
            <td class="text-end text-nowrap">
                <a href="{{route('office.civitas.dosen.funding.edit', [$item->user_id, $item->id])}}" class="menu-link btn btn-icon btn-warning"><i class="las la-edit text-black fs-2"></i></a>
                @if ($item->is_active == 1)
                <button type="button" title="Non Aktifkan" id="tombol_non_aktif" data-redirect-url="{{route('office.civitas.dosen.funding.index', $dosen->id)}}" onclick="handle_is_active('PATCH','{{route('office.civitas.dosen.funding.update',$item->id)}}','#tombol_non_aktif', 0);" class="btn btn-icon btn-danger"><i class="las la-times fs-2"></i></button>
                @else
                <button type="button" title="Aktifkan" id="tombol_aktif" data-redirect-url="{{route('office.civitas.dosen.funding.index', $dosen->id)}}" onclick="handle_is_active('PATCH','{{route('office.civitas.dosen.funding.update',$item->id)}}','#tombol_aktif', 1);" class="btn btn-icon btn-success"><i class="las la-check fs-2"></i></button>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{$collection->links('themes.app.pagination')}}
