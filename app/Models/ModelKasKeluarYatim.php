<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKaskeluarYatim extends Model
{
    public function getKaskeluar()
    {
        // $builder = $this->db->table('tbl_kas_keluar');
        // return $builder->get();
        $builder = $this->db->table('tbl_kas_keluar');
        $builder->select('id_kaskeluar,tanggal,idagenda,namakegiatan,ket,kas_keluar,jenis_kas');
        $builder->join('tbl_agenda', 'tbl_kas_keluar.idagenda = tbl_agenda.id_agenda');
        $builder->where('jenis_kas = "anak yatim"');
        return $builder->get();
    }

    public function getAgenda()
    {
        $builder = $this->db->table('tbl_agenda')->where('namakegiatan like "%Yatim%" or "%yatim%" or "%YATIM%" ');
        return $builder->get();
    }

    public function getTotalKasMasukYatim()
    {
        $builder = $this->db->query('SELECT SUM(kas_masuk) AS totalmasuk FROM tbl_kas_masjid WHERE jenis_kas="Anak Yatim"');
        // $builder->where('jenis_kas="Masjid"');
        return $builder;
    }

    public function getTotalKasKeluarYatim()
    {
        $builder = $this->db->query('SELECT SUM(kas_keluar) AS totalkeluar FROM tbl_kas_keluar WHERE jenis_kas="Anak Yatim"');
        return $builder;
    }

    public function insertData($data)
    {
        $this->db->table('tbl_kas_keluar')->insert($data);
    }

    public function updateData($data, $id)
    {
        $query = $this->db->table('tbl_kas_keluar')->update($data, ['id_kaskeluar' => $id]);
        // where(['id_Kaskeluar' => $id])->set($data)->update();update($data, ['id_Kaskeluar' => $id]);
        return $query;
    }

    public function deleteKaskeluar($id)
    {
        $query = $this->db->table('tbl_kas_keluar')->delete(['id_kaskeluar' => $id]);
        return $query;
    }

    public function getLaporanKasKeluar()
    {
        $builder = $this->db->table('tbl_kas_keluar');
        return $builder->get();
    }

    public function getLaporanperperiode($tgla, $tglb)
    {
        $b = $this->db->query("select * from tbl_kas_keluar where tanggal >= '$tgla' and tanggal <= '$tglb'");
        return $b;
    }

    public function getLaporanperperiodeperjenis($tgla, $tglb, $jenis)
    {
        $b = $this->db->query("select * from tbl_kas_keluar where tanggal >= '$tgla' and tanggal <= '$tglb' and jenis_kas ='$jenis'");
        return $b;
    }

}
