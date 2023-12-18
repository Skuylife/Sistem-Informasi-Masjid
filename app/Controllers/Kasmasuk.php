<?php

namespace App\Controllers;

use App\Models\ModelKasMasuk;
use CodeIgniter\Validation\Rules as ValidationRules;
use CodeIgniter\Validation\StrictRules\Rules;
use PSpell\Config;

class Kasmasuk extends BaseController
{
    public function index()
    {
        session();
        $model = new ModelKasMasuk();
        $data['kasmasuk'] = $model->getKasmasuk()->getResultArray();
        echo view('kasmasjid/v_kasmasuk', $data);
        $data = [
            'title' => "Tambah Data",
            'validation' => \Config\Services::validation()
        ];
    }

    public function save()
    {

        $model = new ModelKasmasuk();
        $data = array(
            'id_kas_masjid' => $this->request->getPost('id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_masuk' => $this->request->getPost('kasmasuk'),
            'kas_keluar' => 0,
            'jenis_kas' => $this->request->getPost('jenis'),
            'status' => 'Masuk'
        );

        $model->insertData($data);
        return redirect()->to('/kasmasuk');
    }

    public function edit()
    {
        $model = new ModelKasmasuk();
        $id = $this->request->getPost('id');
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_masuk' => $this->request->getPost('kasmasuk'),
            'jenis_kas' => $this->request->getPost('jenis')
        ];

        $model->updateData($data, $id);
        return redirect()->to('/kasmasuk');
    }

    public function delete()
    {
        $model = new ModelKasmasuk();
        $id = $this->request->getPost('idk');
        $model->deleteKasmasuk($id);
        return redirect()->to('/Kasmasuk/index');
    }
}
