<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasModel extends Model
{
    protected $table = 'kelas';

    public function getKelas($id_kelas = false)
    {
        if ($id_kelas === false) {
            return $this->db->table('kelas')
                ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
                ->orderBy('kelas.id_kelas', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('kelas')
                ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
                ->where('id_kelas', $id_kelas)
                ->get()->getRow();
        }
    }

    public function santri($id_pengajar)
    {
        return $this->where('id_pengajar', $id_pengajar)->get()->getRow();
    }

    public function kelas($id_pengajar)
    {
        return $this->db->table('kelas')
            ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
            ->where('pengajar.id_pengajar', $id_pengajar)
            ->groupBy('nama_kelas')
            ->get()->getResultArray();
    }

    public function saveKelas($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editKelas($data, $id_kelas)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_kelas', $id_kelas);
        return $builder->update($data);
    }

    public function hapusKelas($id_kelas)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_kelas' => $id_kelas]);
    }

    public function tambah($data)
    {
        $this->db->table('kelas')->insert($data);
    }

    public function carikelas($nm)
    {
        return $this->db->table('kelas')
            ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
            ->join('santri', 'santri.id_santri = kelassantri.id_santri')
            ->select('kelas.id_kelas')
            ->where('nama_kelas', $nm)
            ->get()->getRow();
    }
}
