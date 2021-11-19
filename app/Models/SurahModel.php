<?php

namespace App\Models;

use CodeIgniter\Model;

class SurahModel extends Model
{
    protected $table = 'surah';

    public function getSurah($id_surah = false)
    {
        if ($id_surah === false) {
            return $this->findAll();
        } else {
            return $this->getWhere(['id_surah' => $id_surah])->getRow();
        }
    }

    public function juz($id)
    {
        return $this->where('juz', $id)->orderBy('id_surah', 'DESC')->get()->getRow();
    }

    public function saveSurah($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editSurah($data, $id_surah)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_surah', $id_surah);
        return $builder->update($data);
    }

    public function hapusSurah($id_surah)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_surah' => $id_surah]);
    }
}
