@extends('layouts.app')

@section('title', 'Permission Detail')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-social/assets/css/bootstrap.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Detail</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="homw">Dashboard</a></div>
                    <div class="breadcrumb-item">Permission Detail</div>
                </div>
            </div>
            <div class="section-body">
                <h2 class="section-title">Detail Perizinan</h2>
                <p class="section-lead">
                    Informasi tentang detail izin karyawan.
                </p>

                <div class="row mt-sm-4">
                    <div class="col-12 col-md-12 col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Nama Karyawan</label>
                                        <p>{{ $permission->user->name }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Telpon Karyawan</label>
                                        <p>{{ $permission->user->phone }}</p>
                                    </div>

                                </div>
                                <div class="row">

                                    <div class="form-group col-md-6 col-12">
                                        <label>Department</label>
                                        <p>{{ $permission->user->department }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Tanggal Izin</label>
                                        <p>{{ $permission->date_permission }}</p>
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Alasan</label>
                                        <p>{{ $permission->reason }}</p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6 col-12">
                                        <label>Bukti Dukung</label>
                                        @if ($permission->image)
                                            <!-- Jika image tersedia, tampilkan gambar -->
                                            <div>
                                                <img src="{{ asset('storage/permissions/' . $permission->image) }}"
                                                    alt="Bukti Dukung" class="img-thumbnail mb-3" style="max-width: 200px;">
                                            </div>
                                        @else
                                            <!-- Jika image kosong, tampilkan teks -->
                                            <p>Tidak ada bukti dukung</p>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 col-12">
                                        <label>Persetujuan</label>
                                        <p>
                                            @if ($permission->is_approved == 1)
                                                Disetujui
                                            @else
                                                Tidak Disetujui
                                            @endif
                                        </p>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary">Edit Perizinan</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraries -->
    <script src="{{ asset('library/summernote/dist/summernote-bs4.js') }}"></script>

    <!-- Page Specific JS File -->
@endpush
