<?php

namespace App\Controllers;

use App\Models\CalonsiswaModel;
use App\Models\ThaPmbModel;
use App\Models\UserModel;

class Home extends BaseController
{
    public function __construct()
    {
        $this->thapmb = new ThaPmbModel();
        $this->calonsiswa = new CalonsiswaModel();
        $this->user = new UserModel();

    }

    public function index()
    {
        //var_dump($this->thaPmb->getThaPmb());
        //die;
        $tahun_lalu = '2020/2021';
		$jumlah_akun = $this->user->countAllResults();
		$jumlah_calonsiswa = $this->calonsiswa->countAllResults();
		$jumlah_tahunlalu = $this->calonsiswa->countTahunlalu($tahun_lalu);
		$jumlah_beasiswa = $this->calonsiswa->countBeasiswa($tahun_lalu);
        return view('home',[
            'jumlah_akun' => $jumlah_akun,
            'jumlah_calonsiswa' => $jumlah_calonsiswa,
            'jumlah_tahunlalu' => $jumlah_tahunlalu,
            'jumlah_beasiswa' => $jumlah_beasiswa,
        ]);
    }

    public function setLanguage()
    {
        $lang = $this->request->uri->getSegments()[1];
        $this->session->set("lang", $lang);
        return redirect()->to(base_url());
    }
}
