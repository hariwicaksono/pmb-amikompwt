<?php namespace App\Controllers\Api;

use App\Controllers\BaseControllerApi;
use App\Models\SlideshowModel;

class Slideshow extends BaseControllerApi
{
    protected $format       = 'json';
    protected $modelName    = SlideshowModel::class;

    public function index()
    {
        return $this->respond(["status" => true, "message" => "Success", "data" => $this->model->where(['aktif'=> 1])->findAll()], 200);
    }

    public function update($id = NULL)
    {

    }

}