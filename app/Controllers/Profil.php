<?php

namespace App\Controllers;

use App\Models\SantriModel;
use App\Models\AuthModel;
use App\Models\PengajarModel;
use App\Models\KelasSModel;
use App\Models\AbsenPengajarModel;

class Profil extends BaseController
{
    protected $model, $user;
    public function __construct()
    {
        helper('form');
        // Deklarasi model
        $this->model =  new SantriModel();
        $this->user =  new AuthModel();
        $this->pengajar =  new PengajarModel();
        $this->kls =  new KelasSModel();
        $this->absen =  new AbsenPengajarModel();
    }

    public function index()
    {
        $ket = [
            'Profil', '<li class="breadcrumb-item active"><a href="' . base_url() . '/profil/index">Profil</a></li>'
        ];
        if (session()->get('role') == 'Pengajar') {
            $p = $this->pengajar->getDatapengajar(session()->get('id_data'), 'pengajar');
            $data = [
                'title' => 'Sistem Informasi Pengajar',
                'ket' => $ket,
                'link' => 'profil',
                'user' => $p,
                'isi' => $this->user->getUser(session()->id_user)
            ];
            $absen = $this->absen->absen($p->id_pengajar, date('m'), date('Y'));
            if ($p->jml_hafalan > 10 and $p->jml_hafalan <= 30) {
                $tot = $absen * 50000;
            } elseif ($p->jml_hafalan >= 3 and $p->jml_hafalan <= 10) {
                $tot = $absen * 35000;
            } else {
                $tot = $absen * 25000;
            }
            $data['gaji'] = $tot;
            return view('profil/pengajar', $data);
        } else {
            $data = [
                'title' => 'Sistem Informasi Santri',
                'ket' => $ket,
                'link' => 'profil',
                'user' => $this->model->getDatasantri(session()->get('id_data'), 'santri'),
                'isi' => $this->user->getUser(session()->id_user)
            ];
            return view('profil/santri', $data);
        }
    }

    public function edit()
    {
        $getUser = $this->user->getUser(session()->get('id_user'));
        if (session()->get('role') == 'Pengajar') {
            $x = $this->pengajar->getDatapengajar(session()->get('id_data'));
            if (isset($getUser)) {
                $ket = [
                    'Edit Data : ' . $x->nama, '<li class="breadcrumb-item active"><a href="' . base_url() . '/profil/index">Profil</a></li>',
                    '<li class="breadcrumb-item active">Edit Profil</li>'
                ];
                $data = [
                    'title' => 'Edit Data : ' . $x->nama,
                    'ket' => $ket,
                    'user' => $getUser,
                    'link' => 'home',
                    'pengajar' => $x,
                    'isi' => $getUser
                ];
                return view('profil/editpengajar', $data);
            } else {
                session()->setFlashdata('warning_profil', 'User ' . session()->username . ' tidak ditemukan.');
                return redirect()->to(base_url() . '/profil/index');
            }
        } else {
            $x = $this->model->getDatasantri(session()->get('id_data'), 'santri');
            if (isset($getUser)) {
                $ket = [
                    'Edit Data : ' . $x->nama, '<li class="breadcrumb-item active"><a href="' . base_url() . '/profil/index">Profil</a></li>',
                    '<li class="breadcrumb-item active">Edit Profil</li>'
                ];
                $data = [
                    'title' => 'Edit Data : ' . $x->nama,
                    'ket' => $ket,
                    'user' => $getUser,
                    'link' => 'home',
                    'santri' => $x,
                    'kls' => $this->kls->getKelasS($x->id_santri),
                    'isi' => $getUser
                ];
                return view('profil/editsantri', $data);
            } else {
                session()->setFlashdata('warning_profil', 'User ' . session()->username . ' tidak ditemukan.');
                return redirect()->to(base_url() . '/profil/index');
            }
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id = $request->getPost('id');
        if (session()->get('role') == 'Pengajar') {
            $file = $request->getFile('foto');
            if ($file->getError() == 4) {
                $nm = $request->getPost('lama');
            } else {
                $nm = $file->getRandomName();
                $file->move('pengajarimg', $nm);
                if ($request->getPost('lama') != 'default.jpg') {
                    unlink('pengajarimg/' . $request->getPost('lama'));
                }
            }
            $pass = $request->getPost('pass');
            if ($pass != NULL) {
                $data = array(
                    'password' => password_hash($pass, PASSWORD_BCRYPT)
                );
                $this->user->editUser($data, session()->get('id_user'));
            }
            $data = array(
                'username' => $request->getPost('username'),
            );
            $this->user->editUser($data, session()->get('id_user'));
            $data2 = array(
                'nama' => $request->getPost('nama'),
                'tempat_lahir'   =>  $request->getPost('tempat_lahir'),
                'tgl_lahir' => $request->getPost('tgl_lahir'),
                'jk' => $request->getPost('jk'),
                'pendidikan_terakhir'   =>  $request->getPost('pendidikan_terakhir'),
                'alamat' => $request->getPost('alamat'),
                'jml_hafalan' => $request->getPost('jml_hafalan'),
                'nohp' => $request->getPost('nohp'),
                'foto' => $nm,
                'status'  =>  $request->getPost('status')
            );
            $this->pengajar->editpengajar($data2, session()->get('id_data'));
        } else {
            $file = $request->getFile('foto');
            if ($file->getError() == 4) {
                $nm = $request->getPost('lama');
            } else {
                $nm = $file->getRandomName();
                $file->move('santriimg', $nm);
                if ($request->getPost('lama') != 'default.jpg') {
                    unlink('santriimg/' . $request->getPost('lama'));
                }
            }
            $pass = $request->getPost('pass');
            if ($pass != NULL) {
                $data_pass = array(
                    'password' => password_hash($pass, PASSWORD_BCRYPT)
                );
                $this->user->editUser($data_pass, session()->get('id_user'));
            }
            $data = array(
                'username' => $request->getPost('username'),
            );
            $this->user->editUser($data, session()->get('id_user'));
            $data2 = array(
                'nama' => $request->getPost('nama'),
                'tempat_lahir'   =>  $request->getPost('tempat_lahir'),
                'tgl_lahir' => $request->getPost('tgl_lahir'),
                'jk' => $request->getPost('jk'),
                'pendidikan'   =>  $request->getPost('pendidikan'),
                'alamat' => $request->getPost('alamat'),
                'nohp' => $request->getPost('nohp'),
                'jml_hafalan' => $request->getPost('jml_hafalan'),
                'nama_ayah' => $request->getPost('nama_ayah'),
                'pekerjaan_ayah' => $request->getPost('pekerjaan_ayah'),
                'nama_ibu' => $request->getPost('nama_ibu'),
                'pekerjaan_ibu' => $request->getPost('pekerjaan_ibu'),
                'nohp_ortu' => $request->getPost('nohp_ortu'),
                'foto' => $nm
            );
            $this->model->editSantri($data2, session()->get('id_data'));
        }
        session()->setFlashdata('pesan_profil', 'Pofil berhasi diedit.');
        return redirect()->to(base_url() . '/profil/index');
    }
}
