<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajarModel extends Model
{
    protected $table = 'pengajar';

    public function getDatapengajar($id_pengajar = false, $id = false)
    {
        if ($id_pengajar === false and $id === false) {
            return $this->db->table('pengajar')
                ->join('kelas', 'kelas.id_pengajar = pengajar.id_pengajar')
                ->orderBy('pengajar.id_pengajar', 'DESC')
                ->groupBy('nama')
                ->get()->getResultArray();
        } elseif ($id_pengajar === false and $id != false) {
            return $this->db->table('pengajar')
                ->join('kelas', 'kelas.id_pengajar = pengajar.id_pengajar')
                ->where('pengajar.id_pengajar', $id)
                ->orderBy('pengajar.id_pengajar', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('pengajar')
                // ->join('kelas', 'kelas.id_pengajar = pengajar.id_pengajar')
                ->getWhere(['pengajar.id_pengajar' => $id_pengajar])->getRow();
        }
    }

    public function data()
    {
        return $this->db->table('pengajar')
            ->join('kelas', 'kelas.id_pengajar = pengajar.id_pengajar')
            ->orderBy('pengajar.id_pengajar', 'DESC')
            ->get()->getResultArray();
    }

    public function data_satu()
    {
        return $this->db->table('pengajar')
            ->orderBy('pengajar.id_pengajar', 'DESC')
            ->get()->getResultArray();
    }

    public function pengajar($id = false)
    {
        if ($id != false) {
            return $this->db->table('pengajar')
                ->select('pengajar.nama as nama, count(id_santri) as jml')
                ->join('kelas', 'kelas.id_pengajar = pengajar.id_pengajar')
                ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
                ->where('pengajar.id_pengajar', $id)
                // ->orderBy('pengajar.id_pengajar', 'DESC')
                // ->groupBy('pengajar.id_pengajar')
                // ->get()->getResultArray();
                ->get()->getRow();
        } else {
            return $this->db->table('pengajar')
                ->join('kelas', 'kelas.id_pengajar = pengajar.id_pengajar')->orderBy('pengajar.id_pengajar', 'DESC')
                ->get()->getResultArray();
        }
    }

    public function juz($id)
    {
        return $this->db->table('pengajar')
            ->select('count(santri.id_santri) as jml')
            ->join('kelas', 'kelas.id_pengajar = pengajar.id_pengajar')
            ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
            ->join('santri', 'kelassantri.id_santri = santri.id_santri')
            ->where('santri.jml_hafalan', $id)
            ->get()->getRow();
    }

    ///save data
    public function savePengajar($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    ///edit data
    public function editPengajar($data, $id_pengajar)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_pengajar', $id_pengajar);
        return $builder->update($data);
    }

    ///hapus data
    public function hapusPengajar($id_pengajar)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_pengajar' => $id_pengajar]);
    }

    ///Import Data
    public function tambah($data)
    {
        $this->db->table('pengajar')->insert($data);
    }

    /// cek data untuk import
    public function cekdata($nama, $tgl_lahir, $tempat_lahir)
    {
        return $this->db->table('pengajar')
            ->where('nama', $nama)
            ->where('tgl_lahir', $tgl_lahir)
            ->where('tempat_lahir', $tempat_lahir)
            ->get()->getRowArray();
    }

    public function cetak($t)
    {
        return $this->db->table('pengajar')
            ->where('thn_masuk <=', $t)
            ->orderBy('pengajar.id_pengajar', 'DESC')
            ->groupBy('nama')
            ->get()->getResultArray();
    }

    public function search($no)
    {
        return $this->where('no_pengajar', $no)->get()->getRow();
    }
}
