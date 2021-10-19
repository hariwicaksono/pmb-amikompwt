<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\CalonsiswaModel;

class Calonsiswa extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = CalonsiswaModel::class;

    public function index()
    {
        $data = $this->model->where(['email' => 'Rimadrg1@gmail.com'])->first();

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