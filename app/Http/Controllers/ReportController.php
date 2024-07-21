<?php

namespace App\Http\Controllers;

use App\Exports\AttendanceExport;
use App\Models\User;
use App\Models\Attendance;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function index()
    {
        return view('pages.reports.index');
    }

    public function print(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');

        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $users = User::orderBy('name', 'asc')->get();
        $attendances = Attendance::whereMonth('date', $month)->whereYear('date', $year)->get();

        $pdf = FacadePdf::loadView('pages.reports.print', compact('users', 'attendances', 'month', 'year', 'daysInMonth'));
        return $pdf->setPaper('A4', 'landscape')->download('laporan-absensi.pdf');
    }

    public function exportExcel(Request $request)
    {
        $month = $request->input('month');
        $year = $request->input('year');
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

        return Excel::download(new AttendanceExport($month, $year, $daysInMonth), 'Laporan-Absensi.xlsx');
    }
}
