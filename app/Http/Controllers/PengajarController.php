<?php

namespace App\Http\Controllers;

use App\Models\Pengajar;
use Illuminate\Http\Request;

class PengajarController extends Controller
{
    public function index()
    {
        return view('pengajar');
    }

    public function filter(Request $request) {
        $query = Pengajar::query();

        if ($request->input('jenjang') == 'all' || $request->input('jenjang') == null) {
            $total = Pengajar::getTotalPerJenjang()[0];
            $results = Pengajar::all();
        } else {
            [$total, $results] = Pengajar::jenjang($request->input('jenjang'));
        }

        // Memanggil fungsi prepareChartData untuk mempersiapkan data untuk chart
        $chartData = $this->prepareChartData($results);
        // dd($chartData);
        return response()->json([
            'total' => $total,
            'data' => $results,
            'chartData' => $chartData // Mengirimkan data yang sudah dipersiapkan untuk chart
        ]);
    }

    public function prepareChartData($data)
    {
        $groupedData = [];

        foreach ($data as $pengajar) {
            $namaKoordinator = $pengajar['koordinator'];
            $jumlahKelas = (int)$pengajar['d3_ngajar'] + (int)$pengajar['s1_ngajar'] + (int)$pengajar['s2_ngajar'] + (int)$pengajar['s3_ngajar'] + (int)$pengajar['profesi'];

            // Jika nama koordinator belum ada dalam array $groupedData, inisialisasi jumlah kelas dengan 0
            if (!isset($groupedData[$namaKoordinator])) {
                $groupedData[$namaKoordinator] = 0;
            }

            // Tambahkan jumlah kelas ke dalam jumlah kelas yang sudah ada untuk nama koordinator tersebut
            $groupedData[$namaKoordinator] += $jumlahKelas;
        }

        return $groupedData;
    }



}
