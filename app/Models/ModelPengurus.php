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
}
