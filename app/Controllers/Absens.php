<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AbsenSantriModel;
use App\Models\SantriModel;
use App\Models\KelasModel;
use App\Models\PengajarModel;

class Absens extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->model =  new AbsenSantriModel();
        $this->santri =  new SantriModel();
        $this->kls =  new KelasModel();
        $this->pengajar =  new PengajarModel();
    }

    public function index()
    {
        $data['getAbsen'] = [];
        if (session()->get('role') == 'Pengajar') {
            $x = $this->model->tot(session()->get('id_data'));
            // dd($tgl);
            // dd($x);
            if ($x != false) {
                $data['getAbsen'] = $x;
                for ($i = 0; $i < count($x); $i++) {
                    $d = $this->model->totket(session()->get('id_data'), 'hadir', $x[$i]['id_kelas'], $x[$i]['tanggal']);
                    if ($d != NULL) {
                        $hadir[$i] = $this->model->totket(session()->get('id_data'), 'hadir', $x[$i]['id_kelas'], $x[$i]['tanggal'])[0];
                    } else {
                        $hadir[$i]['jml'] = '0';
                    }
                    $a = $this->model->totket(session()->get('id_data'), 'izin', $x[$i]['id_kelas'], $x[$i]['tanggal']);
                    if ($a != NULL) {
                        $izin[$i] = $this->model->totket(session()->get('id_data'), 'izin', $x[$i]['id_kelas'], $x[$i]['tanggal'])[0];
                    } else {
                        $izin[$i]['jml'] = '0';
                    }
                    $b = $this->model->totket(session()->get('id_data'), 'alfa', $x[$i]['id_kelas'], $x[$i]['tanggal']);
                    if ($b != NULL) {
                        $alfa[$i] = $this->model->totket(session()->get('id_data'), 'alfa', $x[$i]['id_kelas'], $x[$i]['tanggal'])[0];
                    } else {
                        $alfa[$i]['jml'] = '0';
                    }
                    $c = $this->model->totket(session()->get('id_data'), 'sakit', $x[$i]['id_kelas'], $x[$i]['tanggal']);
                    if ($c != NULL) {
                        $sakit[$i] = $this->model->totket(session()->get('id_data'), 'sakit', $x[$i]['id_kelas'], $x[$i]['tanggal'])[0];
                    } else {
                        $sakit[$i]['jml'] = '0';
                    }

                    $jml[] = count($this->santri->getDatasantri(false, $x[$i]['id_kelas']));
                }
                // dd($hadir);
                $data['hadir'] = $hadir;
                $data['izin'] = $izin;
                $data['alfa'] = $alfa;
                $data['sakit'] = $sakit;
                $data['jml'] = $jml;
            }
            // dd($data['izin']);
            $data['kelas'] = $this->pengajar->getDatapengajar(false, session()->get('id_data'));
            // dd($data);
        } elseif (session()->get('role') == 'Admin') {
            $x = $this->model->totsen();
            // dd($x);
            if ($x != false) {
                $data['getAbsen'] = $x;
                for ($i = 0; $i < count($x); $i++) {
                    $d = $this->model->absensan('hadir', $x[$i]['id_kelas'], $x[$i]['tanggal']);
                    if ($d != NULL) {
                        $hadir[$i] = $this->model->absensan('hadir', $x[$i]['id_kelas'], $x[$i]['tanggal'])[0];
                    } else {
                        $hadir[$i]['jml'] = '0';
                    }
                    $a = $this->model->absensan('izin', $x[$i]['id_kelas'], $x[$i]['tanggal']);
                    if ($a != NULL) {
                        $izin[$i] = $this->model->absensan('izin', $x[$i]['id_kelas'], $x[$i]['tanggal'])[0];
                    } else {
                        $izin[$i]['jml'] = '0';
                    }
                    $b = $this->model->absensan('alfa', $x[$i]['id_kelas'], $x[$i]['tanggal']);
                    if ($b != NULL) {
                        $alfa[$i] = $this->model->absensan('alfa', $x[$i]['id_kelas'], $x[$i]['tanggal'])[0];
                    } else {
                        $alfa[$i]['jml'] = '0';
                    }
                    $c = $this->model->absensan('sakit', $x[$i]['id_kelas'], $x[$i]['tanggal']);
                    if ($c != NULL) {
                        $sakit[$i] = $this->model->absensan('sakit', $x[$i]['id_kelas'], $x[$i]['tanggal'])[0];
                    } else {
                        $sakit[$i]['jml'] = '0';
                    }
                    $jml[] = count($this->santri->getDatasantri(false, $x[$i]['id_kelas']));
                }
                // dd($x);
                $data['jml'] = $jml;
                $data['hadir'] = $hadir;
                $data['izin'] = $izin;
                $data['alfa'] = $alfa;
                $data['sakit'] = $sakit;
                // $data['jml'] = $jml;
            }
            // dd($data['izin']);
            $data['kelas'] = $this->kls->getKelas();
            // dd($data['kelas']);
        } elseif (session()->get('role') == 'Santri') {
            $data['getAbsens'] = $this->model->getAbsenSantri(false, session()->get('id_data'));
        }

        $data['title'] = 'Data Absen Santri';
        $data['ket'] = ['Data Absen Santri', '<li class="breadcrumb-item active"><a href="/absens">Data Absen</a></li>'];
        // dd($data);
        // dd($jml);
        return view('absensisantri/index', $data);
    }

    public function input($id = false)
    {
        $request = \Config\Services::request();
        if ($id != false) {
            $id_kelas = $id;
            $data['absen'] = $this->model->data($id_kelas);
        } else {
            $id_kelas = $request->getPost('id_kelas');
            $data['absen'] = NULL;
        }
        $data['title'] = 'Tambah Absen';
        $data['ket'] = ['Input Data Absen', '<li class="breadcrumb-item active"><a href="/absens">Data Absen</a></li>', '<li class="breadcrumb-item active">Input Data galeri<li>'];
        if (session()->get('role') == 'Admin' or session()->get('role') == 'Pengajar') {
            $data['santri'] = $this->santri->getDatasantri(false, $id_kelas);
            if ($data['santri'] == NULL) {
                session()->setFlashdata('warning_absen', 'Data santri tidak ada');
                return redirect()->to('/absens/index');
            }
        } elseif (session()->get('role') == 'Santri') {
            $data['santri'] = $this->santri->getDatasantri(false, session()->get('id_data'));
        }
        // dd($data);
        // if ($id != false) {
        //     return view('absensisantri/edit', $data);
        // } else {
        return view('absensisantri/input', $data);
        // }
    }

    public function add()
    {
        $request = \Config\Services::request();
        $santri = $request->getPost('id_santri');
        for ($i = 0; $i < count($santri); $i++) {
            $data = array(
                'id_santri' => $santri[$i],
                'tanggal'   =>  date('Y-m-d'),
                'keterangan' => $request->getPost('ket' . $santri[$i]),
            );
            $this->model->saveAbsen($data);
        }
        session()->setFlashdata('pesan_absen', 'Data absen Ditambahkan.');
        return redirect()->to('/absens/index');
    }

    public function edit($id_kelas, $tgl)
    {
        $getAbsens = $this->model->cariabsen(session($id_kelas));
        if (isset($getAbsens)) {
            $data['title'] = 'Edit Absen';
            $data['ket'] = ['Input Data Absen', '<li class="breadcrumb-item active"><a href="/absens">Data Absen</a></li>', '<li class="breadcrumb-item active">Input Data galeri<li>'];
            if (session()->get('role') == 'Admin' or session()->get('role') == 'Pengajar') {
                $data['santri'] = $this->santri->getDatasantri(false, $id_kelas);
                $data['absen'] = $this->model->data($id_kelas, $tgl);
                if ($data['santri'] == NULL) {
                    session()->setFlashdata('warning_absen', 'Data santri tidak ada');
                    return redirect()->to('/absens/index');
                }
            } elseif (session()->get('role') == 'Santri') {
                $data['santri'] = $this->santri->getDatasantri(false, session()->get('id_data'));
            }
            // dd($data);
            return view('absensisantri/edit', $data);
        } else {

            session()->setFlashdata('pesan_absen', 'ID absen ' . $id_kelas . ' Tidak Ditemukan.');
            return redirect()->to('/absens');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_absen = $request->getPost('id_absen');
        // dd($id_absen);
        $santri = $request->getPost('id_san');
        for ($i = 0; $i < count($id_absen); $i++) {
            // $this->model->hapusAbsen($id_absen[$i]);
            $data = array(
                'id_santri' => $santri[$i],
                'tanggal'   =>  date('Y-m-d'),
                'keterangan' => $request->getPost('ket' . $santri[$i]),
            );
            $this->model->editAbsen($data, $id_absen[$i]);
        }

        session()->setFlashdata('pesan_absen', 'Data Absen Berhasil Diedit.');
        return redirect()->to('/absens/index');
    }

    public function delete($id_kelas, $tgl)
    {
        $getAbsens = $this->model->data($id_kelas, $tgl);
        // dd($getAbsens);
        if (isset($getAbsens)) {
            for ($i = 0; $i < count($getAbsens); $i++) {
                $this->model->hapusAbsen($getAbsens[$i]['id_absen']);
            }
            session()->setFlashdata('danger_absen', 'Data Absens Berhasi Dihapus.');
            return redirect()->to('/absens/index');
        } else {
            session()->setFlashdata('warning_absen', 'Data Absens Tidak Ditemukan.');
            return redirect()->to('/absens/index');
        }
    }

    public function view($id_kelas, $tgl)
    {
        $data['title'] = 'View Data Absen';
        $k = $this->kls->getKelas($id_kelas);
        $data['kelas'] = $k;
        // $data['santri'] = $this->santri->getDatasantri(false, $id_kelas);
        $x = $this->model->data($id_kelas, $tgl);
        $data['absen'] = $x;
        $data['jml'] = count($x);

        $d = $this->model->totket(session()->get('id_data'), 'hadir', $k->id_kelas, $tgl);
        if ($d != NULL) {
            $hadir = $this->model->totket(session()->get('id_data'), 'hadir', $k->id_kelas, $tgl)[0];
        } else {
            $hadir['jml'] = '0';
        }
        $a = $this->model->totket(session()->get('id_data'), 'izin', $k->id_kelas, $tgl);
        if ($a != NULL) {
            $izin = $this->model->totket(session()->get('id_data'), 'izin', $k->id_kelas, $tgl)[0];
        } else {
            $izin['jml'] = '0';
        }
        $b = $this->model->totket(session()->get('id_data'), 'alfa', $k->id_kelas, $tgl);
        if ($b != NULL) {
            $alfa = $this->model->totket(session()->get('id_data'), 'alfa', $k->id_kelas, $tgl)[0];
        } else {
            $alfa['jml'] = '0';
        }
        $c = $this->model->totket(session()->get('id_data'), 'sakit', $k->id_kelas, $tgl);
        if ($c != NULL) {
            $sakit = $this->model->totket(session()->get('id_data'), 'sakit', $k->id_kelas, $tgl)[0];
        } else {
            $sakit['jml'] = '0';
        }

        $data['i'] =  $izin;
        $data['h'] =  $hadir;
        $data['s'] =  $sakit;
        $data['a'] =  $alfa;
        $data['tgl'] = $tgl;
        // dd($data);
        $data['ket'] = ['View Data Absen', '<li class="breadcrumb-item active"><a href="/absens">Data Absens</a></li>', '<li class="breadcrumb-item active">View Data Absen<li>'];
        return view('absensisantri/view', $data);
    }
}
