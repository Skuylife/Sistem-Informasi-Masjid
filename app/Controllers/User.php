<?php

namespace App\Controllers;

use App\Models\ModelUser;

class User extends BaseController
{
    public function index()
    {
        $model = new ModelUser();
        $data['user'] = $model->getUser()->getResultArray();
        echo view('user/v_user', $data);
    }
    public function save()
    {
        $model = new ModelUser();
        $data = array(
            'id_user' => $this->request->getPost('id'),
            'nama_user' => $this->request->getPost('namauser'),
            'email' => $this->request->getPost('email'),
            'password' => $this->request->getPost('pass'),
            'level' => $this->request->getPost('level')
        );
        $model->insertData($data);
        return redirect()->to('/user');
    }

    public function delete()
    {
        $model = new ModelUser();
        $id = $this->request->getPost('idu');
        $model->deletepengurus($id);
        return redirect()->to('/user/index');
    }
}
