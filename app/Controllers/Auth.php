<?php

namespace App\Controllers;

use App\Models\AuthModel;
use App\Models\PengajarModel;
use App\Models\SantriModel;

class Auth extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->model =  new AuthModel();
        $this->pengajar =  new PengajarModel();
        $this->keluarga =  new SantriModel();
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
        ];
        return view('auth/register', $data);
    }

    public function save_register()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        $validation->setRules([
            'nik' => [
                'label' => 'nik',
                'rules' => 'is_unique[users.username]|numeric|min_length[16]',
                'errors' => [
                    'min_length' => 'NIK tidak valid_user',
                    'numeric' => 'NIK berupa angka',
                    'is_unique' => 'NIK sudah terdaftar'
                ]
            ],
            'nokk' => [
                'label' => 'nokk',
                'rules' => 'numeric|min_length[16]',
                'errors' => [
                    'min_length' => 'NIK tidak valid_user',
                    'numeric' => 'NIK berupa angka'
                ]
            ],
            'email' => [
                'label' => 'email',
                'rules' => 'is_unique[users.email]',
                'errors' => [
                    'is_unique' => 'Email sudah terdaftar'
                ]
            ],
            'telp' => [
                'label' => 'telp',
                'rules' => 'is_unique[users.telp]|numeric',
                'errors' => [
                    'numeric' => 'Nomor telepon berupa angka',
                    'is_unique' => 'Nomor telepon sudah terdaftar'
                ]
            ],
            're_pass' => [
                'label' => 're_pass',
                'rules' => 'matches[pass]',
                'errors' => [
                    'matches' => 'Password tidak sama'
                ]
            ]
        ]);
        if (!$validation->withRequest($request)->run()) {
            session()->setFlashdata('error', $validation->listErrors());
            return redirect()->to(base_url() . '/auth/register');
        }

        $nik = $this->pengajar->id($request->getPost('nik'), 'nik');
        $kk = $this->keluarga->id($request->getPost('nokk'), 'no_kk');
        if ($nik != NULL and $kk != NULL) {
            if ($nik->id_keluarga == $kk->id_keluarga) {
                $data = array(
                    'id_data' => $nik->id_pengajar,
                    'email' => $request->getPost('email'),
                    'username' => $request->getPost('nik'),
                    'telp' => $request->getPost('telp'),
                    'password' => password_hash($request->getPost('pass'), PASSWORD_BCRYPT),
                    'role' => '3',
                );
                $this->model->saveUser($data);
                session()->setFlashdata('pesan_reg', 'Register berhasil');
                return redirect()->to(base_url() . '/auth/register');
            } else {
                session()->setFlashdata('error', 'NIK dan No KK tidak sesuai');
                return redirect()->to(base_url() . '/auth/register');
            }
        } elseif ($nik == NULL) {
            session()->setFlashdata('error', 'NIK tidak terdaftar');
            return redirect()->to(base_url() . '/auth/register');
        } elseif ($kk == NULL) {
            session()->setFlashdata('error', 'No KK tidak terdaftar');
            return redirect()->to(base_url() . '/auth/register');
        }
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
        ];
        return view('auth/login', $data);
    }

    public function cek_login()
    {
        $request = \Config\Services::request();
        $log = $request->getPost('log');
        $pass = $request->getPost('pass');
        $cek_telp = $this->model->login('telp', $log);
        $cek_uname = $this->model->login('username', $log);
        if ($cek_telp != NULL and password_verify($pass, $cek_telp['password'])) {
            session()->set('log', true);
            session()->set('role', $cek_telp['role']);
            session()->set('id_data', $cek_telp['id_data']);
            session()->set('username', $cek_telp['username']);
            session()->set('telp', $cek_telp['telp']);
            session()->set('id_user', $cek_telp['id_user']);
            return redirect()->to(base_url() . '/home/index');
        } elseif ($cek_uname != NULL and password_verify($pass, $cek_uname['password'])) {
            session()->set('log', true);
            session()->set('role', $cek_uname['role']);
            session()->set('id_data', $cek_uname['id_data']);
            session()->set('username', $cek_uname['username']);
            session()->set('telp', $cek_uname['telp']);
            session()->set('id_user', $cek_uname['id_user']);
            return redirect()->to(base_url() . '/home/index');
        } else {
            session()->setFlashdata('error', 'Login gagal');
            return redirect()->to(base_url() . '/auth/login');
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('role');
        session()->remove('id_data');
        session()->remove('username');
        session()->remove('telp');
        session()->setFlashdata('pesan_log', 'Logout sukses');
        return redirect()->to(base_url() . '/auth/login');
    }
}
