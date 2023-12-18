<?php

namespace App\Controllers;

use App\Models\ModelPengurus;
use CodeIgniter\Validation\Rules as ValidationRules;
use CodeIgniter\Validation\StrictRules\Rules;
use PSpell\Config;

class Pengurus extends BaseController
{
    public function index()
    {
        session();
        $model = new ModelPengurus();
        $data['pengurus'] = $model->getPengurus()->getResultArray();
        echo view('pengurus/v_pengurus',$data);
        $data = [
        'title' => "Tambah Data",
        'validation' => \Config\Services::validation()
        ];
    }

    public function save()
    {
        if (!$this->validate([
            'id' => [
            'rules' => 'is_unique[tbl_pengurus.id_kas_masuk]',
            'errors' => [
                'is_unique' => '{field} Yang diinputkan sudah ada'
            ]
        ]])) {
            session()->setFlashdata('error',$this->validator->listErrors());
            return redirect()->back()->withInput();
        }else{
            print_r($this->request->getVar());
        }

        $model = new ModelPengurus();
        $data = array (
            'id_kas_masuk' =>$this->request->getPost('id'),
            'nama_pengurus' =>$this->request->getPost('namapengurus'),
            'jabatan' =>$this->request->getPost('jabatan'),
            'alamat' =>$this->request->getPost('alamat'),
            'no_hp' =>$this->request->getPost('nohp')
        );

        $model->insertData($data);
        return redirect()->to('/pengurus');
    }

    public function edit()
    {
        $model = new ModelPengurus();
        $id = $this->request->getPost('idp');
        $data = [
            'nama_pengurus' => $this->request->getPost('namapengurus'),
            'jabatan' => $this->request->getPost('jabatan'),
            'alamat' => $this->request->getPost('alamat'),
            'no_hp' => $this->request->getPost('nohp')
        ];
        
        $model->updateData($data,$id);
        return redirect()->to('/pengurus');

    }

    public function delete()
    {
        $model = new ModelPengurus();
        $id = $this->request->getPost('idp');
        $model->deletepengurus($id);
        return redirect()->to('/pengurus/index');
    }
}
