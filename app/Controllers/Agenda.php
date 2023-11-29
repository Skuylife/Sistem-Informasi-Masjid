<?php

namespace App\Controllers;

use App\Models\ModelAgenda;
use CodeIgniter\Validation\Rules as ValidationRules;
use CodeIgniter\Validation\StrictRules\Rules;
use PSpell\Config;

class Agenda extends BaseController
{
    public function index()
    {
        session();
        $model = new ModelAgenda();
        $data['agenda'] = $model->getAgenda()->getResultArray();
        echo view('agenda/v_agenda', $data);
        $data = [
            'title' => "Tambah Data",
            'validation' => \Config\Services::validation()
        ];
    }

    public function save()
    {
        if (!$this->validate([
            'id' => [
                'rules' => 'is_unique[tbl_agenda.id_agenda]',
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

        $model = new ModelAgenda();
        $data = array(
            'id_agenda' => $this->request->getPost('id'),
            'namakegiatan' => $this->request->getPost('namakegiatan'),
            'tgl' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam')
        );

        $model->insertData($data);
        return redirect()->to('/agenda');
    }

    public function edit()
    {
        $model = new ModelAgenda();
        $id = $this->request->getPost('id');
        $data = [
            'namakegiatan' => $this->request->getPost('namakegiatan'),
            'tgl' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam')
        ];

        $model->updateData($data, $id);
        return redirect()->to('/agenda');
    }

    public function delete()
    {
        $model = new ModelAgenda();
        $id = $this->request->getPost('id');
        $model->deleteAgenda($id);
        return redirect()->to('/agenda/index');
    }
}
