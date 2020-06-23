<?php  
use Restserver\Libraries\REST_Controller;
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . 'libraries/REST_Controller.php';
require APPPATH . 'libraries/Format.php';
class SearchController extends REST_Controller{

	public function __construct($config = 'rest')
    {
        parent::__construct($config);
        $this->load->model('ModelMaster','Model');
        header('Access-Control-Allow-Origin: *');
       header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
       header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT ,DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
            die();
        }
    }

	public function index_get()
	{
		$id = $this->get('id');
		if ($id == null) {
			//$this->response(['id'=> 'kosong']);
			$orang = $this->Model->cari_orang();
		} else {
			$orang = $this->Model->cari_orang($id);
		}

		if ($orang > 0) {
			$this->response([
				'status' => 1,
				'data' => $orang
			],REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => 0,
				'data' => 'Data Not Found'
			],REST_Controller::HTTP_NOT_FOUND);
		}

	} 

	public function index_post()
	{
		$data = [
			'nama_produk' => $this->post('nama'),
			'kategori_produk' => $this->post('kategori'),
			'harga_produk' => $this->post('harga'),
			'desk_produk' => $this->post('desk'),
			'foto_produk' => $this->post('foto')
		];

		if ($this->Model->post_produk($data) > 0 ) {
			$this->response([
				'status' => 1,
				'data' => 'Succes Post data'
			],REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => 0,
				'data' => 'Failed Post Data'
			],REST_Controller::HTTP_NOT_FOUND);
		}
	}


	public function index_delete()
	{
		$id = $_GET['id'];
		if ($id == null) {
			$this->response([
				'status' => 404,
				'data' => 'id_not found'
			],REST_Controller::HTTP_BAD_REQUEST);
		} else {
			if($this->Model->delete_produk($id) > 0){
					$this->response([
					'status' => 1,
					'data' => 'Succes Delete data'
				],REST_Controller::HTTP_OK);
			} else {
				$this->response([
					'status' => 0,
					'data' => 'Failed Delete Data'
				],REST_Controller::HTTP_NOT_FOUND);
			}
		} 
	}


	public function index_put()
	{
		$id = $this->put('id');
		$data = [
			'nama_produk' => $this->put('nama'),
			'kategori_produk' => $this->put('kategori'),
			'harga_produk' => $this->put('harga'),
			'desk_produk' => $this->put('desk'),
			'foto_produk' => $this->put('foto')
		];

		if ($this->Model->put_produk($id,$data) > 0) {
			$this->response([
				'status' => 1,
				'data' => 'Succes Update data'
			],REST_Controller::HTTP_OK);
		} else {
			$this->response([
				'status' => 0,
				'data' => 'Failed Update Data'
			],REST_Controller::HTTP_NOT_FOUND);
		}

	}

}