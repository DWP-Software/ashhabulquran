<?php

namespace App\Models;

use CodeIgniter\Model;

class SantriModel extends Model
{
    protected $table = 'santri';

    public function getDatasantri($id_santri = false, $kls = false)
    {
        if ($id_santri === false and $kls === false) {
            return $this->orderBy('id_santri', 'DESC')->findAll();
        } elseif ($id_santri === false and $kls != false) {
            return $this->db->table('kelas')
                ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
                ->join('santri', 'santri.id_santri = kelassantri.id_santri')
                ->where('kelassantri.id_kelas', $kls)
                ->orderBy('santri.id_santri', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->getWhere(['id_santri' => $id_santri])->getRow();
        }
    }

    public function santri($id_kelas)
    {
        return $this->db->table('kelas')
            ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
            ->join('santri', 'santri.id_santri = kelassantri.id_santri')
            ->where('kelassantri.id_kelas', $id_kelas)
            ->get()->getResultArray();
    }

    public function santritgl($id_kelas, $b, $t)
    {
        return $this->db->table('kelas')
            ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
            ->join('santri', 'santri.id_santri = kelassantri.id_santri')
            // ->join('hafalan', 'hafalan.id_santri = santri.id_santri')
            ->where('kelassantri.id_kelas', $id_kelas)
            ->where('month(tgl_masuk) <= ', $b)
            ->where('year(tgl_masuk) <= ', $t)
            ->get()->getResultArray();
    }
    ///save data
    public function saveSantri($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    ///edit data
    public function editSantri($data, $id_santri)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_santri', $id_santri);
        return $builder->update($data);
    }

    ///hapus data
    public function hapusSantri($id_santri)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_santri' => $id_santri]);
    }

    ///Import Data
    public function tambah($data)
    {
        $this->db->table('santri')->insert($data);
    }

    /// cek data untuk import
    public function cekdata($nama, $jk, $nohp)
    {
        return $this->db->table('santri')
            ->where('nama', $nama)
            ->where('jk', $jk)
            ->where('nohp', $nohp)
            ->get()->getRowArray();
    }

    public function search($no)
    {
        return $this->where('no_santri', $no)->get()->getRow();
    }

    public function tot($jekel)
    {
        return $this->db->table($this->table)->where('jk', $jekel)->countAllResults();
    }
}
