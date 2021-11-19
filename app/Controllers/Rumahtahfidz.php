<?php

namespace App\Controllers;

use App\Models\RumahtahfidzModel;

class Rumahtahfidz extends BaseController
{
    protected $model;
    public function __construct()
    {
        helper('form'); // Agar bisa menggunakan form
        $this->model = new RumahtahfidzModel();
    }

    public function index()
    {
        // dd($this->model->getPeriode());
        $data['title'] = 'Data Rumah Tahfidz';
        $data['getRumahtahfidz'] = $this->model->getRumahtahfidz();
        $data['ket'] = ['Data Rumah Tahfidz', '<li class="breadcrumb-item active"><a href="/rumahtahfidz">Data Rumah Tahfidz</a></li>'];
        return view('rumahtahfidz/index', $data);
    }

    public function edit($id_rumahtahfidz)
    {
        $getRumahtahfidz = $this->model->getRumahtahfidz($id_rumahtahfidz);
        if (isset($getRumahtahfidz)) {
            $data['rumahtahfidz'] = $getRumahtahfidz;
            $data['title']  = 'Edit Data ';
            $data['ket'] = ['Edit Data rumah tahfidz', '<li class="breadcrumb-item active"><a href="/rumahtahfidz">Data rumah tahfidz</a></li>', '<li class="breadcrumb-item active">Edit Data rumah tahfidz<li>'];
            // dd($data['rumahtahfidz']);
            return view('rumahtahfidz/edit', $data);
        } else {

            session()->setFlashdata('pesan_rumahtahfidz', 'ID rumahtahfidz ' . $id_rumahtahfidz . ' Tidak Ditemukan.');
            return redirect()->to('/rumahtahfidz');
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
                // unlink('rumahtahfidzimg/' . $request->getPost('lama'));
            }
        }

        $id_rumahtahfidz = $request->getPost('id_rumahtahfidz');
        $data = array(
            'namart' => $request->getPost('namart'),
            'pemilik'   =>  $request->getPost('pemilik'),
            'alamat' => $request->getPost('alamat'),
            'email'   =>  $request->getPost('email'),
            'telp1' => $request->getPost('telp1'),
            'telp2'   =>  $request->getPost('telp2'),
            'maps' => $request->getPost('maps'),
            'foto' => $nm,
        );
        $this->model->editrumahtahfidz($data, $id_rumahtahfidz);

        session()->setFlashdata('pesan_rumahtahfidz', 'Data rumah tahfidz Berhasi Diedit.');
        return redirect()->to('/rumahtahfidz');
    }
}
