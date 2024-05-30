<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DefaultController extends Controller
{
    public function index()
    {
        $angkatan = Mahasiswa::getUniqueValues('angkatan_mhs');
        $jenjang = Mahasiswa::getUniqueValues('jenjang_mhs');
        $fakultas = Mahasiswa::getUniqueValues('fakultas_mhs');
        $prodi = Mahasiswa::getUniqueValues('prodi_mhs');

        return view('app', compact('angkatan'));
    }

    public function filter(Request $request)
    {
        $query = Mahasiswa::query();

        if ($request->filled('angkatan')) {
            $query->where('angkatan_mhs', '<=', $request->angkatan);
        }
        if ($request->filled('jenjang')) {
            $query->where('jenjang_mhs', $request->jenjang);
        }
        if ($request->filled('fakultas')) {
            $query->where('fakultas_mhs', $request->fakultas);
        }
        if ($request->filled('prodi')) {
            $query->where('prodi_mhs', $request->prodi);
        }

        $results = $query->get();

        return response()->json($results);
    }

    public function getData(Request $request)
    {
        $year = $request->input('angkatan', 2023);
        $jenjang = $request->input('jenjang', null);
        $fakultas = $request->input('fakultas', null);
        $prodi = $request->input('prodi', null);

        $query = Mahasiswa::select('*')
                        ->where('angkatan_mhs', '<=', $year-1);

        if ($jenjang != null && $jenjang != 'all') {
            $query->where('jenjang_mhs', $jenjang);
        }

        if ($fakultas != null && $fakultas != 'all') {
            $query->where('fakultas_mhs', $fakultas);
        }

        if ($prodi != null && $prodi != 'all') {
            $query->where('prodi_mhs', $prodi);
        }

        $data = $query->get();
        $count = $data->count();


        return response()->json(['total'=> $count,'data' => $data]);
    }

    public function optJenjang($value)
    {
        $data = Mahasiswa::optionFakultas($value);
        return response()->json($data, 200);
    }

    public function optFakultas($value)
    {
        $data = Mahasiswa::optionProdi($value);
        return response()->json($data, 200);
    }

    public function dynamicOpt() {
        $jenjang = Mahasiswa::getUniqueValues('jenjang_mhs');
        $fakultas = Mahasiswa::getUniqueValues('fakultas_mhs');
        $prodi = Mahasiswa::getUniqueValues('prodi_mhs');
        return response()->json([$jenjang,$fakultas,$prodi], 200);
    }


}
