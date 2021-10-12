<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\TupoksiModel;

class Tupoksi extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = TupoksiModel::class;

    public function index()
    {
        return $this->respond(["status" => true, "message" => "Success", "data" => $this->model->findAll()], 200);
    }

    public function show($id = false)
    {
        return $this->respond(["status" => true, "message" => "Success", "data" => $this->model->find($id)], 200);
    }


}