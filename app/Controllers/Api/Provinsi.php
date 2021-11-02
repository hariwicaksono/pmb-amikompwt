<?php

namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\ProvinsiModel;

class Provinsi extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = ProvinsiModel::class;

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
}