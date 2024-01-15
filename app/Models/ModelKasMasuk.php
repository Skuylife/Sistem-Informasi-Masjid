<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKasMasuk extends Model
{
    public function getKasmasuk()
    {
        // $builder = $this->db->table('tbl_kas_masjid')->where('status = "Masuk"');
        $builder = $this->db->table('tbl_kas_masjid');
        $builder->select('id_kas_masjid,tanggal,iddonatur,nama,ket,kas_masuk,jenis_kas');
        $builder->join('tbl_donatur', 'tbl_kas_masjid.iddonaturmasjid = tbl_donatur.iddonatur');
        // $builder->where('status = "Masuk"');
        // $query = $builder->get();
        // $builder = $this->db->query("select * from tbl_kas_masjid where tanggal >= '$tgla' and tanggal <= '$tglb' and jenis_kas ='$jenis' and status ='masuk'");
        return $builder->get();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_kas_masjid')->insert($data);
    }

    public function updateData($data, $id)
    {
        $query = $this->db->table('tbl_kas_masjid')->update($data, ['id_kas_masjid' => $id]);
        // where(['id_KasMasuk' => $id])->set($data)->update();update($data, ['id_KasMasuk' => $id]);
        return $query;
    }

    public function deleteKasMasuk($id)
    {
        $query = $this->db->table('tbl_kas_masjid')->delete(['id_kas_masjid' => $id]);
        return $query;
    }
    
    public function getLaporanKasMasuk()
    {
        $builder = $this->db->table('tbl_kas_masjid');
        $builder->select('id_kas_masjid,tanggal,iddonatur,nama,ket,kas_masuk,jenis_kas');
        $builder->join('tbl_donatur', 'tbl_kas_masjid.iddonaturmasjid = tbl_donatur.iddonatur');
        // $builder->where('status = "Masuk"');
        return $builder->get();
    }

    public function getLaporanperperiode($tgla, $tglb)
    {
        $b = $this->db->query("select id_kas_masjid,tanggal,nama,ket,kas_masuk,jenis_kas,status from tbl_kas_masjid join tbl_donatur on tbl_kas_masjid.iddonaturmasjid=tbl_donatur.iddonatur where tanggal >= '$tgla' and tanggal <= '$tglb'");
        return $b;
    }

    public function getLaporanperperiodeperjenis($tgla, $tglb, $jenis)
    {
        $b = $this->db->query("select id_kas_masjid,tanggal,nama,ket,kas_masuk,jenis_kas,status from tbl_kas_masjid join tbl_donatur on tbl_kas_masjid.iddonaturmasjid=tbl_donatur.iddonatur where tanggal >= '$tgla' and tanggal <= '$tglb' and jenis_kas ='$jenis'");
        return $b;
    }

    public function getDonatur()
    {
        $builder = $this->db->table('tbl_donatur');
        return $builder->get();
    }
}
