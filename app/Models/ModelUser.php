<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    public function getUser()
    {
        $builder = $this->db->table('tbl_user');
        return $builder->get();
    }

    public function insertData($data)
    {
        $this->db->table('tbl_user')->insert($data);
    }

    public function deletepengurus($id)
    {
        $query = $this->db->table('tbl_user')->delete(array('id_user' => $id));
        return $query;
    }
}
