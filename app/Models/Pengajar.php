<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajar extends Model
{
    protected $table = 'data_ngajar';

    protected $fillable = [
        'id_ngajar',
        'koordinator',
        'd3_ngajar',
        's1_ngajar',
        's2_ngajar',
        's3_ngajar',
        'profesi',
    ];

    public static function getTotalPerJenjang()
    {
        // Mengambil semua data pengajar
        $data = self::all();
        $total = 0;
        $results = [];

        foreach ($data as $d) {
            $total = (int)$d->d3_ngajar + (int)$d->s1_ngajar + (int)$d->s2_ngajar + (int)$d->s3_ngajar + (int)$d->profesi;
            $results[] = $d;
        }

        return [$total, $results];
    }

    public static function jenjang($jenjang) {
        $data = self::where($jenjang, '!=', 0)->get();
        $total = 0;
        $results = [];
        foreach ($data as $d) {
            $total = (int)$d->$jenjang;
            $results[] = $d;
        }

        return [$total, $results];
    }
}
