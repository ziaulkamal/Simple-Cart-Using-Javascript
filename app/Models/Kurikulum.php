<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;


    protected $table = 'mata_kuliah';

    protected $fillable = [
        'id_mk',
        'jenjang_mk',
        'fakultas_mk',
        'prodi_mk',
        'semester_mk',
        'kode_mk',
        'mk',
        'sks_mk',
        'kpl_mk',
        'kategori_mk',
        'prasyarat_mk'
    ];

    public static function getUniqueValues($column)
    {
        return self::select($column)->distinct()->orderBy($column, 'DESC')->pluck($column);
    }

}
