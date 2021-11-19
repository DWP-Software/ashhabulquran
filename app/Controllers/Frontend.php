<?php

namespace App\Controllers;

use App\Models\RumahtahfidzModel;
use App\Models\GaleriModel;


class Frontend extends BaseController
{
    protected $galeri;
    public function __construct()
    {
        $this->rumahtahfidz =  new RumahtahfidzModel();
        helper('form');
        $this->galeri = new GaleriModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Sistem Informasi Rumah Tahfidz',
            'map' => $this->rumahtahfidz->getRumahtahfidz(1),
            'telp' => $this->rumahtahfidz->getRumahtahfidz(1),
            'gambar' => $this->galeri->getGaleri(1)

        ];
        // dd($data);
        $data['galeri'] = $this->galeri->getGaleri();
        $data['galeri'] = $this->galeri->getData("3");
        $data['nama_kegiatan'] = $this->galeri->getGaleri();
        // dd($data);
        return view('frontend/home', $data);
    }
}
