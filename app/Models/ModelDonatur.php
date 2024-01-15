<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelDonatur extends Model
{
    public function getDonatur()
    {
        $builder = $this->db->table('tbl_donatur');
        return $builder->get();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_donatur')->insert($data);
    }

    public function updateData($data, $id)
    {
        $query = $this->db->table('tbl_donatur')->update($data, ['iddonatur' => $id]);
        // where(['iddonatur' => $id])->set($data)->update();update($data, ['iddonatur' => $id]);
        return $query;
    }

    public function deletedonatur($id)
    {
        $query = $this->db->table('tbl_donatur')->delete(['iddonatur' => $id]);
        return $query;
    }
}
