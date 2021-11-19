<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\AuthModel;
use App\Models\PengajarModel;
use App\Models\SantriModel;
use Config\Validation;

class User extends Controller
{
    public function __construct()
    {
        helper('form');
        $this->model =  new AuthModel();
        $this->pengajar =  new PengajarModel();
        $this->santri =  new SantriModel();
    }

    public function input()
    {
        $ket = [
            'Tambah Data User',
            '<li class="breadcrumb-item active"><a href="' . base_url() . '/user/index">Data User</a></li>',
            '<li class="breadcrumb-item active">Tambah Data</li>'
        ];
        $data = [
            'title' => 'Tambah Data User',
            'ket' => $ket,
        ];
        return view('user/input', $data);
    }

    public function add()
    {
        $request = \Config\Services::request();
        $data = array(
            'username' => $request->getPost('username'),
            'password' => password_hash($request->getPost('pass'), PASSWORD_BCRYPT),
            'telp' => $request->getPost('telp'),
            'role' => 'Pemilik'
        );
        $this->model->saveUser($data);
        session()->setFlashdata('pesan_user', 'Data user berhasi ditambahkan.');
        return redirect()->to('/user/index');
    }

    public function index()
    {
        $x = $this->model->getUser(false, 'Pengajar');
        $pengajar = [];
        for ($i = 0; $i < count($x); $i++) {
            $pengajar[$i]['id_user'] = $x[$i]['id_user'];
            $pengajar[$i]['username'] = $x[$i]['username'];
            if ($this->pengajar->getDatapengajar($x[$i]['id_data']) != NULL) {
                $pengajar[$i]['nama'] = $this->pengajar->getDatapengajar($x[$i]['id_data'])->nama;
            } else {
                $pengajar[$i]['nama'] = NULL;
            }
        }

        $y = $this->model->getUser(false, 'Santri');
        $santri = [];
        for ($i = 0; $i < count($y); $i++) {
            $santri[$i]['id_user'] = $y[$i]['id_user'];
            $santri[$i]['username'] = $y[$i]['username'];
            if ($this->santri->getDatasantri($y[$i]['id_data']) != NULL) {
                $santri[$i]['nama'] = $this->santri->getDatasantri($y[$i]['id_data'])->nama;
            } else {
                $santri[$i]['nama'] = NULL;
            }
        }

        $data['title'] = 'Data User';
        $data['pengajar'] = $pengajar;
        $data['santri'] = $santri;
        $data['pemilik'] = $this->model->getUser(false, 'Pemilik');
        $data['ket'] = ['Data User', '<li class="breadcrumb-item active"><a href="/user">Data User</a></li>'];
        return view('user/index', $data);
    }

    public function edit($id_user)
    {
        $getUser = $this->model->getUser($id_user);
        if (isset($getUser)) {
            $data['user'] = $getUser;
            $data['title']  = 'Edit Data ';
            $data['ket'] = ['Edit Data User', '<li class="breadcrumb-item active"><a href="/user">Data User</a></li>', '<li class="breadcrumb-item active">Edit Data User<li>'];
            return view('user/edit', $data);
        } else {
            session()->setFlashdata('pesan_user', 'ID user ' . $id_user . ' Tidak Ditemukan.');
            return redirect()->to('/user');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();

        $id_user = $request->getPost('id_user');
        $pass = $request->getPost('password');
        if ($pass != NULL) {
            $data = array(
                'password' => password_hash($pass, PASSWORD_BCRYPT)
            );
            $this->model->editUser($data, $id_user);
        }
        $data = array(
            'username' => $request->getPost('username'),
            'telp'   =>  $request->getPost('telp'),
        );
        $this->model->editUser($data, $id_user);

        session()->setFlashdata('pesan_user', 'Data user Berhasi Diedit.');
        return redirect()->to('/user');
    }

    public function delete($id_user)
    {
        $getUser = $this->model->getUser($id_user);
        if (isset($getUser)) {
            $this->model->hapusUser($id_user);

            session()->setFlashdata('danger_user', 'Data user Berhasi Dihapus.');
            return redirect()->to('/user/index');
        } else {
            session()->setFlashdata('warning_user', 'Data user Tidak Ditemukan.');
            return redirect()->to('/user/index');
        }
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_user = $request->getPost('id_user');
        if ($id_user == null) {
            session()->setFlashdata('warning', 'Data user Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('/user');
        }

        $jmldata = count($id_user);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusUser($id_user[$i]);
        }

        session()->setFlashdata('pesan', 'Data user Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
        return redirect()->to('/user');
    }
}
