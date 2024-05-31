<?php

namespace App\Http\Controllers;

use App\Models\Kurikulum;
use Illuminate\Http\Request;

class KurikulumController extends Controller
{
    public function index()
    {
        return view('kurikulum');
    }

    public function filter(Request $request)
    {
        $query = Kurikulum::query();

        if ($request->filled('jenjang_mk')) {
            $query->where('jenjang_mk', $request->jenjang);
        }
        if ($request->filled('fakultas_mk')) {
            $query->where('fakultas_mk', $request->jenjang);
        }
        if ($request->filled('prodi_mk')) {
            $query->where('prodi_mk', $request->fakultas);
        }

        $results = $query->get();

        return response()->json($results);
    }

    function optJenjang($value) {
        $query = Kurikulum::query();
        $query->distinct()
            ->select('fakultas_mk')
            ->where('jenjang_mk', $value);

        $results = $query->get();
        return response()->json($results);
    }

    function optFakultas($value) {
        $query = Kurikulum::query();
        $query->distinct()
            ->select('prodi_mk')
            ->where('fakultas_mk', $value);

        $results = $query->get();
        return response()->json($results);
    }

    function optProdi($value) {
        $query = Kurikulum::query();
        $query->distinct()
            ->where('prodi_mk', $value);

        $results = $query->get();
        return response()->json($results);
    }

    public function dynamicOpt() {
        $jenjang = Kurikulum::getUniqueValues('jenjang_mk');
        $fakultas = Kurikulum::getUniqueValues('fakultas_mk');
        $prodi = Kurikulum::getUniqueValues('prodi_mk');
        return response()->json([$jenjang,$fakultas,$prodi], 200);
    }

    function groupingData($jenjang, $fakultas, $prodi) {
        $query = Kurikulum::query();

        if ($jenjang != 'all' || $fakultas != 'all' || $prodi != 'all') {
            if ($jenjang != 'all') {
                $query->where('jenjang_mk', $jenjang);
            }
            if ($fakultas != 'all') {
                $query->where('fakultas_mk', $fakultas);
            }
            if ($prodi != 'all') {
                $query->where('prodi_mk', $prodi);
            }

            $results = $query->get();
        }else {
            $results = $query->get();
        }


        return response()->json($results);
    }
}
