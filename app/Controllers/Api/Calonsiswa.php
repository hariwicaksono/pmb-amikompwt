<?php

namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\CalonsiswaModel;
use App\Models\ThaPmbModel;
use App\Models\UserModel;

class Calonsiswa extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = CalonsiswaModel::class;
    protected $tahun_pmb = null;

    public function __construct()
    {
        $this->thapmb = new ThaPmbModel();
        $this->user = new UserModel();

        $this->tahun_pmb = $this->thapmb->getThaPmb();
    }

    public function index()
    {
        $data = $this->model->where(['email' => 'ahera@ampu.id'])->first();

        if ($data) {
            $response = [
                'status' => true,
                'message' => lang('App.successGetData'),
                'data' => $data,
            ];
            return $this->respond($response, 200);
        } else {
            $response = [
                'status' => false,
                'message' => lang('App.noData'),
                'data' => []
            ];
            return $this->respond($response, 200);
        }
    }

    public function create()
    {
        $rules = [
            'nama' => [
                'rules'  => 'required',
                'errors' => []
            ],
        ];

        $nodaf = $this->model->genNodaf($this->tahun_pmb);
        $noref = $this->model->nomor_referensi($nodaf);

        if ($this->request->getJSON()) {
            $json = $this->request->getJSON();
            $data = [
                'nodaf' => $nodaf,
                'noref' => $noref,
                'nama' => $json->nama,
            ];
        } else {
            $data = [
                'nodaf' => $nodaf,
                'noref' => $noref,
                'nama' => $this->request->getPost('nama'),
            ];
        }

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'message' => lang('App.isRequired'),
                'data' => $this->validator->getErrors(),
            ];
            return $this->respond($response, 200);
        } else {
            $this->model->save($data);
            $response = [
                'status' => true,
                'message' => lang('App.productSuccess'),
                'data' => $data,
            ];
            return $this->respond($response, 200);
        }
    }
}
