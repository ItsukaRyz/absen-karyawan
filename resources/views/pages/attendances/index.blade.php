@extends('layouts.app')

@section('title', 'Attendances')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Absensi Karyawan</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="home">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="attendances">Absensi Karyawan</a></div>
                </div>
            </div>
            <div class="section-body">

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Semua Kehadiran</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-">
                                    <form id="searchForm" method="GET" action="{{ route('attendances.index') }}" class="d-flex">
                                        <div class="input-group me-2">
                                            <!-- Button Close -->
                                            <button type="button" id="closeButton" class="btn btn-outline-secondary" style="display: none;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <!-- Input Field -->
                                            <input type="text" id="nameInput" class="form-control" placeholder="Cari Nama" name="name">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                                            </div>
                                        </div>
                                        <div class="input-group me-2">
                                            <input type="text" class="form-control datepicker" placeholder="Select date" name="date">
                                        </div>

                                    </form>
                                </div>



                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Time In</th>
                                            <th>Time Out</th>
                                            <th>Latlong In</th>
                                            <th>Latlong Out</th>
                                            <th>Action</th>
                                        </tr>
                                        @foreach ($attendances as $attendance)
                                            <tr>
                                                <td>{{ $attendance->user->name }}</td>
                                                <td>{{ Carbon\Carbon::parse($attendance->date)->locale('id')->isoFormat('dddd, DD-MM-YYYY') }}</td>
                                                <td>{{ $attendance->time_in }}</td>
                                                <td>{{ $attendance->time_out }}</td>
                                                <td>{{ $attendance->latlong_in }}</td>
                                                <td>{{ $attendance->latlong_out }}</td>
                                                <td>
                                                    <a href="#" class="btn btn-sm btn-info btn-icon tampilkanpeta" data-id="{{ $attendance->id }}">
                                                        <i class="fa fa-map"></i> Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $attendances->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="modal modal-blur fade" id="modal-tampilkanpeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Lokasi Absen User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="loadmap">
                    <div id="map" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>

    <script>
        $(document).ready(function() {
            var map;  // Variable to store the map instance

            $('.tampilkanpeta').click(function() {
                var attendanceId = $(this).data('id');

                $.ajax({
                    url: '/attendances/' + attendanceId,
                    method: 'GET',
                    success: function(response) {
                        $('#modal-tampilkanpeta').modal('show');

                        $('#modal-tampilkanpeta').on('shown.bs.modal', function () {
                            if (map) {
                                map.remove();  // Remove the previous map instance
                            }

                            map = L.map('map').setView([response.latlong_in.lat, response.latlong_in.lng], 18);

                            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                                maxZoom: 19,
                                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                            }).addTo(map);

                            L.marker([response.latlong_in.lat, response.latlong_in.lng]).addTo(map)
                                .bindPopup('Time In Location')
                                .openPopup();

                            L.circle([-6.155660, 106.662205], {
                                color: 'red', 
                                fillColor: '#f03',
                                fillOpacity: 0.5,
                                radius: 50
                            }).addTo(map);

                            if(response.latlong_out.lat && response.latlong_out.lng) {
                                L.marker([response.latlong_out.lat, response.latlong_out.lng]).addTo(map)
                                    .bindPopup('Time Out Location')
                                    .openPopup();

                                L.circle([-6.155660, 106.662205], {
                                    color: 'red',
                                    fillColor: '#f03',
                                    fillOpacity: 0.5,
                                    radius: 50
                                }).addTo(map);
                            }

                            map.invalidateSize();  // Ensure map container resizes correctly
                        });
                    },
                    error: function() {
                        alert('Unable to fetch attendance data.');
                    }
                });
            });
        });
    </script>
@endpush
