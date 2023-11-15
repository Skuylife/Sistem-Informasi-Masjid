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
}
