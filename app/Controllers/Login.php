<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Login extends BaseController
{
    public function index()
    {
        echo view('registrasi/v_login');
    }

    public function ceklogin()
    {
        $session = session();
        $model = new ModelUser();
        $username = $this->request->getPost('username');
        $password = $this->request->getVar('password');
        $cek = $model->ceklogin($username);
        if ($cek) {
            $pass = $cek['password'];
            $verify = password_hash($password,$pass);
            if ($verify) {
                session()->set('username',$cek['nama_user']);
                session()->set('hakaskses',$cek['hak-akses']);
                return redirect()->to('/layout');
            }else{
                $session->setFlashdata('msg','Password Salah');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Username tidak ditemukan');
            return redirect()->to('/login');
        }
    }

}