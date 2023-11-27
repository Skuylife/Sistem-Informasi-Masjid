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
        if (!$this->validate([
            'namauser' => [
                'rules' => 'is_unique[tbl_user.nama_user]',
                'errors' => [
                    'is_unique' => 'Username Yang diinputkan sudah ada'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
        }

        $model = new ModelUser();
        $data = [
            'id_user' => $this->request->getPost('id'),
            'nama_user' => $this->request->getPost('namauser'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            'level' => $this->request->getPost('level')
        ];
        $model->insertData($data);
        return redirect()->to('/user');
    }

    public function edit()
    {
        $model = new ModelUser();
        $id = $this->request->getPost('id');
        $data = [
            'nama_user' => $this->request->getPost('namauser'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            'level' => $this->request->getPost('level')
        ];

        $model->updateData($data, $id);
        return redirect()->to('/user');
    }

    public function delete()
    {
        $model = new ModelUser();
        $id = $this->request->getPost('idu');
        $model->deleteUser($id);
        return redirect()->to('/user/index');
    }
}
