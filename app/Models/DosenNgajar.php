<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DosenNgajar extends Model
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
}
