<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\GaleriModel;

class Galeri extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->model =  new GaleriModel();
    }

    public function index()
    {
        // dd($this->model->getPeriode());
        $data['title'] = 'Data galeri';
        $data['getGaleri'] = $this->model->getGaleri();
        $data['ket'] = ['Data galeri', '<li class="breadcrumb-item active"><a href="/galeri">Data galeri</a></li>'];
        return view('galeri/index', $data);
    }

    public function input()
    {
        $data['title'] = 'Tambah galeri';
        $data['ket'] = ['Input Data galeri', '<li class="breadcrumb-item active"><a href="/galeri">Data galeri</a></li>', '<li class="breadcrumb-item active">Input Data galeri<li>'];
        return view('galeri/input', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();
        $file = $request->getFile('foto');
        // dd($file);
        if ($file->getError() == 4) {
            $nm = "default.jpg";
        } else {
            $nm = $file->getRandomName();
            $file->move('galeriimg', $nm);
        }
        $data = array(
            'nama_kegiatan' => $request->getPost('nama_kegiatan'),
            'tgl'   =>  $request->getPost('tgl'),
            'foto' => $nm,
        );
        $this->model->saveGaleri($data);
        session()->setFlashdata('pesan_galeri', 'Data galeri Ditambahkan.');
        return redirect()->to('/galeri/index');
    }

    public function edit($id_galeri)
    {
        $getGaleri = $this->model->getGaleri($id_galeri);
        if (isset($getGaleri)) {
            $data['galeri'] = $getGaleri;
            $data['title']  = 'Edit Data ';
            $data['ket'] = ['Edit Data galeri', '<li class="breadcrumb-item active"><a href="/galeri">Data galeri</a></li>', '<li class="breadcrumb-item active">Edit Data galeri<li>'];
            // dd($data['galeri']);
            return view('galeri/edit', $data);
        } else {

            session()->setFlashdata('pesan_galeri', 'ID galeri ' . $id_galeri . ' Tidak Ditemukan.');
            return redirect()->to('/galeri');
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
            $file->move('galeriimg', $nm);
            if ($request->getPost('lama') == 'default.jpg') {
                // continue;
            } else {
                // unlink('galeriimg/' . $request->getPost('lama'));
            }
        }

        $id_galeri = $request->getPost('id_galeri');
        $data = array(
            'nama_kegiatan' => $request->getPost('nama_kegiatan'),
            'tgl'   =>  $request->getPost('tgl'),
            'foto' => $nm,
        );
        $this->model->editGaleri($data, $id_galeri);

        session()->setFlashdata('pesan_galeri', 'Data galeri Berhasi Diedit.');
        return redirect()->to('/galeri');
    }

    public function delete($id_galeri)
    {
        $getGaleri = $this->model->getGaleri($id_galeri);
        if (isset($getGaleri)) {
            $this->model->hapusGaleri($id_galeri);

            session()->setFlashdata('danger_galeri', 'Data galeri Berhasi Dihapus.');
            return redirect()->to('/galeri/index');
        } else {
            session()->setFlashdata('warning_galeri', 'Data galeri Tidak Ditemukan.');
            return redirect()->to('/galeri/index');
        }
    }

    public function view($id_galeri)
    {
        $data['title'] = 'View Data galeri';
        $data['galeri'] = $this->model->getGaleri($id_galeri);
        $data['ket'] = ['View Data galeri', '<li class="breadcrumb-item active"><a href="/galeri">Data galeri</a></li>', '<li class="breadcrumb-item active">View Data galeri<li>'];
        return view('galeri/view', $data);
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_galeri = $request->getPost('id_galeri');
        if ($id_galeri == null) {
            session()->setFlashdata('warning', 'Data galeri Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('/galeri');
        }

        $jmldata = count($id_galeri);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusGaleri($id_galeri[$i]);
        }

        session()->setFlashdata('pesan_galeri', 'Data galeri Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
        return redirect()->to('/galeri');
    }
}
