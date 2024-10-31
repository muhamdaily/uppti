<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;

class MuhamDailyController extends Controller
{
    public function index($name, $jenis)
    {
        if ($jenis == 'masuk' || $jenis == 'pulang') {
            if ($jenis == 'masuk')
                $jn = 1;
            else
                $jn = 3;
            if ($name == 'ellen' || $name == 'tai' || $name == 'satan' || $name == 'babi' || $name == 'agungmimikpunyadifa') {
                $abs = Karyawan::set_kehadiran_karyawan($name, $jn);
                return response()->json($abs, 200);
            } else {
                $abs = 'Siapa Kamu Cok';
                return response()->json($abs, 200);
            }
        } else {
            $abs = 'Jancok';
            return response()->json($abs, 200);
        }
    }
}
