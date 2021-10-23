<?php

namespace App\Controllers;

use App\Models\CalonsiswaModel;
use App\Models\ThaPmbModel;
use App\Models\UserModel;

class Home extends BaseController
{
    protected $tahun_pmb = null;

    public function __construct()
    {
        $this->mtahun = new ThaPmbModel();
        $this->mcalonsiswa = new CalonsiswaModel();
        $this->muser = new UserModel();

        $this->tahun_pmb = $this->mtahun->getThaPmb();
    }

    public function index()
    {
        //var_dump($this->tahun_pmb);
        //die;
        $tahun_lalu = '2020/2021';
		$jumlah_akun = $this->muser->countAllResults();
		$jumlah_calonsiswa = $this->mcalonsiswa->countAllResults();
		$jumlah_tahunlalu = $this->mcalonsiswa->countTahunlalu($tahun_lalu);
		$jumlah_beasiswa = $this->mcalonsiswa->countBeasiswa($tahun_lalu);
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
