<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelKasMasuk extends Model
{
    public function getKasmasuk()
    {
        $builder = $this->db->table('tbl_kas_masjid');
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
}
