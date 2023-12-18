<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Register extends BaseController
{
    public function index()
    {
        helper(['form']);
        $data = [
            'validation' =>\Config\Services::validation()
        ];
        echo view('registrasi/v_register',$data);
    }

    public function save() 
    {
        $rules = [
            'emailuser' =>'required|valid_email|is_unique[tbl_user.email]',
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[3]',
            'confirmpassword' => 'matches[password]'
        ];
        if ($this->validate($rules)) {
            $model = new ModelUser();
            $data = [
                'id_user' => $this->request->getPost('iduser'),
                'email' => $this->request->getPost('emailuser'),
                'nama_user' => $this->request->getPost('username'),
                'password_user' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'level' => $this->request->getPost('level')
            ];
            $model -> simpanUserbaru($data);
            return redirect()->to('/login');
        }else{
            $data['validation']=$this->validator;
            echo view('registrasi/v_register',$data);
        }
    }
}
