@extends('layouts.app')

@section('title', 'Leaves')

@push('style')
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Cuti</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Cuti</h2>
                <p class="section-lead">Anda dapat mengelola semua cuti karyawan.</p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Semua Cuti</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('leaves.index') }}">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Nama</th>
                                            <th>Department</th>
                                            <th>Tanggal Cuti</th>
                                            <th class="text-center">Persetujuan</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                        @foreach ($leaves as $leave)
                                            <tr>
                                                <td>{{ $leave->user->name }}</td>
                                                <td>{{ $leave->user->department }}</td>
                                                <td>{{ \Carbon\Carbon::parse($leave->date_leave)->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}</td>
                                                <td>
                                                    <div style="text-align: center">
                                                        @if($leave->is_approved == 1)
                                                            <button class="btn btn-success" style="width: 100%">Disetujui</button>
                                                        @elseif($leave->is_approved == 0)
                                                            <button class="btn btn-danger" style="width: 100%">Tidak Disetujui</button>
                                                        @else
                                                            <button class="btn btn-warning" style="width: 100%">Pending</button>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('leaves.show', $leave->id) }}' class="btn btn-sm btn-info btn-icon">
                                                            <i class="fas fa-edit"></i>
                                                            Detail
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $leaves->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
