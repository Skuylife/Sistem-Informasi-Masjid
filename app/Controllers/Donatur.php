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
        session();
        $model = new ModelDonatur();
        $data['donatur'] = $model->getDonatur()->getResultArray();
        echo view('donatur/v_donatur', $data);
        $data = [
            'title' => "Tambah Data",
            'validation' => \Config\Services::validation()
        ];
    }

    public function save()
    {
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
    }

    public function edit()
    {
        $model = new ModelDonatur();
        $id = $this->request->getPost('id-dntr');
        $data = [
            'nama' => $this->request->getPost('namadonatur'),
            'alamat' => $this->request->getPost('alamat'),
            'nohp' => $this->request->getPost('nohp')
        ];

        $model->updateData($data, $id);
        return redirect()->to('/donatur');
    }

    public function delete()
    {
        $model = new ModelDonatur();
        $id = $this->request->getPost('id-d');
        $model->deleteDonatur($id);
        return redirect()->to('/donatur/index');
    }
}
