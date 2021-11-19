<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KelasModel;
use App\Models\KelasSModel;
use App\Models\PengajarModel;

class Kelas extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->model =  new KelasModel();
        $this->kelass =  new KelasSModel();
        $this->pengajar =  new PengajarModel();
    }

    public function index()
    {
        // dd($this->model->getPeriode());
        $data['title'] = 'Data Kelas';
        $data['getKelas'] = $this->model->getKelas();
        $data['getKelasS'] = $this->kelass->getKelasS();
        $data['ket'] = ['Data Kelas', '<li class="breadcrumb-item active"><a href="/kelas">Data Kelas</a></li>'];
        return view('kelas/index', $data);
    }

    public function input()
    {
        $data['title'] = 'Tambah kelas';
        $data['pengajar'] = $this->pengajar->data();
        $data['ket'] = ['Input Data Kelas', '<li class="breadcrumb-item active"><a href="/kelas">Data Kelas</a></li>', '<li class="breadcrumb-item active">Input Data Kelas<li>'];
        return view('kelas/input', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();
        $data = array(
            'nama_kelas' => $request->getPost('nama'),
            'id_pengajar'   =>  $request->getPost('pengajar'),
            'keterangan_kelas' => $request->getPost('ket'),
        );
        $this->model->saveKelas($data);
        session()->setFlashdata('pesan_kelas', 'Data Kelas Ditambahkan.');
        return redirect()->to('/kelas/index');
    }

    public function edit($id_kelas)
    {
        $getKelas = $this->model->getKelas($id_kelas);
        if (isset($getKelas)) {
            $data['kelas'] = $getKelas;
            $data['title']  = 'Edit Data ';
            $data['pengajar'] = $this->pengajar->data();
            $data['ket'] = ['Edit Data Kelas', '<li class="breadcrumb-item active"><a href="/kelas">Data Kelas</a></li>', '<li class="breadcrumb-item active">Edit Data Kelas<li>'];
            // dd($data['kelas']);
            return view('kelas/edit', $data);
        } else {

            session()->setFlashdata('pesan_kelas', 'ID kelas ' . $id_kelas . ' Tidak Ditemukan.');
            return redirect()->to('/kelas');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_kelas = $request->getPost('id_kelas');
        $data = array(
            'nama_kelas' => $request->getPost('nama'),
            'id_pengajar'   =>  $request->getPost('pengajar'),
            'keterangan_kelas' => $request->getPost('ket'),
        );
        $this->model->editKelas($data, $id_kelas);

        session()->setFlashdata('pesan_kelas', 'Data Kelas Berhasi Diedit.');
        return redirect()->to('/kelas');
    }

    public function delete($id_kelas)
    {
        $getKelas = $this->model->getKelas($id_kelas);
        if (isset($getKelas)) {
            $this->model->hapusKelas($id_kelas);

            session()->setFlashdata('danger_kelas', 'Data Kelas Berhasi Dihapus.');
            return redirect()->to('/kelas/index');
        } else {
            session()->setFlashdata('warning_kelas', 'Data Kelas Tidak Ditemukan.');
            return redirect()->to('/kelas/index');
        }
    }

    public function view($id_kelas)
    {
        $data['title'] = 'View Data Kelas';
        $data['kelas'] = $this->model->getKelas($id_kelas);
        $data['ket'] = ['View Data Kelas', '<li class="breadcrumb-item active"><a href="/kelas">Data Kelas</a></li>', '<li class="breadcrumb-item active">View Data Kelas<li>'];
        return view('kelas/view', $data);
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_kelas = $request->getPost('id_kelas');
        if ($id_kelas == null) {
            session()->setFlashdata('warning', 'Data Kelas Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('/kelas');
        }

        $jmldata = count($id_kelas);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusKelas($id_kelas[$i]);
        }

        session()->setFlashdata('pesan', 'Data Kelas Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
        return redirect()->to('/kelas');
    }

    public function deletekelas($id)
    {
        $kelass = $this->kelass->getKelasS($id);
        if (isset($kelass)) {
            $this->kelass->hapusKelasS($id);

            session()->setFlashdata('danger_kelas', 'Data Kelas Berhasi Dihapus.');
            return redirect()->to('/kelas/index');
        } else {
            session()->setFlashdata('warning_kelas', 'Data Kelas Tidak Ditemukan.');
            return redirect()->to('/kelas/index');
        }
    }
}
