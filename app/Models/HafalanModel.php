<?php

namespace App\Models;

use CodeIgniter\Model;

class HafalanModel extends Model
{
    protected $table = 'hafalan';

    public function getHafalan($id_hafalan = false, $id_user = false, $id_pengajar = false)
    {
        if ($id_hafalan === false and $id_user === false and $id_pengajar === false) {
            return $this->db->table('hafalan')
                ->join('santri', 'santri.id_santri = hafalan.id_santri')
                ->join('surah', 'surah.id_surah = hafalan.id_surah')
                ->orderBy('id_hafalan', 'DESC')
                ->get()->getResultArray();
        } elseif ($id_hafalan === false and $id_user != false and $id_pengajar === false) {
            return $this->db->table('hafalan')
                ->join('santri', 'santri.id_santri = hafalan.id_santri')
                ->join('surah', 'surah.id_surah = hafalan.id_surah')
                ->where('hafalan.id_santri', $id_user)
                ->orderBy('id_hafalan', 'DESC')
                ->get()->getResultArray();
        } elseif ($id_hafalan === false and $id_user === false and $id_pengajar != false) {
            return $this->db->table('hafalan')
                ->join('santri', 'santri.id_santri = hafalan.id_santri')
                ->join('kelassantri', 'kelassantri.id_santri = hafalan.id_santri')
                ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
                ->join('surah', 'surah.id_surah = hafalan.id_surah')
                ->where('id_pengajar', $id_pengajar)
                ->orderBy('id_hafalan', 'DESC')
                ->get()->getResultArray();
        } else {
            return $this->db->table('hafalan')
                ->join('santri', 'santri.id_santri = hafalan.id_santri')
                ->join('surah', 'surah.id_surah = hafalan.id_surah')
                ->where('id_hafalan', $id_hafalan)
                ->get()->getRow();
        }
    }

    public function haf($id, $b, $y, $max)
    {
        return $this->db->table('hafalan')
            ->select('nama,akhir_hafalan,akhir,juz')
            ->join('santri', 'santri.id_santri = hafalan.id_santri')
            ->join('surah', 'surah.id_surah = hafalan.id_surah')
            ->where('month(tgl_setor)', $b)
            ->where('year(tgl_setor)', $y)
            ->where('status', 'selesai')
            ->where('juz', $id)
            ->where('hafalan.id_surah', $max)
            // ->groupBy('juz')
            ->orderBy('id_hafalan', 'DESC')
            ->limit(1)
            ->get()->getResultArray();
    }

    public function surah_san($id)
    {
        return $this->db->table('hafalan')
            ->select('nama,akhir_hafalan,akhir,juz')
            ->join('santri', 'santri.id_santri = hafalan.id_santri')
            ->join('surah', 'surah.id_surah = hafalan.id_surah')
            ->where('status', 'selesai')
            ->where('hafalan.id_santri', $id)
            ->groupBy('juz')
            ->get()->getResultArray();
    }

    public function surah($id, $surah)
    {
        return $this->db->table('hafalan')
            ->where('id_santri', $id)->where('id_surah', $surah)
            ->orderBy('akhir_hafalan', 'DESC')->get()->getRow();
    }

    public function isisurah($id, $surah)
    {
        return $this->db->table('hafalan')
            ->where('id_santri', $id)
            ->where('id_surah', $surah)
            ->where('status', 'Selesai')
            ->orderBy('akhir_hafalan', 'DESC')
            ->groupBy('id_surah')
            ->get()->getResultArray();
    }

    public function santri($id_kelas, $b, $y, $id)
    {
        return $this->db->table('kelas')
            ->select('nama_surah,akhir_hafalan,awal_hafalan')
            ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
            ->join('santri', 'santri.id_santri = kelassantri.id_santri')
            ->join('hafalan', 'santri.id_santri = hafalan.id_santri')
            ->join('surah', 'surah.id_surah = hafalan.id_surah')
            ->where('kelassantri.id_kelas', $id_kelas)
            ->where('month(tgl_setor) <= ', $b)
            ->where('year(tgl_setor) <= ', $y)
            ->where('hafalan.id_santri', $id)
            ->orderBy('tgl_setor', 'ASC')
            ->get()->getResultArray();
    }

    public function tgl($k, $b, $y)
    {
        return $this->db->table('kelas')
            ->select('tgl_setor')
            ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
            ->join('santri', 'santri.id_santri = kelassantri.id_santri')
            ->join('hafalan', 'santri.id_santri = hafalan.id_santri')
            ->join('absensantri', 'absensantri.id_santri = santri.id_santri')
            ->where('kelassantri.id_kelas', $k)
            ->where('month(tgl_setor)', $b)
            ->where('year(tgl_setor)', $y)
            ->groupBy('tgl_setor')
            ->get()->getResultArray();
    }

    public function saveHafalan($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    public function editHafalan($data, $id_hafalan)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_hafalan', $id_hafalan);
        return $builder->update($data);
    }

    public function hapusHafalan($id_hafalan)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_hafalan' => $id_hafalan]);
    }

    public function tambah($data)
    {
        $this->db->table('hafalan')->insert($data);
    }
}
