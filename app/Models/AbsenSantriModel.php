<?php

namespace App\Models;

use CodeIgniter\Model;

class AbsenSantriModel extends Model
{
    protected $table = 'absensantri';

    public function getAbsenSantri($id_absen = false, $id = false)
    {
        if ($id_absen === false and $id === false) {
            return $this->db->table('absensantri')
                ->select('id_absen, tanggal, nama, absensantri.keterangan, nama_kelas,kelas.id_kelas')
                ->join('santri', 'santri.id_santri = absensantri.id_santri')
                ->join('kelassantri', 'kelassantri.id_santri = santri.id_santri')
                ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
                ->orderBy('id_absen', 'DESC')
                ->get()->getResultArray();
        } elseif ($id_absen === false and $id != false) {
            return $this->db->table('absensantri')
                ->select('id_absen, tanggal, nama, absensantri.keterangan, nama_kelas')
                ->join('santri', 'santri.id_santri = absensantri.id_santri')
                ->join('kelassantri', 'kelassantri.id_santri = santri.id_santri')
                ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
                ->where('absensantri.id_santri', $id)
                ->orderBy('id_absen', 'DESC')
                ->get()->getResultArray();
        } elseif ($id_absen != false and $id === false) {
            return $this->db->table('absensantri')
                // ->select('id_absen, tanggal, nama, absensantri.keterangan, nama_kelas')
                ->join('santri', 'santri.id_santri = absensantri.id_santri')
                ->join('kelassantri', 'kelassantri.id_santri = santri.id_santri')
                ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
                ->where('id_absen', $id_absen)
                ->get()->getRow();
        }
    }

    public function tot($kls = false)
    {
        return $this->db->table('kelas')
            ->select('kelas.id_kelas, nama_kelas, count(kelassantri.id_santri) as jml, tanggal')
            ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
            ->join('santri', 'santri.id_santri = kelassantri.id_santri')
            ->join('absensantri', 'santri.id_santri = absensantri.id_santri')
            ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
            ->where('pengajar.id_pengajar', $kls)
            ->groupBy(['id_kelas', 'tanggal'])
            ->get()->getResultArray();
    }

    public function totabsen($kls = false)
    {
        return $this->db->table('kelas')
            ->select('kelas.id_kelas, nama_kelas, count(kelassantri.id_santri) as jml, tanggal')
            ->join('kelassantri', 'kelassantri.id_kelas = kelas.id_kelas')
            ->join('santri', 'santri.id_santri = kelassantri.id_santri')
            ->join('absensantri', 'santri.id_santri = absensantri.id_santri')
            ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
            // ->where('pengajar.id_pengajar', $kls)
            ->orderBy('tanggal')
            ->groupBy('kelassantri.id_kelas')
            ->get()->getResultArray();
    }

    public function totsen()
    {
        return $this->db->table('absensantri')
            ->select('id_absen, kelas.id_kelas, nama_kelas, tanggal')
            ->join('santri', 'santri.id_santri = absensantri.id_santri')
            ->join('kelassantri', 'kelassantri.id_santri = santri.id_santri')
            ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
            ->groupBy(['id_kelas', 'tanggal'])
            ->get()->getResultArray();
    }

    public function totket($p = false, $kls = false, $a = false, $tgl = false)
    {
        return $this->db->table('absensantri')
            ->select('tanggal, nama_kelas, count(absensantri.keterangan) as jml')
            ->join('santri', 'santri.id_santri = absensantri.id_santri')
            ->join('kelassantri', 'kelassantri.id_santri = santri.id_santri')
            ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
            ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
            ->where('pengajar.id_pengajar', $p)
            ->where('absensantri.keterangan', $kls)
            ->where('absensantri.tanggal', $tgl)
            ->where('kelas.id_kelas', $a)
            ->groupBy('kelassantri.id_kelas')
            // ->groupBy('absensantri.tanggal')
            ->get()->getResultArray();
    }

    public function data($a = false, $tgl = false)
    {
        return $this->db->table('absensantri')
            // ->select('tanggal, nama_kelas, count(absensantri.keterangan) as jml')
            ->join('santri', 'santri.id_santri = absensantri.id_santri')
            ->join('kelassantri', 'kelassantri.id_santri = santri.id_santri')
            ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
            // ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
            ->where('kelas.id_kelas', $a)
            ->where('absensantri.tanggal', $tgl)
            ->get()->getResultArray();
    }

    public function absensan($ket, $kls, $tgl = false)
    {
        return $this->db->table('absensantri')
            ->select('tanggal, nama_kelas, count(absensantri.keterangan) as jml')
            ->join('santri', 'santri.id_santri = absensantri.id_santri')
            ->join('kelassantri', 'kelassantri.id_santri = santri.id_santri')
            ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
            ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
            // ->where('pengajar.id_pengajar', $p)
            ->where('absensantri.keterangan', $ket)
            ->where('absensantri.tanggal', $tgl)
            ->where('kelas.id_kelas', $kls)
            ->groupBy('kelassantri.id_kelas')
            ->get()->getResultArray();
    }

    public function cariabsen($ket = false)
    {
        return $this->db->table('absensantri')
            ->select('tanggal, nama_kelas, count(absensantri.keterangan) as jml')
            ->join('santri', 'santri.id_santri = absensantri.id_santri')
            ->join('kelassantri', 'kelassantri.id_santri = santri.id_santri')
            ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
            ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
            ->where('kelas.id_kelas', $ket)
            ->groupBy('kelas.id_kelas')
            ->get()->getResultArray();
    }

    public function caritgl($ket = false, $tgl = false)
    {
        return $this->db->table('absensantri')
            ->select('tanggal, nama_kelas, count(absensantri.keterangan) as jml')
            ->join('santri', 'santri.id_santri = absensantri.id_santri')
            ->join('kelassantri', 'kelassantri.id_santri = santri.id_santri')
            ->join('kelas', 'kelas.id_kelas = kelassantri.id_kelas')
            ->join('pengajar', 'pengajar.id_pengajar = kelas.id_pengajar')
            ->where('kelas.id_kelas', $ket)
            ->groupBy('kelas.id_kelas')
            ->get()->getResultArray();
    }

    ///save data
    public function saveAbsen($data)
    {
        $builder = $this->db->table($this->table);
        return $builder->insert($data);
    }

    ///edit data
    public function editAbsen($data, $id_absen)
    {
        $builder = $this->db->table($this->table);
        $builder->where('id_absen', $id_absen);
        return $builder->update($data);
    }

    ///hapus data
    public function hapusAbsen($id_absen)
    {
        $builder = $this->db->table($this->table);
        return $builder->delete(['id_absen' => $id_absen]);
    }

    ///Import Data
    public function tambah($data)
    {
        $this->db->table('hafalan')->insert($data);
    }
}
