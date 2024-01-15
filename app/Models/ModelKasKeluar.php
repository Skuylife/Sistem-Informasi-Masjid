<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKaskeluar extends Model
{
    public function getKaskeluar()
    {
        $builder = $this->db->table('tbl_kas_keluar');
        return $builder->get();
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
