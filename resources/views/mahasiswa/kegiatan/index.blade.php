@extends('app', [
    'title' => 'Kegiatan Harian',
])

@section('content')
    @include('sweetalert::alert')

    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-fluid d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    @if (auth()->user()->role === 'admin')
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Daftar Kegiatan Harian
                        </h1>
                        <!--end::Title-->
                    @else
                        <!--begin::Title-->
                        <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                            Kegiatan Harian &mdash; {{ auth()->user()->name }}
                        </h1>
                        <!--end::Title-->
                    @endif
                </div>
                <!--end::Page title-->

                <!--begin::Actions-->
                <div class="d-flex align-items-center gap-2 gap-lg-3">
                    <!--begin::Filter menu-->
                    <div class="d-flex">
                        <a href="javascript:void(0);" class="btn btn-icon btn-sm btn-success flex-shrink-0 ms-4"
                            data-bs-toggle="modal" data-bs-target="#modal_tambah">
                            <i class="ki-duotone ki-plus fs-2"></i>
                        </a>
                    </div>
                </div>
                <!--end::Actions-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">
                <!--begin::Card-->
                <div class="card card-flush">
                    <!--begin::Card header-->
                    <div class="card-header mt-6">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <!--begin::Search-->
                            <div class="d-flex align-items-center position-relative my-1 me-5">
                                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <input type="text" data-kt-permissions-table-filter="search"
                                    class="form-control form-control-solid w-250px ps-13"
                                    placeholder="Cari data kegiatan" />
                            </div>
                            <!--end::Search-->
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0" id="kt_permissions_table">
                            <thead>
                                <tr class="text-start text-gray-900 fw-bold fs-7 text-uppercase gs-0">
                                    <th class="min-w-50px">Waktu</th>
                                    <th class="min-w-50px">Anggota</th>
                                    <th class="min-w-50px">Deskripsi Kegiatan</th>
                                    <th class="text-center min-w-50px">Status</th>
                                    <th class="text-center min-w-50px">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($kegiatans as $kegiatan)
                                    <tr>
                                        <td class="fw-bold">
                                            {{ \Carbon\Carbon::parse($kegiatan->waktu)->locale('id')->translatedFormat('l, d F Y') }}
                                        </td>
                                        <td>
                                            {{ $kegiatan->nama }}
                                        </td>
                                        <td>
                                            {{ $kegiatan->kegiatan }}
                                        </td>
                                        <td class="text-center">
                                            @if ($kegiatan->status == 'menunggu')
                                                <i class="ki-duotone ki-time fs-1 text-warning" data-bs-toggle="tooltip"
                                                    data-bs-custom-class="tooltip-inverse" data-bs-placement="top"
                                                    title="Menunggu Keputusan">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            @elseif ($kegiatan->status == 'ditampilkan')
                                                <i class="ki-duotone ki-check-circle fs-1 text-success"
                                                    data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse"
                                                    data-bs-placement="top" title="Ditampilkan">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            @else
                                                <i class="ki-duotone ki-cross-circle fs-1 text-danger"
                                                    data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse"
                                                    data-bs-placement="top" title="Disembunyikan">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="#"
                                                class="btn btn-sm btn-light btn-flex btn-center btn-active-light-primary"
                                                data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                                Opsi <i class="ki-duotone ki-down fs-5 ms-1"></i>
                                            </a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-semibold fs-7 w-125px py-4"
                                                data-kt-menu="true">
                                                <form action="">
                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);" class="menu-link px-3"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal_update{{ $kegiatan->id }}">
                                                            Ubah
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);" class="menu-link px-3"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal_password{{ $kegiatan->id }}">
                                                            Status
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);" class="menu-link px-3"
                                                            onclick="event.preventDefault(); document.getElementById('hapus-mahasiswa-{{ $kegiatan->id }}').submit();">
                                                            Hapus
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </form>
                                            </div>

                                            <!--begin::Form Hapus-->
                                            <form action="{{ route('kegiatan.destroy', $kegiatan->id) }}" method="POST"
                                                id="hapus-mahasiswa-{{ $kegiatan->id }}" style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                            <!--end::Form Hapus-->
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>

    <!--begin::Modal Tambah-->
    <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="modal_tambah" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="{{ route('kegiatan.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Kegiatan Harian</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                    class="path2"></span></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">

                        <div class="row">
                            <div class="mb-5 col-12">
                                <label for="waktu" class="required form-label">Pilih Waktu</label>
                                <input id="waktu" name="waktu" class="form-control"
                                    placeholder="Pilih waktu kegiatan" />
                            </div>

                            <div class="mb-5 col-12">
                                <label for="kegiatan" class="form-label">Deskripsi Kegiatan</label>
                                <textarea id="kegiatan" name="kegiatan" class="form-control" data-kt-autosize="true"></textarea>
                            </div>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--end::Modal Tambah-->
@endsection

@push('custom-javascript')
    <script src="assets/js/custom/apps/user-management/permissions/list.js"></script>
    <script src="assets/js/custom/apps/user-management/permissions/add-permission.js"></script>
    <script src="assets/js/custom/apps/user-management/permissions/update-permission.js"></script>
    <script src="https://npmcdn.com/flatpickr/dist/l10n/id.js"></script>
    <script>
        $("#waktu").flatpickr({
            locale: "id",
            enableTime: true,
            dateFormat: "d-m-Y H:i",
        });
    </script>
@endpush