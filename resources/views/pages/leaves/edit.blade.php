@extends('layouts.app')

@section('title', 'Edit Cuti')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Edit Cuti</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item"><a href="{{ route('leaves.index') }}">Cuti</a></div>
                <div class="breadcrumb-item active">Edit</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Edit Cuti</h2>
            <p class="section-lead">
                Ubah informasi cuti.
            </p>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-6">
                    <div class="card">
                        <form method="POST" action="{{ route('leaves.update', $leave->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-header">
                                <h4>Form Edit Cuti</h4>
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
                                    <input type="date" name="start_date" class="form-control" value="{{ $leave->start_date }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Selesai</label>
                                    <input type="date" name="end_date" class="form-control" value="{{ $leave->end_date }}" required>
                                </div>
                                <div class="form-group">
                                    <label>Alasan</label>
                                    <textarea name="reason" class="form-control" rows="3" required>{{ $leave->reason }}</textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status</label>
                                    <select name="is_approved" class="form-control">
                                        <option value="1" {{ $leave->is_approved == 1 ? 'selected' : '' }}>Disetujui</option>
                                        <option value="0" {{ $leave->is_approved === 0 ? 'selected' : '' }}>Ditolak</option>
                                        <option value="" {{ is_null($leave->is_approved) ? 'selected' : '' }}>Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a href="{{ route('leaves.index') }}" class="btn btn-secondary">Kembali</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
