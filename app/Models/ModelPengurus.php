<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPengurus extends Model
{
    public function getPengurus()
    {
        $builder = $this->db->table('tbl_pengurus');
        return $builder->get();
    }

    public function insertData($data) 
    {
        $this->db->table('tbl_pengurus')->insert($data);
        
    }

    public function updateData($data,$id)
    {
        $query = $this->db->table('tbl_pengurus')->update($data, ['id_pengurus' => $id]);
        // where(['id_pengurus' => $id])->set($data)->update();
        return $query;
    }

    public function deletepengurus($id)
    {
        $query = $this->db->table('tbl_pengurus')->delete(['id_pengurus' =>$id]);
        return $query;
    }
}
