@extends('app', [
    'title' => 'Profil Saya',
])

@section('content')
    @include('sweetalert::alert')
    <div class="d-flex flex-column flex-column-fluid">
        <!--end::Toolbar-->
        <!--begin::Content-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-fluid">

                <!--begin::info akun-->
                <div class="card mb-5 mt-19 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">
                                Pengaturan Profil Saya
                            </h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form class="form" action="#" method="POST">
                            @csrf
                            @method('patch')
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <div class="row">
                                    @if (auth()->user()->role == 'admin')
                                        <!--begin::Nama Lengkap-->
                                        <div class="col-lg-4 mb-7">
                                            <div class="form-group">
                                                <label for="name" class="form-label">
                                                    Nama Lengkap <span class="required"></span>
                                                </label>

                                                <input type="text" name="name" id="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Nama Lengkap" value="{{ auth()->user()->name }}">

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end::Nama Lengkap-->

                                        <!--begin::Username-->
                                        <div class="col-lg-4 mb-7">
                                            <div class="form-group">
                                                <label for="username" class="form-label">
                                                    Username <span class="required"></span>
                                                </label>

                                                <input type="text" name="username" id="username"
                                                    class="form-control @error('username') is-invalid @enderror"
                                                    placeholder="Email" value="{{ auth()->user()->username }}">

                                                @error('username')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end::Username-->

                                        <!--begin::Email-->
                                        <div class="col-lg-4 mb-7">
                                            <div class="form-group">
                                                <label for="email" class="form-label">
                                                    Email <span class="required"></span>
                                                </label>

                                                <input type="text" name="email" id="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Email" value="{{ auth()->user()->email }}">

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end::Email-->
                                    @else
                                        <!--end::NIM-->
                                        <div class="col-lg-6 mb-7">
                                            <div class="form-group">
                                                <label for="nim" class="form-label">
                                                    NIM Mahasiswa
                                                </label>

                                                <input type="text" name="nim" id="nim"
                                                    class="form-control @error('nim') is-invalid @enderror"
                                                    @foreach ($datas as $data)
                                                        @if ($data->nama == auth()->user()->name)
                                                            value="{{ $data->nim }}"
                                                        @endif @endforeach
                                                    readonly>

                                                @error('nim')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end::NIM-->

                                        <div class="col-lg-6 mb-7">
                                            <div class="form-group">
                                                <label for="name" class="form-label">
                                                    Nama Lengkap <span class="required"></span>
                                                </label>

                                                <input type="text" name="name" id="name"
                                                    class="form-control @error('name') is-invalid @enderror"
                                                    placeholder="Nama Lengkap" value="{{ auth()->user()->name }}">

                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-lg-12 mb-7">
                                            <div class="form-group">
                                                <label for="prodi" class="form-label">
                                                    Program Studi
                                                </label>

                                                <input type="text" name="prodi" id="prodi"
                                                    class="form-control @error('prodi') is-invalid @enderror"
                                                    value="{{ auth()->user()->prodi }}" readonly>

                                                @error('prodi')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif

                                    {{-- <div class="col-lg-5 mb-7">
                                        <div class="form-group">
                                            <label for="date_of_birth" class="form-label">
                                                Tanggal Lahir
                                            </label>

                                            <input type="text" name="birthday" id="date_of_birth"
                                                class="form-control @error('date_of_birth') is-invalid @enderror"
                                                placeholder="Tanggal Lahir"
                                                value="{{ old('date_of_birth', $user->date_of_birth) }}">

                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-lg-4 mb-7">
                                        <div class="form-group w-100">
                                            <label for="subdistrict" class="form-label">
                                                Alamat <span class="required"></span>
                                            </label>

                                            <select name="province_id" id="provinsi"
                                                class="form-select @error('province_id') is-invalid @enderror"
                                                data-control="select2" data-placeholder="Pilih Provinsi">
                                                <option value="">Pilih Provinsi</option>
                                                @foreach ($provinsi as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $selectedProvinsi == $item->id ? 'selected' : '' }}>
                                                        {{ $item->name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('province_id')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-lg-6 mb-7">
                                        <div class="form-group">
                                            <label for="username" class="form-label">
                                                Alamat Email <span class="required"></span>
                                            </label>

                                            <input type="text" name="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="Alamat Email" value="{{ old('name', $user->email) }}">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-lg-6 mb-7">
                                        <div class="form-group">
                                            <label for="username" class="form-label">
                                                Username <span class="required"></span>
                                            </label>

                                            <input type="text" name="username" id="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="Username" value="{{ old('name', $user->username) }}">

                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                    {{-- <div class="col-lg-12 mb-7">
                                        <div class="form-group">
                                            <label for="whatsapp" class="form-label">
                                                WhatsApp
                                            </label>

                                            <div class="input-group">
                                                <span class="input-group-text">(+62)</span>
                                                <input type="number" name="phone" id="phone"
                                                    class="form-control @error('phone') is-invalid @enderror"
                                                    placeholder="85xx-xxxx-xxxx" value="{{ old('phone', $user->phone) }}">
                                            </div>
                                            <small class="text-gray-600 d-block">
                                                * Note: Masukkan nomor WhatsApp tanpa angka 0 di depannya.
                                            </small>

                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}

                                </div>
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-sm btn-info" id="kt_account_profile_details_submit">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::info akun-->

                <!--begin::password akun-->
                <div class="card mb-5 mb-xl-10">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_profile_details" aria-expanded="true"
                        aria-controls="kt_account_profile_details">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Pengaturan Kata Sandi</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_profile_details" class="collapse show">
                        <!--begin::Form-->
                        <form class="form" action="#" method="POST">
                            @csrf
                            @method('put')
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Main wrapper-->
                                <div class="row">
                                    <!--begin::Wrapper-->
                                    <div class="col-lg-12 mb-7">
                                        <div class="form-group">
                                            <!--begin::Label-->
                                            <label class="form-label required">
                                                Kata Sandi Saat Ini
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input wrapper-->
                                            <input class="form-control @error('current_password') is-invalid @enderror"
                                                type="password" name="current_password"
                                                autocomplete="current-password" />

                                            @error('current_password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <!--end::Input wrapper-->
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-7">
                                        <div class="form-group">
                                            <!--begin::Label-->
                                            <label class="form-label required">
                                                Kata Sandi
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input wrapper-->
                                            <input class="form-control @error('password') is-invalid @enderror"
                                                type="password" name="password" autocomplete="off" />

                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <!--end::Input wrapper-->
                                        </div>
                                    </div>

                                    <div class="col-lg-6 mb-7">
                                        <div class="form-group">
                                            <!--begin::Label-->
                                            <label class="form-label required">
                                                Konfirmasi Kata Sandi
                                            </label>
                                            <!--end::Label-->

                                            <!--begin::Input wrapper-->
                                            <input
                                                class="form-control @error('password_confirmation') is-invalid @enderror"
                                                type="password" name="password_confirmation"
                                                autocomplete="current-password" />

                                            @error('password_confirmation')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <!--end::Input wrapper-->
                                        </div>
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Main wrapper-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Actions-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button type="submit" class="btn btn-sm btn-info"
                                    id="kt_account_profile_details_submit">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                            </div>
                            <!--end::Actions-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::password akun-->

                {{-- <!--begin::Delete Account-->
                <div class="card">
                    <!--begin::Card header-->
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                        data-bs-target="#kt_account_deactivate" aria-expanded="true"
                        aria-controls="kt_account_deactivate">
                        <div class="card-title m-0">
                            <h3 class="fw-bold m-0">Delete Account</h3>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Content-->
                    <div id="kt_account_settings_deactivate" class="collapse show">
                        <!--begin::Form-->
                        <form id="kt_account_deactivate_form" class="form" action="{{ route('profile.destroy') }}"
                            method="POST">
                            @csrf
                            @method('DELETE')
                            <!--begin::Card body-->
                            <div class="card-body border-top p-9">
                                <!--begin::Notice-->
                                <div
                                    class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                                    <!--begin::Icon-->
                                    <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                    <!--end::Icon-->
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-stack flex-grow-1">
                                        <!--begin::Content-->
                                        <div class="fw-semibold">
                                            <h4 class="text-gray-900 fw-bold">Delete Account?</h4>
                                            <div class="fs-6 text-gray-700">
                                                Once your account is deleted, all of its resources and data will be
                                                permanently deleted. Before deleting your account, please download any data
                                                or information that you wish to retain.
                                            </div>
                                        </div>
                                        <!--end::Content-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <!--end::Notice-->
                                <!--begin::Form input row-->
                                <div class="form-check form-check-solid fv-row">
                                    <input name="deactivate" class="form-check-input" type="checkbox" value="1"
                                        id="deactivate" />
                                    <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">I confirm my
                                        account deactivation</label>
                                </div>
                                <!--end::Form input row-->
                            </div>
                            <!--end::Card body-->
                            <!--begin::Card footer-->
                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <button id="kt_account_deactivate_account_submit" type="submit"
                                    class="btn btn-danger fw-semibold">Delete Account</button>
                            </div>
                            <!--end::Card footer-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Content-->
                </div>
                <!--end::Delete Account--> --}}


            </div>
            <!--end::Content container-->
        </div>
        <!--end::Content-->
    </div>
@endsection

@push('custom-javascript')
    <script>
        $("#date_of_birth").flatpickr({
            dateFormat: "d-m-Y",
        });
    </script>
@endpush
