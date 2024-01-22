<?php

namespace App\Controllers;

use App\Models\ModelKaskeluarSosial;
use CodeIgniter\Validation\Rules as ValidationRules;
use CodeIgniter\Validation\StrictRules\Rules;
use PSpell\Config;

class KaskeluarSosial extends BaseController
{
    public function index()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 3)
        ) {
            session();
            $model = new ModelKaskeluarSosial();
            $data['kaskeluar'] = $model->getKaskeluar()->getResultArray();
            $data['data_agenda'] = $model->getAgenda()->getResult();
            $data['masuksosial'] = $model->getTotalKasMasukSosial()->getResultArray();
            $data['sosial'] = $model->getTotalKasKeluarSosial()->getResultArray();
            echo view('kasmasjid/v_kaskeluarsosial', $data);
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
            $jumlah = $this->request->getPost('kaskeluar');
            $sisakas = $this->request->getPost('sisa');
            if ($jumlah > $sisakas) {
                echo "<script>alert('Dana Kurang'); window.location.href='/kaskeluar';</script>";
            } else {
                $model = new ModelKaskeluarSosial();
                $data = array(
                    'id_kaskeluar' => $this->request->getPost('id'),
                    'tanggal' => $this->request->getPost('tanggal'),
                    'ket' => $this->request->getPost('ket'),
                    'kas_keluar' => $this->request->getPost('kaskeluar'),
                    'jenis_kas' => $this->request->getPost('jenis'),
                    'idagenda' => $this->request->getPost('idagenda'),
                );

                $model->insertData($data);
                return redirect()->to('/Kaskeluarsosial');
            }
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
            $model = new ModelKaskeluarSosial();
            $id = $this->request->getPost('id');
            $data = [
                'tanggal' => $this->request->getPost('tanggal'),
                'ket' => $this->request->getPost('ket'),
                'kas_keluar' => $this->request->getPost('Kaskeluar'),
                'jenis_kas' => $this->request->getPost('jenis'),
            ];

            $model->updateData($data, $id);
            return redirect()->to('/Kaskeluarsosial');
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
            $model = new ModelKaskeluarSosial();
            $id = $this->request->getPost('idk');
            $model->deleteKaskeluar($id);
            return redirect()->to('/Kaskeluarsosial/index');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 2)
            or (session()->get('level') == 4)
        ) {
            echo "<script>alert('<span style=\"color: red;\">Anda Tidak Mendapat Izin Untuk Halaman Ini</span>'); window.location.href='/layout';</script>";
        } else {
            echo "<script>alert('Anda Belum Login !!!'); window.location.href='/login';</script>";
        }
    }

    public function laporankaskeluar()
    {
        if ((session()->get('masuk') == true)
            and (session()->get('level') == 1)
            or (session()->get('level') == 3)
        ) {
            $model = new ModelKaskeluarSosial();
            $data['kaskeluar'] = $model->getLaporanKasKeluar()->getResultArray();
            echo view('kasmasjid/laporankaskeluar', $data);
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 2)
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
            or (session()->get('level') == 3)
        ) {
            echo view('kasmasjid/vlaporankaskeluar');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 2)
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
            or (session()->get('level') == 3)
        ) {
            $model = new ModelKaskeluarSosial();
            $tgla = $this->request->getPost('tanggal_awal');
            $tglb = $this->request->getPost('tanggal_akhir');
            $query = $model->getLaporanperperiode($tgla, $tglb)->getResultArray();
            $data = [
                'tgla' => $tgla,
                'tglb' => $tglb,
                'data' => $query
            ];
            echo view('kasmasjid/vcetaklaporanperperiodekk', $data);
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 2)
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
            or (session()->get('level') == 3)
        ) {
            echo view('kasmasjid/vlaporanperjeniskaskk');
        } elseif ((session()->get('masuk') == true)
            and (session()->get('level') == 2)
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
            or (session()->get('level') == 3)
        ) {
            $model = new ModelKaskeluarSosial();
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
