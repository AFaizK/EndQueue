<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pengunjung;
use App\Models\Antrian;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dataPengunjungPerHari()
    {
         // Mengambil data pengunjung dari database
         $pengunjungs = Pengunjung::all();

         // Menginisialisasi array untuk menyimpan jumlah pengunjung per hari
         $dataPerDay = [];

         // Menghitung jumlah pengunjung per hari
         foreach ($pengunjungs as $pengunjung) {
             $tanggal = Carbon::parse($pengunjung->created_at)->toDateString();
             if (array_key_exists($tanggal, $dataPerDay)) {
                 $dataPerDay[$tanggal]++;
             } else {
                 $dataPerDay[$tanggal] = 1;
             }
         }

         // Menginisialisasi array untuk menyimpan data yang sesuai dengan format yang diperlukan untuk chart
         $chartData = [
             'labels' => [],
             'data' => []
         ];

         // Mengisi array dengan data yang sesuai dengan format chart
         foreach ($dataPerDay as $tanggal => $jumlah) {
             $chartData['labels'][] = $tanggal;
             $chartData['data'][] = $jumlah;
         }

         return response()->json($chartData);
    }

    public function dataPengunjungPerBulan()
    {
        // Mengambil data pengunjung dari database
        $pengunjungs = Pengunjung::all();

        // Menginisialisasi array untuk menyimpan jumlah pengunjung per bulan
        $dataPerMonth = [];

        // Menghitung jumlah pengunjung per bulan
        foreach ($pengunjungs as $pengunjung) {
            $bulan = Carbon::parse($pengunjung->created_at)->format('Y-m');
            if (array_key_exists($bulan, $dataPerMonth)) {
                $dataPerMonth[$bulan]++;
            } else {
                $dataPerMonth[$bulan] = 1;
            }
        }

        // Menginisialisasi array untuk menyimpan data yang sesuai dengan format yang diperlukan untuk chart
        $chartData = [
            'labels' => [],
            'data' => []
        ];

        // Mengisi array dengan data yang sesuai dengan format chart
        foreach ($dataPerMonth as $bulan => $jumlah) {
            $chartData['labels'][] = Carbon::parse($bulan)->format('F Y');
            $chartData['data'][] = $jumlah;
        }

        return response()->json($chartData);
    }

    public function dataAntrianPerHari()
    {
            // Mengambil data pengunjung dari database dan mengurutkannya berdasarkan tanggal
        $antrian = Antrian::with('layanan.instansi')->orderBy('tanggal_antrian')->get();

        // Menginisialisasi array untuk menyimpan jumlah pengunjung per hari berdasarkan nama instansi
        $dataPerDayByInstansi = [];

        // Menghitung jumlah pengunjung per hari berdasarkan nama instansi
        foreach ($antrian as $antrianItem) {
            $tanggal = Carbon::parse($antrianItem->tanggal_antrian)->toDateString();
            $instansi = $antrianItem->layanan->instansi->nama_instansi;

            // Jika belum ada data untuk instansi tersebut pada tanggal tersebut, inisialisasikan dengan 0
            if (!isset($dataPerDayByInstansi[$instansi][$tanggal])) {
                $dataPerDayByInstansi[$instansi][$tanggal] = 0;
            }

            $dataPerDayByInstansi[$instansi][$tanggal]++;
        }

        // Menginisialisasi array untuk menyimpan data yang sesuai dengan format yang diperlukan untuk chart
        $chartData = [
            'labels' => [],
            'datasets' => []
        ];

        // Mengisi array dengan data yang sesuai dengan format chart
        foreach ($dataPerDayByInstansi as $instansi => $dataPerDay) {
            $dataset = [
                'label' => $instansi,
                'data' => [],
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1
            ];

            foreach ($dataPerDay as $tanggal => $jumlah) {
                $chartData['labels'][] = $tanggal;
                $dataset['data'][] = $jumlah;
            }

            $chartData['datasets'][] = $dataset;
        }

        return response()->json($chartData);


    }
    public function dataAntrianPerBulan()
    {
      // Mengambil data antrian dari database
        $antrians = Antrian::with('layanan.instansi')->get();

        // Menginisialisasi array untuk menyimpan jumlah antrian per bulan berdasarkan nama instansi
        $dataPerMonthByInstansi = [];

        // Menghitung jumlah antrian per bulan berdasarkan nama instansi
        foreach ($antrians as $antrian) {
            $bulan = Carbon::parse($antrian->tanggal_antrian)->format('Y-m');
            $instansi = $antrian->layanan->instansi->nama_instansi;

            // Jika belum ada data untuk instansi tersebut pada bulan tersebut, inisialisasikan dengan 0
            if (!isset($dataPerMonthByInstansi[$instansi][$bulan])) {
                $dataPerMonthByInstansi[$instansi][$bulan] = 0;
            }

            $dataPerMonthByInstansi[$instansi][$bulan]++;
        }

        // Menginisialisasi array untuk menyimpan data yang sesuai dengan format yang diperlukan untuk chart
        $chartData = [
            'labels' => [],
            'datasets' => []
        ];

        // Mengisi array dengan data yang sesuai dengan format chart
        foreach ($dataPerMonthByInstansi as $instansi => $dataPerMonth) {
            $dataset = [
                'label' => $instansi,
                'data' => [],
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1
            ];

            foreach ($dataPerMonth as $bulan => $jumlah) {
                $chartData['labels'][] = Carbon::parse($bulan)->format('F Y');
                $dataset['data'][] = $jumlah;
            }

            $chartData['datasets'][] = $dataset;
        }

        return response()->json($chartData);

    }


    public function dataCardHarian()
    {
        // Mendapatkan tanggal hari ini
        $tanggalHariIni = now()->toDateString();

        // Mengambil data antrian dari database dengan melakukan join dengan tabel layanan dan instansi
        $antrians = Antrian::join('layanans', 'antrians.id_layanan', '=', 'layanans.id')
            ->join('instansis', 'layanans.id_instansi', '=', 'instansis.id')
            ->select('antrians.*', 'layanans.nama_layanan', 'instansis.nama_instansi')
            ->whereDate('antrians.tanggal_antrian', $tanggalHariIni)
            ->get();

        // Menginisialisasi array untuk menyimpan jumlah antrian per hari, instansi, dan layanan
        $dataPerDay = [];

        // Menghitung jumlah antrian per hari, instansi, dan layanan
        foreach ($antrians as $antrian) {
            $tanggal = Carbon::parse($antrian->tanggal_antrian)->toDateString();
            $instansi = $antrian->nama_instansi;
            $layanan = $antrian->nama_layanan;

            // Membuat kunci untuk array dengan menggabungkan tanggal, instansi, dan layanan
            $key = $tanggal . '|' . $instansi . '|' . $layanan;

            // Jika belum ada data untuk kunci tersebut, inisialisasikan dengan 0
            if (!isset($dataPerDay[$key])) {
                $dataPerDay[$key] = 0;
            }

            $dataPerDay[$key]++;
        }

        // Menginisialisasi array untuk menyimpan data yang sesuai dengan format yang diperlukan untuk card
        $cardData = [];

        // Mengisi array dengan data yang sesuai dengan format card
        foreach ($dataPerDay as $key => $jumlah) {
            // Memisahkan kunci menjadi tanggal, instansi, dan layanan
            list($tanggal, $instansi, $layanan) = explode('|', $key);

            // Menambahkan data ke array cardData
            $cardData[] = [
                'tanggal' => $tanggal,
                'instansi' => $instansi,
                'layanan' => $layanan,
                'jumlah_antrian' => $jumlah
            ];
        }

        return response()->json($cardData);
    }


public function dataLayananPerBulan()
{
    $antrians = Antrian::join('layanans', 'antrians.id_layanan', '=', 'layanans.id')
    ->join('instansis', 'layanans.id_instansi', '=', 'instansis.id')
    ->select('antrians.*', 'layanans.nama_layanan', 'instansis.nama_instansi')
    ->get();

    // Menginisialisasi array untuk menyimpan jumlah antrian per bulan, layanan, dan instansi
    $dataPerMonth = [];

    // Menghitung jumlah antrian per bulan, layanan, dan instansi
    foreach ($antrians as $antrian) {
    $bulan = Carbon::parse($antrian->tanggal_antrian)->format('Y-m');
    $layanan = $antrian->nama_layanan;
    $instansi = $antrian->nama_instansi;

    // Membuat kunci untuk array dengan menggabungkan bulan, layanan, dan instansi
    $key = $bulan . '|' . $layanan . '|' . $instansi;

    // Jika belum ada data untuk kunci tersebut, inisialisasikan dengan 0
    if (!isset($dataPerMonth[$key])) {
    $dataPerMonth[$key] = 0;
    }

    $dataPerMonth[$key]++;
    }

    // Menginisialisasi array untuk menyimpan data yang sesuai dengan format yang diperlukan untuk chart
    $chartData = [
    'labels' => [],
    'datasets' => []
    ];

    // Mengisi array dengan data yang sesuai dengan format chart
    foreach ($dataPerMonth as $key => $jumlah) {
    // Memisahkan kunci menjadi bulan, layanan, dan instansi
    list($bulan, $layanan, $instansi) = explode('|', $key);

    // Menambahkan label jika belum ada di array labels
    if (!in_array($bulan, $chartData['labels'])) {
    $chartData['labels'][] = $bulan;
    }

    // Mencari indeks dataset untuk layanan dan instansi yang sesuai
    $datasetIndex = array_search($layanan . ' - ' . $instansi, array_column($chartData['datasets'], 'label'));

    // Jika dataset untuk layanan dan instansi tersebut belum ada, tambahkan dataset baru
    if ($datasetIndex === false) {
    $chartData['datasets'][] = [
    'label' => $layanan . ' - ' . $instansi,
    'data' => [],
    'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
    'borderColor' => 'rgba(54, 162, 235, 1)',
    'borderWidth' => 1
    ];

    $datasetIndex = count($chartData['datasets']) - 1;
    }

    // Menambahkan jumlah antrian ke dataset yang sesuai
    $chartData['datasets'][$datasetIndex]['data'][] = $jumlah;
    }

    return response()->json($chartData);

}

public function dataLayananHarian()
{
     $antrians = Antrian::join('layanans', 'antrians.id_layanan', '=', 'layanans.id')
        ->join('instansis', 'layanans.id_instansi', '=', 'instansis.id')
        ->select('antrians.*', 'layanans.nama_layanan', 'instansis.nama_instansi')
        ->get();

    // Menginisialisasi array untuk menyimpan jumlah antrian per hari, layanan, dan instansi
    $dataPerDay = [];

    // Menghitung jumlah antrian per hari, layanan, dan instansi
    foreach ($antrians as $antrian) {
        $tanggal = Carbon::parse($antrian->tanggal_antrian)->toDateString();
        $layanan = $antrian->nama_layanan;
        $instansi = $antrian->nama_instansi;

        // Membuat kunci untuk array dengan menggabungkan tanggal, layanan, dan instansi
        $key = $tanggal . '|' . $layanan . '|' . $instansi;

        // Jika belum ada data untuk kunci tersebut, inisialisasikan dengan 0
        if (!isset($dataPerDay[$key])) {
            $dataPerDay[$key] = 0;
        }

        $dataPerDay[$key]++;
    }

    // Menginisialisasi array untuk menyimpan data yang sesuai dengan format yang diperlukan untuk chart
    $chartData = [
        'labels' => [],
        'datasets' => []
    ];

    // Mengisi array dengan data yang sesuai dengan format chart
    foreach ($dataPerDay as $key => $jumlah) {
        // Memisahkan kunci menjadi tanggal, layanan, dan instansi
        list($tanggal, $layanan, $instansi) = explode('|', $key);

        // Menambahkan label jika belum ada di array labels
        if (!in_array($tanggal, $chartData['labels'])) {
            $chartData['labels'][] = $tanggal;
        }

        // Mencari indeks dataset untuk layanan dan instansi yang sesuai
        $datasetIndex = array_search($layanan . ' - ' . $instansi, array_column($chartData['datasets'], 'label'));

        // Jika dataset untuk layanan dan instansi tersebut belum ada, tambahkan dataset baru
        if ($datasetIndex === false) {
            $chartData['datasets'][] = [
                'label' => $layanan . ' - ' . $instansi,
                'data' => [],
                'backgroundColor' => 'rgba(54, 162, 235, 0.2)',
                'borderColor' => 'rgba(54, 162, 235, 1)',
                'borderWidth' => 1
            ];

            $datasetIndex = count($chartData['datasets']) - 1;
        }

        // Menambahkan jumlah antrian ke dataset yang sesuai
        $chartData['datasets'][$datasetIndex]['data'][] = $jumlah;
    }

    return response()->json($chartData);
}


}
