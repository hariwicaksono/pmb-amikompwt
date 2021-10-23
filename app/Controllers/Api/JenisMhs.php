<?php

namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\JenismhsModel;

class JenisMhs extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = JenismhsModel::class;

    public function index()
    {
        $data = $this->model->findAll();
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

    public function getJenismhs()
    {
        $input = $this->request->getVar();
        $select = $input['daftar'];
        if ($select == 'Hanya Daftar') {
            $data = $this->model->findAll();
        } else {
            $data = $this->model->where(['ID_JENISMHS' => '1'])->findAll();
        }

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

}