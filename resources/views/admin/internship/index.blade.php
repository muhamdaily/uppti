@extends('app', [
    'title' => 'Data Mahasiswa',
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
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-gray-900 fw-bold fs-3 flex-column justify-content-center my-0">
                        Data Mahasiswa
                    </h1>
                    <!--end::Title-->

                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <span class="text-muted">UPT TI &mdash; Institut Teknologi dan Sains Mandala</span>
                        </li>
                    </ul>
                    <!--end::Breadcrumb-->
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
                                    placeholder="Cari data mahasiswa" />
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
                                    <th class="min-w-50px">NIM</th>
                                    <th class="min-w-50px">Nama Lengkap</th>
                                    <th class="min-w-50px">Program Studi</th>
                                    <th class="min-w-50px">Email</th>
                                    <th class="min-w-50px">Telepon</th>
                                    <th class="min-w-50px">Status Akun</th>
                                    <th class="text-center min-w-50px">Opsi</th>
                                </tr>
                            </thead>
                            <tbody class="fw-semibold text-gray-600">
                                @foreach ($mahasiswas as $mahasiswa)
                                    <tr>
                                        <td>
                                            <span class="fw-bold badge badge-dark">
                                                {{ $mahasiswa->nim }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($mahasiswa->status === 'aktif')
                                                <a href="javascript:void(0);" class="menu-link px-3" data-bs-toggle="modal"
                                                    data-bs-target="#modal_view{{ $mahasiswa->id }}">
                                                    {{ $mahasiswa->nama }}
                                                </a>
                                            @else
                                                {{ $mahasiswa->nama }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $mahasiswa->prodi }}
                                        </td>
                                        <td>
                                            {{ $mahasiswa->email }}
                                        </td>
                                        <td>
                                            @if ($mahasiswa->telepon == null)
                                                <span class="badge badge-danger">Belum Diatur</span>
                                            @else
                                                {{ $mahasiswa->telepon }}
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($mahasiswa->status == 'aktif')
                                                <i class="ki-duotone ki-check-circle fs-1 text-success"
                                                    data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse"
                                                    data-bs-placement="top" title="Sudah Aktif">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            @else
                                                <i class="ki-duotone ki-cross-circle fs-1 text-danger"
                                                    data-bs-toggle="tooltip" data-bs-custom-class="tooltip-inverse"
                                                    data-bs-placement="top" title="Belum Aktif">
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
                                                            data-bs-target="#modal_update{{ $mahasiswa->id }}">
                                                            Ubah
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);" class="menu-link px-3"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modal_password{{ $mahasiswa->id }}">
                                                            Password
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->

                                                    <!--begin::Menu item-->
                                                    <div class="menu-item px-3">
                                                        <a href="javascript:void(0);" class="menu-link px-3"
                                                            onclick="event.preventDefault(); document.getElementById('hapus-mahasiswa-{{ $mahasiswa->id }}').submit();">
                                                            Hapus
                                                        </a>
                                                    </div>
                                                    <!--end::Menu item-->
                                                </form>
                                            </div>

                                            <!--begin::Form Hapus-->
                                            <form action="{{ route('mahasiswa.destroy', $mahasiswa->id) }}" method="POST"
                                                id="hapus-mahasiswa-{{ $mahasiswa->id }}" style="display: none;">
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
            <form action="{{ route('mahasiswa.store') }}" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Tambah Data Mahasiswa</h3>

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
                            <div class="mb-5 col-6">
                                <label for="nim" class="required form-label">NIM</label>
                                <input type="text" id="nim" name="nim" class="form-control"
                                    placeholder="Masukkan NIM Mahasiswa" />
                            </div>

                            <div class="mb-5 col-6">
                                <label for="nama" class="required form-label">Nama Lengkap</label>
                                <input type="text" id="nama" name="nama" class="form-control"
                                    placeholder="Masukkan Nama Mahasiswa" />
                            </div>

                            <div class="mb-5 col-12">
                                <label for="prodi" class="required form-label">Program Studi</label>
                                <select id="prodi" name="prodi" class="form-select" data-control="select2"
                                    data-placeholder="Pilih Program Studi" data-dropdown-parent="#modal_tambah"
                                    data-allow-clear="true">
                                    <option></option>
                                    <option value="Manajemen">Manajemen</option>
                                    <option value="Akuntansi">Akuntansi</option>
                                    <option value="Ekonomi Pembangunan">Ekonomi Pembangunan</option>
                                    <option value="Rekayasa Perangkat Lunak (RPL)">
                                        Rekayasa Perangkat Lunak (RPL)
                                    </option>
                                    <option value="Sistem dan Teknologi Informasi (STI)">
                                        Sistem dan Teknologi Informasi (STI)
                                    </option>
                                    <option value="Keuangan dan Perbankan">Keuangan dan Perbankan</option>
                                </select>
                            </div>

                            <div class="mb-5 col-6">
                                <label for="email" class="required form-label">Email</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Masukkan Email Mahasiswa" />
                            </div>

                            <div class="mb-5 col-6">
                                <label for="telepon" class="form-label">Nomor Telepon</label>
                                <input type="text" id="telepon" name="telepon" class="form-control"
                                    placeholder="Masukkan Nomor Telepon/Whatsapp" />
                            </div>

                            <div class="mb-5 col-12">
                                <label for="alamat" class="form-label">Alamat</label>
                                <textarea id="alamat" class="form-control" data-kt-autosize="true"></textarea>
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

    <!--begin::Modal Ubah-->
    @foreach ($mahasiswas as $mahasiswa)
        <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="modal_update{{ $mahasiswa->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">
                                Ubah Data {{ $mahasiswa->nama }}
                            </h3>

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
                                <div class="mb-5 col-6">
                                    <label for="nim" class="required form-label">NIM</label>
                                    <input type="text" id="nim" name="nim" class="form-control"
                                        placeholder="Masukkan NIM Mahasiswa" value="{{ $mahasiswa->nim }}" />
                                </div>

                                <div class="mb-5 col-6">
                                    <label for="nama" class="required form-label">Nama Lengkap</label>
                                    <input type="text" id="nama" name="nama" class="form-control"
                                        placeholder="Masukkan Nama Mahasiswa" value="{{ $mahasiswa->nama }}" />
                                </div>

                                <div class="mb-5 col-12">
                                    <label for="prodi{{ $mahasiswa->id }}" class="required form-label">Program
                                        Studi</label>
                                    <select id="prodi{{ $mahasiswa->id }}" name="prodi" class="form-select"
                                        data-control="select2" data-placeholder="Pilih Program Studi"
                                        data-dropdown-parent="#modal_update{{ $mahasiswa->id }}" data-allow-clear="true">
                                        <option></option>
                                        <option value="Manajemen"
                                            {{ $mahasiswa->prodi == 'Manajemen' ? 'selected' : '' }}>Manajemen
                                        </option>
                                        <option value="Akuntansi"
                                            {{ $mahasiswa->prodi == 'Akuntansi' ? 'selected' : '' }}>Akuntansi
                                        </option>
                                        <option value="Ekonomi Pembangunan"
                                            {{ $mahasiswa->prodi == 'Ekonomi Pembangunan' ? 'selected' : '' }}>Ekonomi
                                            Pembangunan
                                        </option>
                                        <option value="Rekayasa Perangkat Lunak (RPL)"
                                            {{ $mahasiswa->prodi == 'Rekayasa Perangkat Lunak (RPL)' ? 'selected' : '' }}>
                                            Rekayasa Perangkat Lunak (RPL)
                                        </option>
                                        <option value="Sistem dan Teknologi Informasi (STI)"
                                            {{ $mahasiswa->prodi == 'Sistem dan Teknologi Informasi (STI)' ? 'selected' : '' }}>
                                            Sistem dan Teknologi Informasi (STI)
                                        </option>
                                        <option value="Keuangan dan Perbankan"
                                            {{ $mahasiswa->prodi == 'Keuangan dan Perbankan' ? 'selected' : '' }}>Keuangan
                                            dan Perbankan
                                        </option>
                                    </select>
                                </div>

                                <div class="mb-5 col-6">
                                    <label for="email" class="required form-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control"
                                        placeholder="Masukkan Email Mahasiswa" value="{{ $mahasiswa->email }}" />
                                </div>

                                <div class="mb-5 col-6">
                                    <label for="telepon" class="form-label">Nomor Telepon</label>
                                    <input type="text" id="telepon" name="telepon" class="form-control"
                                        placeholder="Masukkan Nomor Telepon/Whatsapp"
                                        value="{{ $mahasiswa->telepon }}" />
                                </div>

                                <div class="mb-5 col-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea id="alamat" class="form-control" data-kt-autosize="true">{{ $mahasiswa->alamat }}</textarea>
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
    @endforeach
    <!--end::Modal Ubah-->

    <!--begin::Modal Password-->
    @foreach ($mahasiswas as $mahasiswa)
        <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="modal_password{{ $mahasiswa->id }}"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="{{ route('mahasiswa.password', $mahasiswa->id) }}" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Pengaturan Akun {{ $mahasiswa->nama }}</h3>

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
                                <div class="mb-5 col-6">
                                    <label for="username" class="required form-label">Username</label>
                                    <input type="text" id="username" name="username" class="form-control"
                                        placeholder="Masukkan Username"
                                        @foreach ($users as $user)
                                        @if ($mahasiswa->nama == $user->name && $mahasiswa->status == 'aktif')
                                        value="{{ $user->username }}"
                                        @endif @endforeach />
                                </div>

                                <div class="mb-5 col-6">
                                    <label for="password" class="required form-label">Kata Sandi</label>
                                    <input type="text" id="password" name="password" class="form-control"
                                        placeholder="Masukkan Kata Sandi"
                                        @if ($mahasiswa->status == 'nonaktif') value="password" @endif />
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
    @endforeach
    <!--end::Modal Password-->

    <!--begin::Modal Lihat Detail-->
    @foreach ($mahasiswas as $data)
        <div class="modal fade" data-bs-backdrop="static" tabindex="-1" id="modal_view{{ $data->id }}"
            aria-hidden="true" data-bs-focus="false">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title">Detail Informasi Mahasiswa &mdash; {{ $data->nama }}</h3>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                            aria-label="Close">
                            <i class="ki-duotone ki-cross fs-1">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <!--begin::Details item-->
                            <div class="col-6">
                                <div class="fw-bold mt-5">NIM Mahasiswa</div>
                                <div class="text-gray-600">
                                    {{ $data->nim }}
                                </div>
                            </div>
                            <!--end::Details item-->

                            <!--begin::Details item-->
                            <div class="col-6">
                                <div class="fw-bold mt-5">Nama Lengkap</div>
                                <div class="text-gray-600">
                                    {{ $data->nama }}
                                </div>
                            </div>
                            <!--end::Details item-->

                            <!--begin::Details item-->
                            <div class="col-12">
                                <div class="fw-bold mt-5">Program Studi</div>
                                <div class="text-gray-600">
                                    {{ $data->prodi }}
                                </div>
                            </div>
                            <!--end::Details item-->

                            <!--begin::Details item-->
                            <div class="col-6">
                                <div class="fw-bold mt-5">Alamat Email</div>
                                <div class="text-gray-600">
                                    {{ $data->email }}
                                </div>
                            </div>
                            <!--end::Details item-->

                            <!--begin::Details item-->
                            <div class="col-6">
                                <div class="fw-bold mt-5">Nomor Telepon</div>
                                <div class="text-gray-600">
                                    @if ($data->telepon == null)
                                        <span>
                                            Belum Ditambahkan
                                        </span>
                                    @else
                                        {{ $data->telepon }}
                                    @endif
                                </div>
                            </div>
                            <!--end::Details item-->

                            <!--begin::Details item-->
                            <div class="col-12">
                                <div class="fw-bold mt-5">Alamat</div>
                                <div class="text-gray-600">
                                    @if ($data->alamat == null)
                                        <span>
                                            Alamat Belum Ditambahkan
                                        </span>
                                    @else
                                        {{ $data->alamat }}
                                    @endif
                                </div>
                            </div>
                            <!--end::Details item-->
                        </div>
                        <hr>
                        <div class="row">
                            <!--begin::Details item-->
                            <div class="col-6">
                                <div class="fw-bold mt-5">Username</div>
                                <div class="text-gray-600">
                                    @foreach ($users as $user)
                                        @if ($data->nama == $user->name)
                                            <span class="badge badge-dark">
                                                {{ $user->username }}
                                            </span>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                            <!--end::Details item-->

                            <!--begin::Details item-->
                            <div class="col-6">
                                <div class="fw-bold mt-5">Kata Sandi</div>
                                <div class="text-gray-600">
                                    Lupa Kata Sandi? <a href="javascript:void(0);" class="menu-link"
                                        data-bs-toggle="modal" data-bs-target="#modal_password{{ $mahasiswa->id }}">Klik
                                        Disini</a>
                                </div>
                            </div>
                            <!--end::Details item-->
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">
                            Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!--end::Modal Lihat Detail-->
@endsection

@push('custom-javascript')
    <script src="assets/js/custom/apps/user-management/permissions/list.js"></script>
    <script src="assets/js/custom/apps/user-management/permissions/add-permission.js"></script>
    <script src="assets/js/custom/apps/user-management/permissions/update-permission.js"></script>
@endpush
