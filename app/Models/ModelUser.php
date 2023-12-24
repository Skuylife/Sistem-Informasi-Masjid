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

    public function updateData($data, $id)
    {
        $query = $this->db->table('tbl_user')->update($data, ['id_user' => $id]);
        return $query;
    }

    public function Userbaru($dataregis)
    {
        $this->db->table('tbl_user')->insert($dataregis);
    }

    public function deleteUser($id)
    {
        $query = $this->db->table('tbl_user')->delete(array('id_user' => $id));
        return $query;
    }

    public function simpan($data)
    {
        $query = $this->db->table('tbl_user')->insert($data);
        return $query;
    }

    public function cek_login($username)
    {
        return $this->db->table('tbl_user')
            ->where(array('nama_user' => $username))
            ->get()->getRowArray();
    }
}
