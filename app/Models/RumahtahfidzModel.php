<?php

namespace App\Models;

use CodeIgniter\Model;

class RumahtahfidzModel extends Model
{
    protected $table = 'rumahtahfidz';

    public function getRumahtahfidz($id_rumahtahfidz = false)
    {
        if ($id_rumahtahfidz === false) {
            return $this->orderBy('id_rumahtahfidz', 'DESC')->findAll();
        } else {
            return $this->getWhere(['id_rumahtahfidz' => $id_rumahtahfidz])->getRow();
        }
    }

    public function saveRumahtahfidz($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editRumahtahfidz($data)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_rumahtahfidz', '1');
        return $builder->update($data);
    }
}
