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
        $data['data_donatur'] = $model->getDonatur()->getResult();
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
            'jenis_kas' => $this->request->getPost('jenis'),
            'iddonaturmasjid' => $this->request->getPost('iddonatur')
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

    public function laporankasmasuk()
    {
        $model = new ModelKasMasuk();
        $data['kasmasuk'] = $model->getLaporanKasMasuk()->getResultArray();
        echo view('kasmasjid/laporankasmasuk', $data);
    }

    public function laporanperperiode()
    {
        echo view('kasmasjid/vlaporankasmasuk');
    }

    public function cetaklaporanperperiode()
    {
        $model = new Modelkasmasuk();
        $tgla = $this->request->getPost('tanggal_awal');
        $tglb = $this->request->getPost('tanggal_akhir');
        $query = $model->getLaporanperperiode($tgla, $tglb)->getResultArray();
        $data = [
            'tgla' => $tgla,
            'tglb' => $tglb,
            'data' => $query
        ];
        echo view('kasmasjid/vcetaklaporanperperiode', $data);
    }

    public function laporanperperiodeperjeniskas()
    {
        echo view('kasmasjid/vlaporanperjeniskas');
    }

    public function cetaklaporanperperiodeperjeniskas()
    {
        $model = new Modelkasmasuk();
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
        echo view('kasmasjid/v_cetaklaporanperperiodeperjeniskas', $data);
    }
}
