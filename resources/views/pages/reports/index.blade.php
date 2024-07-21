@extends('layouts.app')

@section('title', 'Reports')

@section('main')
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Laporan</h1>
        </div>
        <div class="section-body">
            <form action="{{ route('reports.print') }}" method="POST" style="display:inline;">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="month">Bulan</label>
                            <select name="month" id="month" class="form-control">
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <select name="year" id="year" class="form-control">
                                @for($y = date('Y'); $y >= 2000; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Cetak Laporan PDF</button>
            </form>
            <form action="{{ route('reports.exportExcel') }}" method="POST" style="display:inline;">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="month">Bulan</label>
                            <select name="month" id="month" class="form-control">
                                @for($m = 1; $m <= 12; $m++)
                                    <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0, $m, 1)) }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="year">Tahun</label>
                            <select name="year" id="year" class="form-control">
                                @for($y = date('Y'); $y >= 2000; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-success">Ekspor ke Excel</button>
            </form>
        </div>
    </section>
</div>
@endsection
