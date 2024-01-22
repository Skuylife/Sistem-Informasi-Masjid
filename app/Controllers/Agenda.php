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
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 3)
        ) {
        session();
        $model = new ModelAgenda();
        $data['agenda'] = $model->getAgenda()->getResultArray();
        echo view('agenda/v_agenda', $data);
        $data = [
            'title' => "Tambah Data",
            'validation' => \Config\Services::validation()
        ];
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 2)
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
            or (session()->get('level') == 3)
        ) {
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
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 2)
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
            or (session()->get('level') == 3)
        ) {
        $model = new ModelAgenda();
        $id = $this->request->getPost('id');
        $data = [
            'namakegiatan' => $this->request->getPost('namakegiatan'),
            'tgl' => $this->request->getPost('tanggal'),
            'jam' => $this->request->getPost('jam')
        ];

        $model->updateData($data, $id);
        return redirect()->to('/agenda');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 2)
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
            or (session()->get('level') == 3)
        ) {
        $model = new ModelAgenda();
        $id = $this->request->getPost('id');
        $model->deleteAgenda($id);
        return redirect()->to('/agenda/index');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 2)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }
}
