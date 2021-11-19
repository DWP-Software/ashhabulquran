<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthModel extends Model
{
    protected $table = 'user';

    public function getUser($id = false, $role = false)
    {
        if ($id == false and $role != false) {
            return $this->where('role', $role)->orderBy('id_user', 'DESC')->findAll();
        } elseif ($id != false and $role != false) {
            return $this->where('role', $role)->getWhere(['id_user' => $id])->getRow();
        } else {
            return $this->getWhere(['id_user' => $id])->getRow();
        }
    }

    public function cari($id = false, $role = false)
    {
        return $this->where('role', $role)->getWhere(['id_data' => $id])->getRow();
    }

    public function saveUser($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editUser($data, $id_user)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_user', $id_user);
        return $builder->update($data);
    }

    public function hapusUser($id_user)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_user' => $id_user]);
    }

    public function login($x, $log)
    {
        return $this->where($x, $log)->get()->getRowArray();
    }
}
