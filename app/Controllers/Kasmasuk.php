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
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
        session();
        $model = new ModelKasMasuk();
        $data['kasmasuk'] = $model->getKasmasuk()->getResultArray();
        $data['data_donatur'] = $model->getDonatur()->getResult();
        echo view('kasmasjid/v_kasmasuk', $data);
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
        $model = new ModelKasmasuk();
        $id = $this->request->getPost('idk');
        $model->deleteKasmasuk($id);
        return redirect()->to('/Kasmasuk/index');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 3)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }

    public function laporankasmasuk()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
        $model = new ModelKasMasuk();
        $data['kasmasuk'] = $model->getLaporanKasMasuk()->getResultArray();
        echo view('kasmasjid/laporankasmasuk', $data);
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 3)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }

    public function laporanperperiode()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
        echo view('kasmasjid/vlaporankasmasuk');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 3)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }

    public function cetaklaporanperperiode()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
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
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 3)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }

    public function laporanperperiodeperjeniskas()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
        echo view('kasmasjid/vlaporanperjeniskas');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 3)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }

    public function cetaklaporanperperiodeperjeniskas()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 2)
        ) {
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
