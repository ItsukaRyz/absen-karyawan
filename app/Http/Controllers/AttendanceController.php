<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    //index
    public function index(Request $request)
    {
        $attendances = Attendance::with('user')
        ->when($request->input('name'), function ($query, $name){
            $query->whereHas('user', function ($query) use ($name){
            $query->where('name', 'like', '%'.$name.'%');
        });

        })->orderBy('id', 'desc')->paginate(10);
        return view('pages.attendances.index', compact('attendances'));

    }

    public function show($id)
{
    $attendance = Attendance::find($id);

    // Parsing latlong into separate latitude and longitude
    $latlongIn = explode(',', $attendance->latlong_in);
    $latlongOut = explode(',', $attendance->latlong_out);

    return response()->json([
        'latlong_in' => [
            'lat' => $latlongIn[0],
            'lng' => $latlongIn[1]
        ],
        'latlong_out' => [
            'lat' => $latlongOut[0] ?? null,
            'lng' => $latlongOut[1] ?? null
        ]
    ]);
}


    



}
