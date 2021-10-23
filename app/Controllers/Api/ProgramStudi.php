<?php

namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\DepartmentModel;

class ProgramStudi extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = DepartmentModel::class;

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

    public function getProdi()
    {
        $input = $this->request->getVar();
        $select1 = $input['daftar'];
        $select2 = $input['jenis'];
        if ($select1 == 'KIP-Kuliah' && $select2 == '1') {
            $data = $this->model->where(['KD_DEPT' => '55201'])->orWhere(['KD_DEPT' => '55701'])->findAll();
        } else if ($select1 == 'Hanya Daftar' && $select2 == '4') { 
            $data = $this->model->where(['KD_DEPT' => '55201'])->findAll();
        } else {
            $data = $this->model->findAll();
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