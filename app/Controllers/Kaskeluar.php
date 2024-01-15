<?php

namespace App\Controllers;

use App\Models\ModelKaskeluar;
use CodeIgniter\Validation\Rules as ValidationRules;
use CodeIgniter\Validation\StrictRules\Rules;
use PSpell\Config;

class Kaskeluar extends BaseController
{
    public function index()
    {
        session();
        $model = new ModelKaskeluar();
        $data['kaskeluar'] = $model->getKaskeluar()->getResultArray();
        echo view('kasmasjid/v_kaskeluar', $data);
        $data = [
            'title' => "Tambah Data",
            'validation' => \Config\Services::validation()
        ];
    }

    public function save()
    {

        $model = new ModelKaskeluar();
        $data = array(
            'id_kaskeluar' => $this->request->getPost('id'),
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_keluar' => $this->request->getPost('kaskeluar'),
            'jenis_kas' => $this->request->getPost('jenis'),
        );

        $model->insertData($data);
        return redirect()->to('/Kaskeluar');
    }

    public function edit()
    {
        $model = new ModelKaskeluar();
        $id = $this->request->getPost('id');
        $data = [
            'tanggal' => $this->request->getPost('tanggal'),
            'ket' => $this->request->getPost('ket'),
            'kas_keluar' => $this->request->getPost('Kaskeluar'),
            'jenis_kas' => $this->request->getPost('jenis'),
        ];

        $model->updateData($data, $id);
        return redirect()->to('/Kaskeluar');
    }

    public function delete()
    {
        $model = new ModelKaskeluar();
        $id = $this->request->getPost('idk');
        $model->deleteKaskeluar($id);
        return redirect()->to('/Kaskeluar/index');
    }

    public function laporankaskeluar()
    {
        $model = new ModelKaskeluar();
        $data['kaskeluar'] = $model->getLaporanKasKeluar()->getResultArray();
        echo view('kasmasjid/laporankaskeluar', $data);
    }

    public function laporanperperiode()
    {
        echo view('kasmasjid/vlaporankaskeluar');
    }

    public function cetaklaporanperperiode()
    {
        $model = new ModelKaskeluar();
        $tgla = $this->request->getPost('tanggal_awal');
        $tglb = $this->request->getPost('tanggal_akhir');
        $query = $model->getLaporanperperiode($tgla, $tglb)->getResultArray();
        $data = [
            'tgla' => $tgla,
            'tglb' => $tglb,
            'data' => $query
        ];
        echo view('kasmasjid/vcetaklaporanperperiodekk', $data);
    }

    public function laporanperperiodeperjeniskas()
    {
        echo view('kasmasjid/vlaporanperjeniskaskk');
    }

    public function cetaklaporanperperiodeperjeniskas()
    {
        $model = new ModelKaskeluar();
        $tgla = $this->request->getPost('tanggal_awal');
        $tglb = $this->request->getPost('tanggal_akhir');
        $jenis = $this->request->getPost('jeniskas');
        $query = $model->getLaporanperperiodeperjenis($tgla, $tglb, $jenis)->getResultArray();
        $data = [
            'tgla' => $tglb,
            'tglb' => $tgla,
            'jenis' => $jenis,
            'data' => $query
        ];
        echo view('kasmasjid/v_cetaklaporanperperiodeperjeniskaskk', $data);
    }
}
