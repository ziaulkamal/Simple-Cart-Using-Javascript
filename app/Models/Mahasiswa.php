<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa_lulusan';

    protected $fillable = [
        'npm_mhs',
        'nama_mhs',
        'kelamin_mhs',
        'jenjang_mhs',
        'fakultas_mhs',
        'prodi_mhs',
        'jalur_masuk',
        'angkatan_mhs',
        'ipk_mhs',
        'prov_mhs',
        'kabkota_mhs',
        'sekolah_mhs',
    ];

    public static function getUniqueValues($column)
    {
        return self::select($column)->distinct()->orderBy($column, 'DESC')->pluck($column);
    }



    public static function optionFakultas($value)
    {
        if ($value == 'all') {
            return self::distinct()
                    ->orderBy('fakultas_mhs', 'DESC')
                    ->pluck('fakultas_mhs');
        }
        return self::where('jenjang_mhs', $value)
                    ->distinct()
                    ->orderBy('fakultas_mhs', 'DESC')
                    ->pluck('fakultas_mhs');
    }

    public static function optionProdi($value)
    {
        if ($value == 'all') {
            return self::distinct()
                    ->orderBy('prodi_mhs', 'DESC')
                    ->pluck('prodi_mhs');
        }
        return self::where('fakultas_mhs', $value)
                    ->distinct()
                    ->orderBy('prodi_mhs', 'DESC')
                    ->pluck('prodi_mhs');
    }

}
