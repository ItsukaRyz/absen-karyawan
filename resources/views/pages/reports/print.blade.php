    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Laporan Absensi</title>
        <style>
            @page {
                size: A4 landscape;
                margin: 10mm;
            }
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
            }
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 0;
                padding: 0;
            }
            th, td {
                border: 1px solid black;
                padding: 5px;
                text-align: center;
                font-size: 10px;
            }
            th {
                background-color: #f2f2f2;
            }
            h2 {
                text-align: center;
                margin: 0;
                padding: 10px;
                font-size: 14px;
            }
            .no-data {
                text-align: center;
                font-style: italic;
            }
        </style>
    </head>
    <body>
        <h2>REKAP ABSENSI KARYAWAN BULAN {{ $month }} TAHUN {{ $year }}
            <br><center> PT ADINA MULTI WAHANA</center></br></h2>
        <table>
            <thead>
                <tr>
                    <th>Nama Karyawan</th>
                    @for($d = 1; $d <= $daysInMonth; $d++)
                        <th>{{ $d }}</th>
                    @endfor
                    <th>Total Absen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    @php
                        $totalAbsensi = 0;
                    @endphp
                    <tr>
                        <td>{{ $user->name }}</td>
                        @for($d = 1; $d <= $daysInMonth; $d++)
                            @php
                                $date = $year . '-' . str_pad($month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($d, 2, '0', STR_PAD_LEFT);
                                $attendance = $attendances->where('user_id', $user->id)->where('date', $date)->first();
                                $present = $attendance ? 1 : 0;
                                $totalAbsensi += $present;
                            @endphp
                            <td>{{ $present }}</td>
                        @endfor
                        <td>{{ $totalAbsensi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </body>
    </html>
