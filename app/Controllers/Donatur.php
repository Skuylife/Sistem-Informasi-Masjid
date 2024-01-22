<?php

namespace App\Controllers;

use App\Models\ModelDonatur;
use CodeIgniter\Validation\Rules as ValidationRules;
use CodeIgniter\Validation\StrictRules\Rules;
use PSpell\Config;

class Donatur extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
        session();
        $model = new ModelDonatur();
        $data['donatur'] = $model->getDonatur()->getResultArray();
        echo view('donatur/v_donatur', $data);
        $data = [
            'title' => "Tambah Data",
            'validation' => \Config\Services::validation()
        ];
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 3)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }

    public function save()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
        if (!$this->validate([
            'id' => [
                'rules' => 'is_unique[tbl_donatur.iddonatur]',
                'errors' => [
                    'is_unique' => '{field} Yang diinputkan sudah ada'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        } else {
            print_r($this->request->getVar());
        }

        $model = new ModelDonatur();
        $data = array(
            'iddonatur' => $this->request->getPost('id'),
            'nama' => $this->request->getPost('namadonatur'),
            'alamat' => $this->request->getPost('alamat'),
            'nohp' => $this->request->getPost('nohp')
        );

        $model->insertData($data);
        return redirect()->to('/donatur');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 3)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }

    public function edit()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
        $model = new ModelDonatur();
        $id = $this->request->getPost('id-dntr');
        $data = [
            'nama' => $this->request->getPost('namadonatur'),
            'alamat' => $this->request->getPost('alamat'),
            'nohp' => $this->request->getPost('nohp')
        ];

        $model->updateData($data, $id);
        return redirect()->to('/donatur');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 3)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }

    public function delete()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
        $model = new ModelDonatur();
        $id = $this->request->getPost('id-d');
        $model->deleteDonatur($id);
        return redirect()->to('/donatur/index');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 3)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }
}
