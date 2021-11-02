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
        $data = $this->model->where(['email' => $this->session->email])->first();
        //$data = $this->model->where(['email' => 'ahera@ampu.id'])->first();

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
                'message' => lang('App.welcomeReg'),
                'data' => []
            ];
            return $this->respond($response, 200);
        }
    }

    public function create()
    {
        $rules = [
            'id_jenismhs' => [
                'rules'  => 'required',
                'errors' => []
            ],
            'status_registrasi' => [
                'rules'  => 'required',
                'errors' => []
            ],
            'pilihan1' => [
                'rules'  => 'required',
                'errors' => []
            ],
            'pilihan2' => [
                'rules'  => 'required',
                'errors' => []
            ],
            'pilihan3' => [
                'rules'  => 'required',
                'errors' => []
            ],
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
                'kelas' => $json->kelas,
                'gelombang' => $json->gelombang,
                'pilihan1' => $json->pilihan1,
                'pilihan2' => $json->pilihan2,
                'pilihan3' => $json->pilihan3,
                'no_kipk' => $json->no_kipk,
                'status_registrasi' => $json->status_registrasi,
                'jenis_mhs' => "4".$json->jenis_mhs,
                'id_jenismhs' => $json->id_jenismhs,
                'id_relasi' => $json->id_relasi,
                'thn_akademik' => $this->tahun_pmb,
            ];
        } else {
            $data = [
                'nodaf' => $nodaf,
                'noref' => $noref,
                'nama' => $this->request->getPost('nama'),
                'kelas' => $this->request->getPost('kelas'),
                'gelombang' => $this->request->getPost('gelombang'),
                'pilihan1' => $this->request->getPost('pilihan1'),
                'pilihan2' => $this->request->getPost('pilihan2'),
                'pilihan3' => $this->request->getPost('pilihan3'),
                'no_kipk' => $this->request->getPost('no_kipk'),
                'status_registrasi' => $this->request->getPost('status_registrasi'),
                'jenis_mhs' => "4".$this->request->getPost('jenis_mhs'),
                'id_jenismhs' => $this->request->getPost('id_jenismhs'),
                'id_relasi' => $this->request->getPost('id_relasi'),
                'thn_akademik' => $this->tahun_pmb,
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
            //$this->model->save($data);
            $response = [
                'status' => true,
                'message' => lang('App.productSuccess'),
                'data' => $data,
            ];
            return $this->respond($response, 200);
        }
    }

    public function update($id = NULL)
    {
        $rules = [
            'nama_kategori' => [
                'rules'  => 'required',
                'errors' => []
            ],
        ];

        if ($this->request->getJSON()) {
            $json = $this->request->getJSON();
            $data = [
                'nama_kategori' => $json->nama_kategori,
            ];
        } else {
            $data = $this->request->getRawInput();
        }

        if (!$this->validate($rules)) {
            $response = [
                'status' => false,
                'message' => lang('App.reqFailed'),
                'data' => $this->validator->getErrors(),
            ];
            return $this->respond($response, 200);
        } else {
            $simpan = $this->model->update($id, $data);
            if ($simpan) {
                $response = [
                    'status' => true,
                    'message' => lang('App.productUpdated'),
                    'data' => [],
                ];
                return $this->respond($response, 200);
            }
        }
    }
}
