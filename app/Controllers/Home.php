<?php

namespace App\Controllers;

use App\Models\PengajarModel;
use App\Models\SantriModel;
use App\Models\GaleriModel;
// use App\Models\HafalanModel;

class Home extends BaseController
{
	protected $model;
	public function __construct()
	{
		$this->pengajar =  new PengajarModel();
		$this->santri =  new SantriModel();
		$this->galeri =  new GaleriModel();
		// $this->hafalan =  new HafalanModel();
	}
	public function index()
	{
		$ket = [
			'Beranda'
		];
		$data = [
			'title' => 'Sistem Informasi Rumah Tahfidz',
			'ket' => $ket,
			'pengajar' => $this->pengajar->countAllResults(),
			'santri' => $this->santri->countAllResults(),
			'santri_pr' => $this->santri->tot('Perempuan'),
			'santri_lk' => $this->santri->tot('Laki - Laki'),
			'gambar' => $this->galeri->paginate('3'),
			'link' => 'chart',
		];
		$data_p = $this->pengajar->getDatapengajar();
		for ($i = 0; $i < count($data_p); $i++) {
			$data_nama[$i] = $data_p[$i]['nama'];
		}

		for ($i = 0; $i < count($data_p); $i++) {
			$data_s = $this->pengajar->pengajar($data_p[$i]['id_pengajar']);
			$data_jml[$i] = $data_s->jml;
		}
		$data['data_nama'] = $data_nama;
		$data['data_jml'] = $data_jml;

		for ($i = 1; $i <= 30; $i++) {
			$jml[$i - 1] = $this->pengajar->juz($i)->jml;
		}
		$data['juz'] = $jml;
		// dd($data);
		return view('beranda/index', $data);
	}
}
