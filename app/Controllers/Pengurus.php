<?php

namespace App\Controllers;

use App\Models\ModelPengurus;

class Pengurus extends BaseController
{
    public function index()
    {
        $model = new ModelPengurus();
        $data['pengurus'] = $model->getPengurus()->getResultArray();
        echo view('pengurus/v_pengurus',$data);
    }

    public function save()
    {
        $model = new ModelPengurus();
        $data = array (
            'id_pengurus' =>$this->request->getPost('id'),
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
