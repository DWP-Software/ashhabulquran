<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SantriModel;
use App\Models\PengajarModel;
use App\Models\KelasModel;
use App\Models\HafalanModel;
use App\Models\AbsenPengajarModel;

class Gaji extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->santri =  new SantriModel();
        $this->pengajar =  new PengajarModel();
        $this->kelas =  new KelasModel();
        $this->hafalan =  new HafalanModel();
        $this->absen =  new AbsenPengajarModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $data['title'] = 'Data Laporan Gaji';
        $data['pengajar'] = $this->pengajar->getDatapengajar();
        $data['ket'] = ['Data Laporan Gaji', '<li class="breadcrumb-item active"><a href="/gaji/index">Data Laporan Gaji</a></li>'];
        $b = $request->getPost('bulan');
        $t = $request->getPost('tahun');
        $p = $request->getPost('id_pengajar');
        $bulan = [
            '', 'Januari', 'Februari', 'Maret', 'April', 'Mei',
            'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $data['b'] = NULL;
        $data['y'] = NULL;
        $data['guru'] = NULL;
        // dd($this->absen->absen(14));
        if ($b != false and $t != false and $p != false) {
            $data['b'] = $bulan[$b];
            $data['y'] = $t;
            $guru = $this->pengajar->getDatapengajar($p);
            $data['guru'] = $guru;
            $absen = $this->absen->absen($p, $b, $t);
            $data['gaji'] = $absen;
            if ($guru->jml_hafalan > 10 and $guru->jml_hafalan <= 30) {
                $tot = $absen * 50000;
            } elseif ($guru->jml_hafalan >= 3 and $guru->jml_hafalan <= 10) {
                $tot = $absen * 35000;
            } else {
                $tot = $absen * 25000;
            }
            $data['tot'] = $tot;
        }
        return view('gaji/index', $data);
    }
}
