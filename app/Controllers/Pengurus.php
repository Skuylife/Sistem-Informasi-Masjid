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
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 3)
        ) {
            session();
            $model = new ModelPengurus();
            $data['pengurus'] = $model->getPengurus()->getResultArray();
            echo view('pengurus/v_pengurus', $data);
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
                    'rules' => 'is_unique[tbl_pengurus.id_kas_masuk]',
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

            $model = new ModelPengurus();
            $data = array(
                'id_kas_masuk' => $this->request->getPost('id'),
                'nama_pengurus' => $this->request->getPost('namapengurus'),
                'jabatan' => $this->request->getPost('jabatan'),
                'alamat' => $this->request->getPost('alamat'),
                'no_hp' => $this->request->getPost('nohp')
            );

            $model->insertData($data);
            return redirect()->to('/pengurus');
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
            $model = new ModelPengurus();
            $id = $this->request->getPost('idp');
            $data = [
                'nama_pengurus' => $this->request->getPost('namapengurus'),
                'jabatan' => $this->request->getPost('jabatan'),
                'alamat' => $this->request->getPost('alamat'),
                'no_hp' => $this->request->getPost('nohp')
            ];

            $model->updateData($data, $id);
            return redirect()->to('/pengurus');
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
            $model = new ModelPengurus();
            $id = $this->request->getPost('idp');
            $model->deletepengurus($id);
            return redirect()->to('/pengurus/index');
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
