<?php

namespace App\Http\Controllers\Api;

use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    //absendatang
    public function absendatang (Request $request)
    {
        //validasi latitude & longitude
        $request->validate([
                    'latitude' => 'required',
                    'longitude' => 'required',
                ]);

                //insert ke database
                $attendance = new Attendance();
                $attendance->user_id = auth()->user()->id;
                $attendance->date = Carbon::now()->format('Y-m-d');
                $attendance->time_in = Carbon::now()->format('H:i:s');
                $attendance->latlong_in= $request->latitude . ',' . $request->longitude;
                $attendance->save();

                // Ubah format tanggal untuk ditampilkan ke pengguna
                $attendance->date = Carbon::parse($attendance->date)->locale('id')->isoFormat('dddd, DD-MM-YYYY');

                return response(['message' => 'absen datang berhasil','attendance' =>$attendance], 200);
    }
    //absen_keluar
    public function absenpulang (Request $request)
    {
        //validasi latitude & longitude
        $request->validate([
                    'latitude' => 'required',
                    'longitude' => 'required',
                 ]);
                //insert ke database
                $attendance = Attendance::where('user_id', auth()->user()->id)
                ->where('date', Carbon::now()->format('Y-m-d'))
                ->first();
                //mengecek jika attendance tidak ditemukan
                if (!$attendance) {
                    return response(['message' => 'absen datang terlebih dahulu'], 404);
                }
                //save absenpulang
                $attendance->time_out = Carbon::now()->format('H:i:s');
                $attendance->latlong_out= $request->latitude. ','. $request->longitude;
                $attendance->save();

                // Ubah format tanggal untuk ditampilkan ke pengguna
                $attendance->date = Carbon::parse($attendance->date)->locale('id')->isoFormat('dddd, DD-MM-YYYY');

                return response(['message' => 'absen pulang berhasil','attendance' =>$attendance,], 200);


    }
    //absen jika sudah absen
    public function isCheckedin (Request $request)
    {
        //get absen hari ini
        $attendance = Attendance::where('user_id', auth()->user()->id)
        ->where('date', Carbon::now()->format('Y-m-d'))
        ->first();

         // Ubah format tanggal untuk ditampilkan ke pengguna
         $attendance->date = Carbon::parse($attendance->date)->locale('id')->isoFormat('dddd, DD-MM-YYYY');

         return response(['chckedin' => $attendance ? true : false], 200);
    }
}
