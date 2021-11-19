<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenPengajarModel extends Model
{
    protected $table = 'absenpengajar';

    public function getAbsenPengajar($id_absen = false, $id = false)
    {
        if ($id_absen === false and $id === false) {
            return $this->db->table('absenpengajar')
                ->select('id_absen, tanggal, nama, absenpengajar.keterangan, nama_kelas')
                ->join('pengajar', 'pengajar.id_pengajar = absenpengajar.id_pengajar')
                ->join('kelas', 'kelas.id_kelas = absenpengajar.id_kelas')
                ->orderBy('id_absen', 'DESC')
                ->get()->getResultArray();
        } elseif ($id_absen === false and $id != false) {
            return $this->db->table('absenpengajar')
                ->select('id_absen, tanggal, nama, absenpengajar.keterangan, nama_kelas')
                ->join('pengajar', 'pengajar.id_pengajar = absenpengajar.id_pengajar')
                ->join('kelas', 'kelas.id_kelas = absenpengajar.id_kelas')
                ->where('absenpengajar.id_pengajar', $id)
                ->orderBy('id_absen', 'DESC')
                ->get()->getResultArray();
        } elseif ($id_absen != false and $id === false) {
            return $this->db->table('absenpengajar')
                // ->select('id_absen, tanggal, nama, absenpengajar.keterangan, nama_kelas')
                ->join('pengajar', 'pengajar.id_pengajar = absenpengajar.id_pengajar')
                ->join('kelas', 'kelas.id_kelas = absenpengajar.id_kelas')
                ->where('id_absen', $id_absen)
                ->get()->getRow();
        }
    }

    public function absen($id, $b, $y)
    {
        return $this->db->table('absenpengajar')
            ->select('id_absen, tanggal, nama, absenpengajar.keterangan, nama_kelas')
            ->join('pengajar', 'pengajar.id_pengajar = absenpengajar.id_pengajar')
            ->join('kelas', 'kelas.id_kelas = absenpengajar.id_kelas')
            ->where('absenpengajar.id_pengajar', $id)
            ->where('month(absenpengajar.tanggal)', $b)
            ->where('year(absenpengajar.tanggal)', $y)
            ->where('absenpengajar.keterangan', 'hadir')
            ->countAllResults();
    }

    public function saveAbsen($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editAbsen($data, $id_absen)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_absen', $id_absen);
        return $builder->update($data);
    }

    public function hapusAbsen($id_absen)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_absen' => $id_absen]);
    }

    public function tambah($data)
    {
        $this->db->table('hafalan')->insert($data);
    }
}
