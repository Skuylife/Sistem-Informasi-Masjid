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
}
