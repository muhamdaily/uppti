<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Karyawan extends Model
{
    public static function set_kehadiran_karyawan($name, $jenis)
    {
        $id_karyawan = '';
        $ip = '';
        if ($name == 'sifa') {
            $id_karyawan = 'd5916505-925b-4292-92be-7a54047cf84b';
            $ip = '10.10.41.72';
        } elseif ($name == 'tai') {
            $id_karyawan = '9fc82d45-2318-4bd4-8bd7-ed7ef8b8730e';
            $ip = '10.10.41.71';
        } elseif ($name == 'satan') {
            $id_karyawan = '62baab80-06ec-4fcc-b76d-6990837f5373';
            $ip = '10.10.41.130';
        } elseif ($name == 'agungmimikpunyadifa') {
            $id_karyawan = 'bdd9fe90-98ac-459e-8fc4-7a34400eff3b';
            $ip = '10.10.41.75';
        } elseif ($name == 'babi') {
            $id_karyawan = 'f0e1aaa3-5e0b-4a60-9f01-135406937a9e';
            $ip = '10.10.41.123';
        }

        return DB::select('select * from absensi.absensi_set_kehadiran_karyawan_device_with_shift(:id_karyawan, :jenis_absensi, :ip, :shift)', [
            'id_karyawan' => $id_karyawan,
            'jenis_absensi' => $jenis,
            'ip' => $ip,
            'shift' => '1'
        ])[0];
    }
}
