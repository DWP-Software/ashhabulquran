<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\PengajarModel;
use App\Models\AuthModel;
use Config\Validation;

class Pengajar extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->model =  new PengajarModel();
        $this->user =  new AuthModel();
    }

    public function index()
    {
        // dd($this->model->getPeriode());
        $data['title'] = 'Data Pengajar';
        $data['getDatapengajar'] = $this->model->data();
        $data['ket'] = ['Data Pengajar', '<li class="breadcrumb-item active"><a href="/pengajar">Data Pengajar</a></li>'];
        return view('pengajar/index', $data);
    }

    public function input()
    {
        $data['title'] = 'Tambah pengajar';
        $data['ket'] = ['Input Data Pengajar', '<li class="breadcrumb-item active"><a href="/pengajar">Data Pengajar</a></li>', '<li class="breadcrumb-item active">Input Data Pengajar<li>'];
        return view('pengajar/input', $data);
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
            $file->move('pengajarimg', $nm);
        }
        $data = array(
            'no_pengajar' => 'P' . $request->getPost('thn_masuk'),
            'nama' => $request->getPost('nama'),
            'tempat_lahir'   =>  $request->getPost('tempat_lahir'),
            'tgl_lahir' => $request->getPost('tgl_lahir'),
            'jk' => $request->getPost('jk'),
            'pendidikan_terakhir'   =>  $request->getPost('pendidikan_terakhir'),
            'alamat' => $request->getPost('alamat'),
            'jml_hafalan' => $request->getPost('jml_hafalan'),
            'thn_masuk'   =>  $request->getPost('thn_masuk'),
            'nohp' => $request->getPost('nohp'),
            'foto' => $nm,
            'keterangan'  =>  $request->getPost('keterangan'),
            'status'  =>  $request->getPost('status')
        );
        $this->model->savePengajar($data);

        $no = $this->model->search('P' . $request->getPost('thn_masuk'));
        $id = ['no_pengajar' => 'P' . $request->getPost('thn_masuk') . sprintf('%04s', ($no->id_pengajar))];
        $this->model->editPengajar($id, $no->id_pengajar);

        $data_user = array(
            'id_data' => $no->id_pengajar,
            'username' => $id,
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
            'telp' => $request->getPost('nohp'),
            'role'   =>  'Pengajar'
        );
        $this->user->saveUser($data_user);

        session()->setFlashdata('pesan_pengajar', 'Data pengajar Ditambahkan.');
        return redirect()->to('/pengajar/index');
    }

    public function edit($id_pengajar)
    {
        $getDatapengajar = $this->model->getDatapengajar($id_pengajar);
        if (isset($getDatapengajar)) {
            $data['pengajar'] = $getDatapengajar;
            $data['title']  = 'Edit Data ';
            $data['ket'] = ['Edit Data Pengajar', '<li class="breadcrumb-item active"><a href="/pengajar">Data Pengajar</a></li>', '<li class="breadcrumb-item active">Edit Data Pengajar<li>'];
            // dd($data['pengajar']);
            return view('pengajar/edit', $data);
        } else {

            session()->setFlashdata('pesan_pengajar', 'ID pengajar ' . $id_pengajar . ' Tidak Ditemukan.');
            return redirect()->to('/pengajar');
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
            $file->move('pengajarimg', $nm);
            if ($request->getPost('lama') == 'default.jpg') {
                // continue;
            } else {
                // unlink('pengajarimg/' . $request->getPost('lama'));
            }
        }

        $id_pengajar = $request->getPost('id_pengajar');
        $data = array(
            'nama' => $request->getPost('nama'),
            'tempat_lahir'   =>  $request->getPost('tempat_lahir'),
            'tgl_lahir' => $request->getPost('tgl_lahir'),
            'jk' => $request->getPost('jk'),
            'pendidikan_terakhir'   =>  $request->getPost('pendidikan_terakhir'),
            'alamat' => $request->getPost('alamat'),
            'jml_hafalan' => $request->getPost('jml_hafalan'),
            'thn_masuk'   =>  $request->getPost('thn_masuk'),
            'nohp' => $request->getPost('nohp'),
            'foto' => $nm,
            'keterangan'  =>  $request->getPost('keterangan'),
            'status'  =>  $request->getPost('status')
        );
        $this->model->editpengajar($data, $id_pengajar);

        $id_p = $this->user->cari($id_pengajar, 'Pengajar');
        $data_user = array(
            'id_data' => $id_pengajar,
            'telp' => $request->getPost('nohp')
        );
        $this->user->editUser($data_user, $id_p->id_user);

        session()->setFlashdata('pesan_pengajar', 'Data pengajar Berhasi Diedit.');
        return redirect()->to('/pengajar');
    }

    public function delete($id_pengajar)
    {
        $getDatapengajar = $this->model->getDatapengajar($id_pengajar);
        if (isset($getDatapengajar)) {
            $this->model->hapuspengajar($id_pengajar);

            session()->setFlashdata('danger_pengajar', 'Data pengajar Berhasi Dihapus.');
            return redirect()->to('/pengajar/index');
        } else {
            session()->setFlashdata('warning_pengajar', 'Data pengajar Tidak Ditemukan.');
            return redirect()->to('/pengajar/index');
        }
    }

    public function view($id_pengajar)
    {
        $data['title'] = 'View Data pengajar';
        $data['getDatapengajar'] = $this->model->getDatapengajar($id_pengajar);
        // dd($data);
        $data['ket'] = ['View Data Pengajar', '<li class="breadcrumb-item active"><a href="/pengajar">Data Pengajar</a></li>', '<li class="breadcrumb-item active">View Data Pengajar<li>'];
        return view('pengajar/view', $data);
    }

    public function import()
    {
        $data['title']  = 'Import Data pengajar';
        $data['ket'] = ['Import Data Pengajar', '<li class="breadcrumb-item active"><a href="/pengajar">Data Pengajar</a></li>', '<li class="breadcrumb-item active">Import Data Pengajar<li>'];
        return view('pengajar/import', $data);
    }

    public function proses()
    {
        $request = \Config\Services::request();
        $file = $request->getFile('file_excel');
        $ext = $file->getClientExtension();

        if ($ext == 'xls') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        } elseif ($ext == 'xlsx') {
            $render = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        } else {
            session()->setFlashdata('warning_pengajar', 'Ekstensi File Salah, Silahkan Pilih File Ber-ekstensi Excel.');
            return redirect()->to('/pengajar/import');
        }
        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $x => $excel) {
            if ($x == 0) {
                continue;
            }
            $id_pengajar = $this->model->cekdata($excel[1], $excel[3], $excel[2]) ?? ['nama' => ''];

            if ($excel[1] == $id_pengajar['nama']) {
                continue;
            }

            if ($excel[4] == 'P' or $excel[4] == 'p' or $excel[4] == 'perempuan' or $excel[4] == 'Perempuan') {
                $jk = 'Perempuan';
            } else {
                $jk = 'Laki - Laki';
            }


            $data = [
                'no_pengajar' => 'P' . $excel['5'],
                'nama' => $excel['1'],
                'tempat_lahir' => $excel['2'],
                'tgl_lahir' => $excel['3'],
                'jk' => $jk,
                'thn_masuk' => $excel['5'],
                'nohp' => $excel['6'],
                'foto' => "default.jpg",
                'keterangan' => $excel['7'],
            ];
            $this->model->tambah($data);

            $no = $this->model->search('P' . $excel['5']);
            $id = ['no_pengajar' => 'P' . $excel['5'] . sprintf('%04s', ($no->id_pengajar))];
            $this->model->editPengajar($id, $no->id_pengajar);

            $data_user = array(
                'id_data' => $no->id_pengajar,
                'username' => $id,
                'password' => password_hash('12345678', PASSWORD_BCRYPT),
                'telp' => $excel['6'],
                'role'   =>  'Pengajar'
            );
            $this->user->saveUser($data_user);
        }

        session()->setFlashdata('pesan_pengajar', 'Data pengajar Berhasi Diimport.');
        return redirect()->to('/pengajar/index');
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_pengajar = $request->getPost('id_pengajar');
        if ($id_pengajar == null) {
            session()->setFlashdata('warning', 'Data pengajar Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('/pengajar');
        }

        $jmldata = count($id_pengajar);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapuspengajar($id_pengajar[$i]);
        }

        session()->setFlashdata('pesan', 'Data pengajar Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
        return redirect()->to('/pengajar');
    }
}
