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

        // if (!$this->validate([
        //     'username' => [
        //         'rules' => 'is_unique[tbl_user.nama_user]',
        //         'errors' => [
        //             'is_unique' => 'Username Yang diinputkan sudah ada'
        //         ]
        //     ]
        // ])) {
        //     session()->setFlashdata('error', $this->validator->listErrors());
        //     return redirect()->back()->withInput();
        // } else {
        //     print_r($this->request->getVar());
        // }
        // $model = new ModelUser();
        // $dataregis = [
        //     'id_user' => $this->request->getVar('id-user'),
        //     'email' => $this->request->getVar('email_user'),
        //     'nama_user' => $this->request->getVar('username'),
        //     'password_user' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
        //     'level' => $this->request->getVar('level')
        // ];
        // $model->Userbaru($dataregis);
        // return redirect()->to('/login');

        $rules = [
            'email_user' => 'required|valid_email|is_unique[tbl_user.email]',
            'username' => 'required|min_length[3]',
            'password' => 'required|min_length[3]',
            'confirmpassword' => 'matches[password]'
        ];
        if ($this->validate($rules)) {
            $model = new ModelUser();
            $data = [
                'id_user' => $this->request->getVar('iduser'),
                'nama_user' => $this->request->getVar('username'),
                'email' => $this->request->getVar('email_user'),
                'password_user' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'level' => $this->request->getVar('level')
            ];
            $model->Userbaru($data);
            return redirect()->to('/login');
        }else{
            $data['validation']=$this->validator;
            echo view('registrasi/v_register',$data);
        }
    }
}