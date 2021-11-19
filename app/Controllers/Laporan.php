<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SantriModel;
use App\Models\PengajarModel;
use App\Models\KelasModel;
use App\Models\HafalanModel;
use App\Models\SurahModel;
use TCPDF;

class pdf extends TCPDF
{
    public function Header()
    {
        $this->SetY(10);
        $this->SetFont('times', 'B', 12);
        $isi_header = "
        <div style=\"text-align: center;\">
            <h3><b>KELAS SANTRI TAHFIZH</b></h3>
            <h3><b>RUMAH TAHFIZH SHOHIBUL QURAN</b></h3>
            <h3><b>Koto tinggi pandaisikek kec. X koto Kabupaten Tanah Datar Sumbar</b></h3>
        </div>
        ";
        $this->writeHTML($isi_header, true, false, false, false, '');
    }
}

class Laporan extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->santri =  new SantriModel();
        $this->pengajar =  new PengajarModel();
        $this->kelas =  new KelasModel();
        $this->hafalan =  new HafalanModel();
        $this->surah =  new SurahModel();
    }

    public function index()
    {
        $request = \Config\Services::request();
        $data['title'] = 'Data Laporan Santri';
        $data['kelas'] = $this->kelas->getKelas();
        $data['ket'] = ['Data Laporan Santri', '<li class="breadcrumb-item active"><a href="/laporan/index">Data Laporan Santri</a></li>'];
        $b = $request->getPost('bulan');
        $t = $request->getPost('tahun');
        $k = $request->getPost('id_kelas');
        $bulan = [
            '', 'Januari', 'Februari', 'Maret', 'April', 'Mei',
            'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $data['santri'] = NULL;
        $data['b'] = ['', ''];
        $data['y'] = '';
        $data['idk'] = '';
        if ($b != false and $t != false and $k != false) {
            $x = $this->santri->santritgl($k, $b, $t);
            if ($x == NULL) {
                session()->setFlashdata('warning', 'Data tidak ada');
                return redirect()->to(base_url() . '/laporan/index');
            }
            $data['santri'] = $x;
            if ($x != NULL) {
                $data['pengajar'] = $this->pengajar->getDatapengajar($x[0]['id_pengajar'])->nama;
                $data['k'] = $x[0]['nama_kelas'];
            }
            $bln = [$bulan[$b], $b];
            $data['b'] = $bln;
            $data['y'] = $t;
            $data['idk'] = $k;
        }
        return view('laporan/index', $data);
    }

    public function cetak($b, $t, $k)
    {
        $x = $this->santri->santritgl($k, $b, $t);
        $bulan = [
            '', 'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI',
            'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'
        ];
        if ($x != NULL) {
            $p = $this->pengajar->getDatapengajar($x[0]['id_pengajar'])->nama;
            $k = $x[0]['nama_kelas'];
        }
        $data = [
            'title' => 'Laporan Santri',
            'lap' => $x,
            'b' => $bulan[$b],
            'y' => $t,
            'pengajar' => $p,
            'k' => $k,
            'santri' => $x
        ];
        $html = view('laporan/print_santri', $data);
        $pdf = new pdf('L', PDF_UNIT, 'F4', true, 'UTF-8', false);
        $pdf->SetFont('times', '', 12);
        $pdf->setHeaderMargin(20);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(20, 30, 20, true);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('santri.pdf', 'I');
    }

    public function hafalan()
    {
        $request = \Config\Services::request();
        $data['title'] = 'Data Laporan Hafalan Harian';
        $data['kelas'] = $this->kelas->getKelas();
        $data['ket'] = ['Data Laporan Hafalan Harian', '<li class="breadcrumb-item active"><a href="/laporan/hafalan">Data Laporan Hafalan Harian</a></li>'];
        $tgl = $request->getPost('tgl');
        $k = $request->getPost('id_kelas');
        $bulan = [
            '', 'Januari', 'Februari', 'Maret', 'April', 'Mei',
            'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $data['santri'] = NULL;
        // $data['t'] = NULL; 
        $data['idk'] = NULL;
        $data['date'] = NULL;
        if ($tgl != false and $k != false) {
            $b = date('m', strtotime($tgl));
            $y = date('Y', strtotime($tgl));
            $santri = $this->santri->santritgl($k, $b, $y);
            $x = $this->hafalan->tgl($k, $b, $y);
            if ($santri == NULL and $x == NULL) {
                session()->setFlashdata('warning', 'Data tidak ada');
                return redirect()->to(base_url() . '/laporan/hafalan');
            }
            $i = 0;
            foreach ($santri as $a) {
                $data_san[$i] = $this->hafalan->santri($k, $b, $y, $a['id_santri']);
                $i++;
            }
            for ($i = 0; $i < count($x); $i++) {
                $t[$i] = $x[$i]['tgl_setor'];
            }
            $data['tgl'] = $t;
            // dd($data['tgl']); 
            $data['santri'] = $x;
            $data['san'] = $santri;
            $data['data_san'] = $data_san;
            if ($santri != NULL) {
                $data['pengajar'] = $this->pengajar->getDatapengajar($santri[0]['id_pengajar'])->nama;
                $data['k'] = $santri[0]['nama_kelas'];
            }
            $data['b'] =  $bulan[$b];
            $data['date'] =  $tgl;
            $data['y'] = $y;
            // $data['t'] = $tgl; 
            $data['idk'] = $k;
            // dd($data); 
        }
        return view('laporan/hafalan', $data);
    }

    public function cetak_haf($k, $tgl)
    {
        $bulan = [
            '', 'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI',
            'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'
        ];
        $b = date('m', strtotime($tgl));
        $y = date('Y', strtotime($tgl));
        $santri = $this->santri->santritgl($k, $b, $y);
        $i = 0;
        foreach ($santri as $a) {
            $data_san[$i] = $this->hafalan->santri($k, $b, $y, $a['id_santri']);
            $i++;
        }
        $x = $this->hafalan->tgl($k, $b, $y);
        for ($i = 0; $i < count($x); $i++) {
            $t[$i] = $x[$i]['tgl_setor'];
        }

        if ($santri != NULL) {
            $pengajar = $this->pengajar->getDatapengajar($santri[0]['id_pengajar'])->nama;
            $k = $santri[0]['nama_kelas'];
        }
        $data = [
            'title' => 'Laporan Santri',
            'lap' => $x,
            'b' => $bulan[$b],
            'y' => $y,
            'k' => $k,
            'santri' => $x,
            'date' => $tgl,
            'idk' => $k,
            'pengajar' => $pengajar,
            'tgl' => $t,
            'san' => $santri,
            'data_san' => $data_san
        ];
        $html = view('laporan/print_haf', $data);
        $pdf = new pdf('L', PDF_UNIT, 'F4', true, 'UTF-8', false);
        $pdf->SetFont('times', '', 12);
        $pdf->setHeaderMargin(20);
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(20, 30, 20, true);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('santri.pdf', 'I');
    }

    public function juz()
    {
        $request = \Config\Services::request();
        $data['title'] = 'Data Laporan Hafalan per Juz';
        $data['kelas'] = $this->kelas->getKelas();
        $data['ket'] = ['Data Laporan Hafalan per Juz', '<li class="breadcrumb-item active"><a href="/laporan/juz">Data Laporan Hafalan per Juz</a></li>'];
        $b = $request->getPost('bulan');
        $t = $request->getPost('tahun');
        $bulan = [
            '', 'Januari', 'Februari', 'Maret', 'April', 'Mei',
            'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        $jml_san = [];
        $jm = 0;
        $data['b'] = ['', ''];
        $data['y'] = '';
        // dd($this->surah->juz(1));
        if ($b != false and $t != false) {
            for ($i = 0; $i < 30; $i++) {
                $srh = $this->surah->juz($i + 1);
                $x = $srh->id_surah;
                $jml = $this->hafalan->haf($i + 1, $b, $t, $x);
                // dd($jml);
                $jm = 0;
                for ($j = 0; $j < count($jml); $j++) {
                    if ($jml[$j]['akhir_hafalan'] == $jml[$j]['akhir']) {
                        $jml_san[] = $jml[$j]['nama'];
                        $jm++;
                    } else {
                        continue;
                    }
                }
                $santri[$i] = $jm;
            }
            if ($santri == NULL) {
                session()->setFlashdata('warning', 'Data tidak ada');
                return redirect()->to(base_url() . '/laporan/juz');
            }
            $data['santri'] = $santri;
            $bln = [$bulan[$b], $b];
            $data['b'] = $bln;
            $data['y'] = $t;
        }
        // dd($this->hafalan->haf(1, 10, 2021, 2));
        return view('laporan/juz', $data);
    }

    public function cetak_juz($b, $t)
    {
        for ($i = 0; $i < 30; $i++) {
            $srh = $this->surah->juz($i + 1);
            $x = $srh->id_surah;
            $jml = $this->hafalan->haf($i + 1, $b, $t, $x);
            // dd($jml);
            $jm = 0;
            for ($j = 0; $j < count($jml); $j++) {
                if ($jml[$j]['akhir_hafalan'] == $jml[$j]['akhir']) {
                    $jml_san[] = $jml[$j]['nama'];
                    $jm++;
                } else {
                    continue;
                }
            }
            $santri[$i] = $jm;
        }
        $bulan = [
            '', 'JANUARI', 'FEBRUARI', 'MARET', 'APRIL', 'MEI',
            'JUNI', 'JULI', 'AGUSTUS', 'SEPTEMBER', 'OKTOBER', 'NOVEMBER', 'DESEMBER'
        ];
        $data = [
            'title' => 'Laporan per Juz',
            'b' => $bulan[$b],
            'y' => $t,
            'santri' => $santri
        ];
        $html = view('laporan/print_juz', $data);
        $pdf = new pdf('', PDF_UNIT, 'F4', true, 'UTF-8', false);
        $pdf->SetFont('times', '', 12);
        $pdf->setHeaderMargin(20);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(20, 20, 20, true);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('juz.pdf', 'I');
    }

    public function pengajar()
    {
        $request = \Config\Services::request();
        $data['title'] = 'Data Laporan Pengajar';
        $data['ket'] = ['Data Laporan Pengajar', '<li class="breadcrumb-item active"><a href="/laporan/index">Data Laporan Pengajar</a></li>'];
        $t = $request->getPost('tahun');
        $data['pengajar'] = NULL;
        $data['t'] = '';
        if ($t != false) {
            $data['t'] = $t;
            $data['pengajar'] = $this->pengajar->cetak($t);
            if ($data['pengajar'] == NULL) {
                session()->setFlashdata('warning', 'Data tidak ada');
                return redirect()->to(base_url() . '/laporan/pengajar');
            }
        }
        return view('laporan/pengajar', $data);
    }

    public function cetakpengajar($t)
    {
        $data = [
            'title' => 'Laporan Data Pengajar',
            't' => $t,
            'pengajar' => $this->pengajar->cetak($t)
        ];
        $html = view('laporan/print_pengajar', $data);
        $pdf = new pdf('L', PDF_UNIT, 'A4', true, 'UTF-8', false);
        $pdf->SetFont('times', '', 12);
        $pdf->setHeaderMargin(20);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->SetMargins(20, 20, 20, true);
        $pdf->AddPage();
        $pdf->writeHTML($html);
        $this->response->setContentType('application/pdf');
        $pdf->Output('pengajar.pdf', 'I');
    }
}
