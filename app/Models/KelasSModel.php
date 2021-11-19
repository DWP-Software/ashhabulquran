<?php

namespace App\Models;

use CodeIgniter\Model;

class KelasSModel extends Model
{
    protected $table = 'kelassantri';

    public function getKelasS($id = false)
    {
        if ($id === false) {
            return $this->db->table('kelassantri')
                ->join('santri', 'santri.id_santri = kelassantri.id_santri')
                ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
                ->orderBy('nama_kelas', 'ASC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('kelassantri')
                ->join('santri', 'santri.id_santri = kelassantri.id_santri')
                ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
                ->where('santri.id_santri', $id)
                ->get()->getRow();
        }
    }

    ///save data
    public function saveKelasS($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    ///edit data
    public function editKelasS($data, $id)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id', $id);
        return $builder->update($data);
    }

    ///hapus data
    public function hapusKelasS($id)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id' => $id]);
    }

    public function cari($data)
    {
        return $this->db->table($this->table)->where('id_santri', $data)->get()->getRow();
    }
}
