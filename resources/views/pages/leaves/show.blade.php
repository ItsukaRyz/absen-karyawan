@extends('layouts.app')

@section('title', 'Detail Cuti')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Cuti</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('leaves.index') }}">Cuti</a></div>
                <div class="breadcrumb-item active">Detail</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Detail Cuti</h2>
            <p class="section-lead">
                Informasi lengkap mengenai cuti.
            </p>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Informasi Cuti</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{ $leave->user->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Department</label>
                                <input type="text" class="form-control" value="{{ $leave->user->department }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Mulai</label>
                                <input type="text" class="form-control" value="{{ $leave->start_date }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Selesai</label>
                                <input type="text" class="form-control" value="{{ $leave->end_date }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Alasan</label>
                                <textarea class="form-control" rows="3" disabled>{{ $leave->reason }}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Status</label>
                                <input type="text" class="form-control" value="{{ $leave->is_approved == 1 ? 'Disetujui' : ($leave->is_approved === 0 ? 'Ditolak' : 'Pending') }}" disabled>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <a href="{{ route('leaves.index') }}" class="btn btn-primary">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
