<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\SantriModel;
use App\Models\KelasModel;
use App\Models\KelasSModel;
use App\Models\AuthModel;
use Config\Validation;

class Santri extends Controller
{
    protected $model;
    public function __construct()
    {
        helper('form');
        $this->model =  new SantriModel();
        $this->kelas =  new KelasModel();
        $this->kls =  new KelasSModel();
        $this->user =  new AuthModel();
    }

    public function index()
    {
        // dd($this->model->getPeriode());
        $data['title'] = 'Data santri';
        $data['getDatasantri'] = $this->model->getDatasantri();
        $data['ket'] = ['Data santri', '<li class="breadcrumb-item active"><a href="/santri">Data santri</a></li>'];
        return view('santri/index', $data);
    }

    public function input()
    {
        $data['title'] = 'Tambah santri';
        $data['kelas'] = $this->kelas->getKelas();
        $data['ket'] = ['Input Data santri', '<li class="breadcrumb-item active"><a href="/santri">Data santri</a></li>', '<li class="breadcrumb-item active">Input Data santri<li>'];
        return view('santri/input', $data);
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
            $file->move('santriimg');
        }
        $no = 'S' . date('y', strtotime($request->getPost('tgl_masuk')));
        $data = array(
            'no_santri' => $no,
            'nama' => $request->getPost('nama'),
            'tempat_lahir'   =>  $request->getPost('tempat_lahir'),
            'tgl_lahir' => $request->getPost('tgl_lahir'),
            'jk' => $request->getPost('jk'),
            'pendidikan'   =>  $request->getPost('pendidikan'),
            'alamat' => $request->getPost('alamat'),
            'nohp' => $request->getPost('nohp'),
            'jml_hafalan' => $request->getPost('jml_hafalan'),
            'tgl_masuk'   =>  $request->getPost('tgl_masuk'),
            'nama_ayah' => $request->getPost('nama_ayah'),
            'pekerjaan_ayah' => $request->getPost('pekerjaan_ayah'),
            'nama_ibu' => $request->getPost('nama_ibu'),
            'pekerjaan_ibu' => $request->getPost('pekerjaan_ibu'),
            'nohp_ortu' => $request->getPost('nohp_ortu'),
            'foto' => $nm
        );
        $this->model->saveSantri($data);
        $ids = $this->model->search($no);
        $datas = array(
            'id_kelas' => $request->getPost('kelas'),
            'id_santri' => $ids->id_santri,
        );
        $this->kls->saveKelasS($datas);
        $no = $this->model->search('S' . date('y', strtotime($request->getPost('tgl_masuk'))));
        $id = ['no_santri' => 'S' . date('y', strtotime($request->getPost('tgl_masuk'))) . sprintf('%04s', ($no->id_santri))];
        $this->model->editsantri($id, $no->id_santri);

        $data_user = array(
            'id_data' => $no->id_santri,
            'username' => $id,
            'password' => password_hash('12345678', PASSWORD_BCRYPT),
            'telp' => $request->getPost('nohp'),
            'role'   =>  'Santri'
        );
        $this->user->saveUser($data_user);

        session()->setFlashdata('pesan_santri', 'Data santri Ditambahkan.');
        return redirect()->to('/santri/index');
    }

    public function edit($id_santri)
    {
        $getDatasantri = $this->model->getDatasantri($id_santri);
        if (isset($getDatasantri)) {
            $data['santri'] = $getDatasantri;
            $data['kelas'] = $this->kelas->getKelas();
            $data['kls'] = $this->kls->getKelasS($id_santri);
            // dd($data['kls']);
            $data['title']  = 'Edit Data ';
            // dd($data);
            $data['ket'] = ['Edit Data santri', '<li class="breadcrumb-item active"><a href="/santri">Data santri</a></li>', '<li class="breadcrumb-item active">Edit Data santri<li>'];
            // dd($data['santri']);
            return view('santri/edit', $data);
        } else {

            session()->setFlashdata('pesan_santri', 'ID santri ' . $id_santri . ' Tidak Ditemukan.');
            return redirect()->to('/santri');
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
            $file->move('santriimg');
            if ($request->getPost('lama') == 'default.jpg') {
                // continue;
            } else {
                // unlink('santriimg/' . $request->getPost('lama'));
            }
        }

        $id_santri = $request->getPost('id_santri');
        $no = 'S' . date('y', strtotime($request->getPost('tgl_masuk'))) . date('Y', strtotime($request->getPost('tgl_lahir')));
        // dd($no);
        $data = array(
            'no_santri' => $no,
            'nama' => $request->getPost('nama'),
            'tempat_lahir'   =>  $request->getPost('tempat_lahir'),
            'tgl_lahir' => $request->getPost('tgl_lahir'),
            'jk' => $request->getPost('jk'),
            'pendidikan'   =>  $request->getPost('pendidikan'),
            'alamat' => $request->getPost('alamat'),
            'nohp' => $request->getPost('nohp'),
            'jml_hafalan' => $request->getPost('jml_hafalan'),
            'tgl_masuk'   =>  $request->getPost('tgl_masuk'),
            'nama_ayah' => $request->getPost('nama_ayah'),
            'pekerjaan_ayah' => $request->getPost('pekerjaan_ayah'),
            'nama_ibu' => $request->getPost('nama_ibu'),
            'pekerjaan_ibu' => $request->getPost('pekerjaan_ibu'),
            'nohp_ortu' => $request->getPost('nohp_ortu'),
            'foto' => $nm
        );
        $this->model->editSantri($data, $id_santri);
        $ids = $this->model->search($no);
        $kls = $this->kls->getKelasS($id_santri);
        $datas = array(
            'id_kelas' => $request->getPost('kelas'),
            'id_santri' => $ids->id_santri,
        );
        $this->kls->editKelasS($datas, $kls->id);
        $no = $this->model->search('S' . date('y', strtotime($request->getPost('tgl_masuk'))) . date('Y', strtotime($request->getPost('tgl_lahir'))));
        // dd($no);
        $id = ['no_santri' => 'S' . date('y', strtotime($request->getPost('tgl_masuk'))) . sprintf('%04s', ($no->id_santri))];
        $this->model->editsantri($id, $no->id_santri);

        $id_s = $this->user->cari($id_santri, 'Santri');
        $data_user = array(
            'id_data' => $id_santri,
            'telp' => $request->getPost('nohp')
        );
        $this->user->editUser($data_user, $id_s->id_user);

        session()->setFlashdata('pesan_santri', 'Data santri Berhasi Diedit.');
        return redirect()->to('/santri');
    }

    public function delete($id_santri)
    {
        $getDatasantri = $this->model->getDatasantri($id_santri);
        if (isset($getDatasantri)) {
            $a = $this->kls->cari($id_santri);
            // dd($a);
            $this->kls->hapusKelasS($a->id);
            $this->model->hapusSantri($id_santri);
            session()->setFlashdata('danger_santri', 'Data santri Berhasi Dihapus.');
            return redirect()->to('/santri/index');
        } else {
            session()->setFlashdata('warning_santri', 'Data santri Tidak Ditemukan.');
            return redirect()->to('/santri/index');
        }
    }

    public function view($id_santri)
    {
        $data['title'] = 'View Data santri';
        $data['getDatasantri'] = $this->model->getDatasantri($id_santri);
        $data['ket'] = ['View Data santri', '<li class="breadcrumb-item active"><a href="/santri">Data santri</a></li>', '<li class="breadcrumb-item active">View Data santri<li>'];
        return view('santri/view', $data);
    }

    public function import()
    {
        $data['title']  = 'Import Data santri';
        $data['ket'] = ['Import Data Santri', '<li class="breadcrumb-item active"><a href="/santri">Data Santri</a></li>', '<li class="breadcrumb-item active">Import Data Santri<li>'];
        return view('santri/import', $data);
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
            session()->setFlashdata('warning_santri', 'Ekstensi File Salah, Silahkan Pilih File Ber-ekstensi Excel.');
            return redirect()->to('/santri/import');
        }
        $spreadsheet = $render->load($file);
        $sheet = $spreadsheet->getActiveSheet()->toArray();

        foreach ($sheet as $x => $excel) {
            if ($x == 0) {
                continue;
            }
            $id_santri = $this->model->cekdata($excel[1], $excel[3], $excel[2]) ?? ['nama' => ''];

            if ($excel[1] == $id_santri['nama']) {
                continue;
            }

            if ($excel[2] == 'P' or $excel[2] == 'p' or $excel[2] == 'perempuan' or $excel[2] == 'Perempuan') {
                $jk = 'Perempuan';
            } else {
                $jk = 'Laki - Laki';
            }

            $no = 'S' . date('y', strtotime($excel[4]));
            $data = array(
                'no_santri' => $no,
                'nama' => $excel[1],
                'jk' => $jk,
                'nohp' => $excel[3],
                'tgl_masuk'   => $excel[4],
            );
            $this->model->saveSantri($data);
            $ids = $this->model->search($no);
            // $kls = $this->kelas->carikelas($excel[5]);

            $datas = array(
                'id_kelas' => $excel[5],
                'id_santri' => $ids->id_santri,
            );
            // dd($datas);
            $this->kls->saveKelasS($datas);
            $no = $this->model->search('S' . date('y', strtotime($excel[4])));
            $id = ['no_santri' => 'S' . date('y', strtotime($excel[4])) . sprintf('%04s', ($no->id_santri))];
            $this->model->editsantri($id, $no->id_santri);

            $data_user = array(
                'id_data' => $no->id_santri,
                'username' => $id,
                'password' => password_hash('12345678', PASSWORD_BCRYPT),
                'telp' => $excel[3],
                'role'   =>  'Santri'
            );
            $this->user->saveUser($data_user);
        }

        session()->setFlashdata('pesan_santri', 'Data santri Berhasi Diimport.');
        return redirect()->to('/santri/index');
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_santri = $request->getPost('id_santri');
        if ($id_santri == null) {
            session()->setFlashdata('warning', 'Data santri Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('/santri');
        }

        $jmldata = count($id_santri);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->model->hapusSantri($id_santri[$i]);
        }

        session()->setFlashdata('pesan', 'Data santri Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
        return redirect()->to('/santri');
    }
}
