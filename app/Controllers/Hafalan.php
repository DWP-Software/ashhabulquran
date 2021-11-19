<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\KelasModel;
use App\Models\KelasSModel;
use App\Models\PengajarModel;
use App\Models\HafalanModel;
use App\Models\SurahModel;
use App\Models\SantriModel;

class Hafalan extends Controller
{
    public function __construct()
    {
        helper('form');
        $this->hafalan =  new HafalanModel();
        $this->kelas =  new KelasModel();
        $this->kls =  new KelasSModel();
        $this->pengajar =  new PengajarModel();
        $this->surah =  new SurahModel();
        $this->santri =  new SantriModel();
    }

    public function index()
    {
        // dd($this->hafalan->getPeriode());
        $data['title'] = 'Data Hafalan';
        if (session()->get('role') == 'Santri') {
            $data['getHafalan'] = $this->hafalan->getHafalan(false, session()->get('id_data'), false);
        } elseif (session()->get('role') == 'Pengajar') {
            $x = $this->pengajar->getDatapengajar(session()->get('id_data'));
            $data['getHafalan'] = $this->hafalan->getHafalan(false, false, $x->id_pengajar);
        } else {
            $data['getHafalan'] = $this->hafalan->getHafalan();
        }
        $data['ket'] = ['Data Hafalan', '<li class="breadcrumb-item active"><a href="/hafalan">Data Hafalan</a></li>'];
        return view('hafalan/index', $data);
    }

    public function input()
    {
        $data['title'] = 'Tambah Hafalan';
        $data['pengajar'] = $this->pengajar->getDatapengajar();

        if (session()->get('role') == 'Pengajar') {
            $data['kelas'] = $this->kelas->kelas(session()->get('id_data'));
        } elseif (session()->get('role') == 'Admin') {
            $data['kelas'] = $this->kelas->getKelas();
        } else {
            $s = $this->surah->getSurah();
            $j = 0;
            for ($i = 0; $i < count($s); $i++) {
                $x = $this->hafalan->isisurah(session()->get('id_data'), $i + 1);
                if ($x == NULL) {
                    $surah[$j]['id_surah'] = $s[$i]['id_surah'];
                    $surah[$j]['nama_surah'] = $s[$i]['nama_surah'];
                    $surah[$j]['juz'] = $s[$i]['juz'];
                    $j++;
                }
            }
            $data['surah'] = $surah;
        }
        $data['ket'] = ['Input Data Hafalan', '<li class="breadcrumb-item active"><a href="/hafalan">Data Hafalan</a></li>', '<li class="breadcrumb-item active">Input Data Kelas<li>'];
        return view('hafalan/input', $data);
    }

    public function getsantri($id_kelas)
    {
        $data = $this->santri->santri($id_kelas);
        for ($i = 0; $i < count($data); $i++) {
            $json[$i]['id_santri'] = $data[$i]['id_santri'];
            $json[$i]['nama'] = $data[$i]['nama'];
        }
        return $this->response->setJson($json);
    }

    public function surah($id_surah)
    {
        $data = $this->surah->getSurah($id_surah);
        $haf = $this->hafalan->surah(session()->id_data, $id_surah);
        $json = array();
        if ($haf == NULL) {
            $json['awal'] = $data->awal;
        } else {
            $json['awal'] = $haf->akhir_hafalan + 1;
        }
        return $this->response->setJson($json);
    }

    public function san($id_santri)
    {
        $s = $this->surah->getSurah();
        $j = 0;
        for ($i = 0; $i < count($s); $i++) {
            $x = $this->hafalan->isisurah($id_santri, $i + 1);
            if ($x == NULL) {
                $json[$j]['id_surah'] = $s[$i]['id_surah'];
                $json[$j]['nama_surah'] = $s[$i]['nama_surah'];
                $json[$j]['juz'] = $s[$i]['juz'];
                $j++;
            }
        }
        return $this->response->setJson($json);
    }

    public function add()
    {
        $request = \Config\Services::request();
        if ($request->getPost('status') != NULL) {
            $x = $request->getPost('status');
        } else {
            $x = 'Belum Selesai';
        }
        if (session()->get('role') == 'Santri') {
            $isiid = session()->id_data;
        } else {
            $isiid = $request->getPost('id_santri');
        }
        $data = array(
            'id_santri' => $isiid,
            'id_surah' => $request->getPost('id_surah'),
            'tgl_setor'   =>  $request->getPost('tgl_setor'),
            'awal_hafalan' => $request->getPost('awal'),
            'akhir_hafalan' => $request->getPost('akhir'),
            'keterangan' => $request->getPost('ket'),
            'status' => $x
        );
        $this->hafalan->saveHafalan($data);
        session()->setFlashdata('pesan_hafalan', 'Data Hafalan Ditambahkan.');
        return redirect()->to('/hafalan/index');
    }

    public function edit($id_hafalan)
    {
        $getHafalan = $this->hafalan->getHafalan($id_hafalan);
        if (isset($getHafalan)) {
            $data['title']  = 'Edit Data ';
            $data['pengajar'] = $this->pengajar->getDatapengajar();
            $data['surah'] = $this->surah->getSurah();
            $data['hafalan'] = $getHafalan;
            if (session()->get('role') == 'Pengajar') {
                $data['kelas'] = $this->kelas->kelas(session()->get('id_data'));
                $k = $this->kls->cari($getHafalan->id_santri);
                $data['k'] = $k;
                $data['santri'] = $this->santri->santri($k->id_kelas);
            } elseif (session()->get('role') == 'Admin') {
                $data['kelas'] = $this->kelas->getKelas();
                $k = $this->kls->cari($getHafalan->id_santri);
                $data['k'] = $k;
                $data['santri'] = $this->santri->santri($k->id_kelas);
            } else {
                $s = $this->surah->getSurah();
                $j = 0;
                for ($i = 0; $i < count($s); $i++) {
                    $x = $this->hafalan->isisurah(session()->get('id_data'), $i + 1);
                    if ($x == NULL) {
                        $surah[$j]['id_surah'] = $s[$i]['id_surah'];
                        $surah[$j]['nama_surah'] = $s[$i]['nama_surah'];
                        $surah[$j]['juz'] = $s[$i]['juz'];
                        $j++;
                    }
                }
                $data['surah'] = $surah;
            }
            $data['ket'] = ['Edit Data hafalan', '<li class="breadcrumb-item active"><a href="/hafalan">Data hafalan</a></li>', '<li class="breadcrumb-item active">Edit Data hafalan<li>'];
            return view('hafalan/edit', $data);
        } else {

            session()->setFlashdata('pesan_hafalan', 'ID hafalan ' . $id_hafalan . ' Tidak Ditemukan.');
            return redirect()->to('/hafalan');
        }
    }

    public function update()
    {
        $request = \Config\Services::request();
        $id_hafalan = $request->getPost('id_hafalan');
        if ($request->getPost('status') != NULL) {
            $x = $request->getPost('status');
        } else {
            $x = 'Belum Selesai';
        }

        if ($request->getPost('status') != NULL) {
            $san = $request->getPost('id_santri');
        } else {
            $san = session()->id_data;
        }
        $data = array(
            'id_santri' => $san,
            'id_surah' => $request->getPost('id_surah'),
            'tgl_setor'   =>  $request->getPost('tgl_setor'),
            'awal_hafalan' => $request->getPost('awal'),
            'akhir_hafalan' => $request->getPost('akhir'),
            'keterangan' => $request->getPost('ket'),
            'status' => $x
        );
        $this->hafalan->editHafalan($data, $id_hafalan);

        $haf = $this->hafalan->getHafalan($id_hafalan);
        $srh = $this->surah->getSurah($haf->id_surah);
        $srh_jml = $this->surah->juz($haf->juz);
        // dd($srh_jml);
        $santri = $this->santri->getDataSantri($haf->id_santri);
        if ($haf->akhir_hafalan == $srh->akhir and $srh_jml->id_surah == $haf->juz and $x == 'Selesai') {
            $data = array(
                'jml_hafalan' => $santri->jml_hafalan + 1
            );
            $this->santri->editSantri($data, $haf->id_santri);
        }
        session()->setFlashdata('pesan_hafalan', 'Data Hafalan Berhasi Diedit.');
        return redirect()->to('/hafalan');
    }

    public function delete($id_hafalan)
    {
        $getHafalan = $this->hafalan->getHafalan($id_hafalan);
        if (isset($getHafalan)) {
            $this->hafalan->hapusHafalan($id_hafalan);

            session()->setFlashdata('danger_hafalan', 'Data Hafalan Berhasi Dihapus.');
            return redirect()->to('/hafalan/index');
        } else {
            session()->setFlashdata('warning_hafalan', 'Data Hafalan Tidak Ditemukan.');
            return redirect()->to('/hafalan/index');
        }
    }

    public function view($id_hafalan)
    {
        $data['title'] = 'View Data Hafalan';
        $data['ket'] = ['View Data Hafalan', '<li class="breadcrumb-item active"><a href="/hafalan">Data Hafalan</a></li>', '<li class="breadcrumb-item active">View Data Kelas<li>'];
        $h = $this->hafalan->getHafalan($id_hafalan);
        $data['hafalan'] = $h;
        // $data['santri'] = $this->santri->getDataSantri($h->id_santri);
        return view('hafalan/view', $data);
    }

    public function hapusbanyak()
    {
        $request = \Config\Services::request();
        $id_hafalan = $request->getPost('id_hafalan');
        if ($id_hafalan == null) {
            session()->setFlashdata('warning', 'Data Hafalan Belum Dipilih, Silahkan Pilih Data Terlebih Dahulu.');
            return redirect()->to('/hafalan');
        }

        $jmldata = count($id_hafalan);
        for ($i = 0; $i < $jmldata; $i++) {
            $this->hafalan->hapusHafalan($id_hafalan[$i]);
        }

        session()->setFlashdata('pesan', 'Data Hafalan Berhasi Dihapus Sebanyak ' . $jmldata . ' Data.');
        return redirect()->to('/hafalan');
    }

    public function hafalansantri()
    {
        // dd($this->hafalan->getPeriode());
        $data['title'] = 'Data Hafalan';
        $data['getHafalan'] = $this->hafalan->getHafalan(false, session()->get('id_data'), false);
        $data['ket'] = ['Data Hafalan', '<li class="breadcrumb-item active"><a href="/hafalan">Data Hafalan</a></li>'];
        return view('hafalan/hafalansantri', $data);
    }
}
