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
            // dd($x);
            if ($x != false) {
                $data['getAbsen'] = $x;
                for ($i = 0; $i < count($x); $i++) {
                    $d = $this->model->totket(session()->get('id_data'), 'hadir', $x[$i]['id_kelas']);
                    if ($d != NULL) {
                        $hadir[$i] = $this->model->totket(session()->get('id_data'), 'hadir', $x[$i]['id_kelas'])[0];
                    } else {
                        $hadir[$i]['jml'] = '0';
                    }
                    $a = $this->model->totket(session()->get('id_data'), 'izin', $x[$i]['id_kelas']);
                    if ($a != NULL) {
                        $izin[$i] = $this->model->totket(session()->get('id_data'), 'izin', $x[$i]['id_kelas'])[0];
                    } else {
                        $izin[$i]['jml'] = '0';
                    }
                    $b = $this->model->totket(session()->get('id_data'), 'alfa', $x[$i]['id_kelas']);
                    if ($b != NULL) {
                        $alfa[$i] = $this->model->totket(session()->get('id_data'), 'alfa', $x[$i]['id_kelas'])[0];
                    } else {
                        $alfa[$i]['jml'] = '0';
                    }
                    $c = $this->model->totket(session()->get('id_data'), 'sakit', $x[$i]['id_kelas']);
                    if ($c != NULL) {
                        $sakit[$i] = $this->model->totket(session()->get('id_data'), 'sakit', $x[$i]['id_kelas'])[0];
                    } else {
                        $sakit[$i]['jml'] = '0';
                    }
                }
                // dd($x);
                $data['hadir'] = $hadir;
                $data['izin'] = $izin;
                $data['alfa'] = $alfa;
                $data['sakit'] = $sakit;
            }
            // dd($data['izin']);
            $data['kelas'] = $this->pengajar->getDatapengajar(false, session()->get('id_data'));
            // dd($data['kelas']);
        } elseif (session()->get('role') == 'Admin') {
            $x = $this->model->totabsen();
            // dd($x);
            if ($x != false) {
                $data['getAbsen'] = $x;
                for ($i = 0; $i < count($x); $i++) {
                    $d = $this->model->absensan('hadir', $x[$i]['id_kelas']);
                    if ($d != NULL) {
                        $hadir[$i] = $this->model->absensan('hadir', $x[$i]['id_kelas'])[0];
                    } else {
                        $hadir[$i]['jml'] = '0';
                    }
                    $a = $this->model->absensan('izin', $x[$i]['id_kelas']);
                    if ($a != NULL) {
                        $izin[$i] = $this->model->absensan('izin', $x[$i]['id_kelas'])[0];
                    } else {
                        $izin[$i]['jml'] = '0';
                    }
                    $b = $this->model->absensan('alfa', $x[$i]['id_kelas']);
                    if ($b != NULL) {
                        $alfa[$i] = $this->model->absensan('alfa', $x[$i]['id_kelas'])[0];
                    } else {
                        $alfa[$i]['jml'] = '0';
                    }
                    $c = $this->model->absensan('sakit', $x[$i]['id_kelas']);
                    if ($c != NULL) {
                        $sakit[$i] = $this->model->absensan('sakit', $x[$i]['id_kelas'])[0];
                    } else {
                        $sakit[$i]['jml'] = '0';
                    }
                }
                // dd($x);
                $data['hadir'] = $hadir;
                $data['izin'] = $izin;
                $data['alfa'] = $alfa;
                $data['sakit'] = $sakit;
            }
            // dd($data['izin']);
            $data['kelas'] = $this->kls->getKelas();
            // dd($data['kelas']);
        } elseif (session()->get('role') == 'Santri') {
            $data['getAbsens'] = $this->model->getAbsenSantri(false, session()->get('id_data'));
        }

        $data['title'] = 'Data absensantri';
        $data['ket'] = ['Data absensantri', '<li class="breadcrumb-item active"><a href="/absens">Data Absen</a></li>'];
        // dd($data);
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
                'tanggal'   =>  date('Y-m-d h:i:s'),
                'keterangan' => $request->getPost('ket' . $santri[$i]),
            );
            $this->model->saveAbsen($data);
        }
        session()->setFlashdata('pesan_absen', 'Data galeri Ditambahkan.');
        return redirect()->to('/absens/index');
    }

    public function edit($id_kelas)
    {
        $getAbsens = $this->model->cariabsen($id_kelas);
        if (isset($getAbsens)) {
            $data['title'] = 'Tambah Absen';
            $data['ket'] = ['Input Data Absen', '<li class="breadcrumb-item active"><a href="/absens">Data Absen</a></li>', '<li class="breadcrumb-item active">Input Data galeri<li>'];
            if (session()->get('role') == 'Admin' or session()->get('role') == 'Pengajar') {
                $data['santri'] = $this->santri->getDatasantri(false, $id_kelas);
                $data['absen'] = $this->model->data($id_kelas);
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
        $santri = $request->getPost('id_santri');
        for ($i = 0; $i < count($santri); $i++) {
            $data = array(
                'id_santri' => $santri[$i],
                'tanggal'   =>  date('Y-m-d h:i:s'),
                'keterangan' => $request->getPost('ket' . $santri[$i]),
            );
            $this->model->editAbsen($data, $id_absen[$i]);
        }

        session()->setFlashdata('pesan_absen', 'Data Absen Berhasi Diedit.');
        return redirect()->to('/absens');
    }

    // public function delete($id_absen)
    // {
    //     $getAbsens = $this->model->getGaleri($id_absen);
    //     if (isset($getAbsens)) {
    //         $this->model->hapusGaleri($id_absen);

    //         session()->setFlashdata('danger_absen', 'Data Absens Berhasi Dihapus.');
    //         return redirect()->to('/absens/index');
    //     } else {
    //         session()->setFlashdata('warning_absen', 'Data Absens Tidak Ditemukan.');
    //         return redirect()->to('/absens/index');
    //     }
    // }

    public function view($id_kelas)
    {
        $data['title'] = 'View Data Absen';
        $data['kelas'] = $this->kls->getKelas($id_kelas);
        // $data['santri'] = $this->santri->getDatasantri(false, $id_kelas);
        $data['absen'] = $this->model->data($id_kelas);
        $data['ket'] = ['View Data Absen', '<li class="breadcrumb-item active"><a href="/absens">Data Absens</a></li>', '<li class="breadcrumb-item active">View Data galeri<li>'];
        return view('absensisantri/view', $data);
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_absen = $request->getPost('id_absen');
        if ($id_absen == null) {
            session()->setFlashdata('warning', 'Data galeri Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('/absens');
        }

        $jmldata = count($id_absen);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusGaleri($id_absen[$i]);
        }

        session()->setFlashdata('pesan_absen', 'Data galeri Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
        return redirect()->to('/absens');
    }
}
