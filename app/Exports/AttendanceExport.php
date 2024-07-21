<?php

namespace App\Exports;

use App\Models\User;
use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendanceExport implements FromCollection, WithHeadings, WithStyles, WithTitle
{
    protected $month;
    protected $year;
    protected $daysInMonth;

    public function __construct($month, $year, $daysInMonth)
    {
        $this->month = $month;
        $this->year = $year;
        $this->daysInMonth = $daysInMonth;
    }

    public function collection()
    {
        $users = User::orderBy('name', 'asc')->get();
        $attendances = Attendance::whereMonth('date', $this->month)->whereYear('date', $this->year)->get();

        $data = [];

        foreach ($users as $user) {
            $totalAbsensi = 0;
            $row = [$user->name];

            for ($d = 1; $d <= $this->daysInMonth; $d++) {
                $date = $this->year . '-' . str_pad($this->month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($d, 2, '0', STR_PAD_LEFT);
                $attendance = $attendances->where('user_id', $user->id)->where('date', $date)->first();
                $present = $attendance ? 1 : 0;
                $row[] = $present;
                $totalAbsensi += $present;
            }

            $row[] = $totalAbsensi;
            $data[] = $row;
        }

        return collect($data);
    }

    public function headings(): array
    {
        $headings = ['Nama Karyawan'];
        for ($d = 1; $d <= $this->daysInMonth; $d++) {
            $headings[] = $d;
        }
        $headings[] = 'Total Absen';

        return $headings;
    }

    public function styles(Worksheet $sheet)
{
    $sheet->getStyle('A1:AG1')->getFont()->setBold(true);
    $sheet->getStyle('A1:AG1')->getFill()->setFillType(Fill::FILL_SOLID)
        ->getStartColor()->setARGB('ADD8E6');
    $sheet->getStyle('A1:AG1')->getAlignment()->setHorizontal('center');
    $sheet->getStyle('A')->getAlignment()->setHorizontal('left');

    // Set number format for columns with numeric data
    $sheet->getStyle('A2:AG' . $sheet->getHighestRow())->getNumberFormat()->setFormatCode('#,##0');

    // Set borders for the whole sheet
    $styleArray = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['argb' => 'FF000000'], // Black border
            ],
        ],
    ];
    $sheet->getStyle('A1:AG' . $sheet->getHighestRow())->applyFromArray($styleArray);

    // Set auto width for columns
    foreach (range('A', 'AG') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    return [
        // Add more style options if needed
    ];
}



    public function title(): string
    {
        return 'Laporan Absensi';
    }
}
