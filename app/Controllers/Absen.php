<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AbsenPengajarModel;
use App\Models\PengajarModel;
use App\Models\KelasModel;

class Absen extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->model =  new AbsenPengajarModel();
        $this->pengajar =  new PengajarModel();
        $this->kls =  new KelasModel();
    }

    public function index()
    {
        if (session()->get('role') == 'Admin') {
            $data['getAbsen'] = $this->model->getAbsenPengajar();
        } elseif (session()->get('role') == 'Pengajar') {
            $data['getAbsen'] = $this->model->getAbsenPengajar(false, session()->get('id_data'));
        }
        $data['title'] = 'Data Absen Pengajar';
        $data['ket'] = ['Data Absen Pengajar', '<li class="breadcrumb-item active"><a href="/absen">Data Absen</a></li>'];
        return view('absensipengajar/index', $data);
    }

    public function input()
    {
        $data['title'] = 'Tambah Absen';
        $data['ket'] = ['Input Data Absen', '<li class="breadcrumb-item active"><a href="/absen">Data Absen</a></li>', '<li class="breadcrumb-item active">Input Data absen<li>'];
        if (session()->get('role') == 'Admin') {
            $data['pengajar'] = $this->pengajar->pengajar();
        } elseif (session()->get('role') == 'Pengajar') {
            $data['pengajar'] = $this->pengajar->getDatapengajar(false, session()->get('id_data'));
        }
        // dd($data);
        return view('absensipengajar/input', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();
        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = "default.jpg";
        } else {
            $nm = $file->getRandomName();
            $file->move('absenimg', $nm);
        }
        if (session()->get('role') == 'Admin') {
            $kls = $request->getPost('id_kelas');
            $x = $this->kls->getKelas($kls);
            $data = array(
                'id_pengajar' => $x->id_pengajar,
                'id_kelas' => $kls,
                'tanggal'   =>  date('Y-m-d'),
                'keterangan' => $request->getPost('ket'),
                'foto' => $nm
            );
        } elseif (session()->get('role') == 'Pengajar') {
            $kls = $request->getPost('id_kelas');
            $data = array(
                'id_pengajar' => session()->get('id_data'),
                'id_kelas' => $kls,
                'tanggal'   =>  date('Y-m-d'),
                'keterangan' => $request->getPost('ket'),
                'foto' => $nm
            );
        }
        $this->model->saveAbsen($data);
        session()->setFlashdata('pesan_absen', 'Data absen Ditambahkan.');
        return redirect()->to('/absen/index');
    }

    public function edit($id_absen)
    {
        $getAbsen = $this->model->getAbsenPengajar($id_absen);
        // dd($getAbsen);
        if (isset($getAbsen)) {
            $data['absen'] = $this->model->isi($getAbsen->id_absen);
            $data['title']  = 'Edit Data ';
            $data['ket'] = ['Edit Data absen', '<li class="breadcrumb-item active"><a href="/absen">Data Absen</a></li>', '<li class="breadcrumb-item active">Edit Data absen<li>'];
            if (session()->get('role') == 'Admin') {
                $data['pengajar'] = $this->pengajar->data();
            }
            // dd($data);
            return view('absensipengajar/edit', $data);
        } else {

            session()->setFlashdata('pesan_absen', 'ID absen ' . $id_absen . ' Tidak Ditemukan.');
            return redirect()->to('/absen');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $file = $request->getFile('foto');
        if ($file->getError() == 4) {
            $nm = $request->getPost('lama');
        } else {
            $nm = $file->getRandomName();
            $file->move('absenimg', $nm);
            if ($request->getPost('lama') == 'default.jpg') {
                // continue;
            } else {
                // unlink('absenimg/' . $request->getPost('lama'));
            }
        }
        $id_absen = $request->getPost('id_absen');
        $kls = $request->getPost('id_kelas');
        $x = $this->kls->getKelas($kls);
        $data = array(
            'id_pengajar' => $x->id_pengajar,
            'id_kelas' => $kls,
            'tanggal'   =>  date('Y-m-d'),
            'keterangan' => $request->getPost('ket'),
            'foto' => $nm
        );
        $this->model->editAbsen($data, $id_absen);

        session()->setFlashdata('pesan_absen', 'Data absen Berhasi Diedit.');
        return redirect()->to('/absen');
    }

    public function delete($id_absen)
    {
        $getAbsenPengajar = $this->model->getAbsenPengajar($id_absen);
        if (isset($getAbsenPengajar)) {
            $this->model->hapusAbsen($id_absen);
            session()->setFlashdata('danger_absen', 'Data absen Berhasi Dihapus.');
            return redirect()->to('/absen/index');
        } else {
            session()->setFlashdata('warning_absen', 'Data absen Tidak Ditemukan.');
            return redirect()->to('/absen/index');
        }
    }
}
