<?php

namespace App\Controllers;

use App\Models\CalonsiswaModel;
use App\Models\ThaPmbModel;
use App\Models\UserModel;

class Siswa extends BaseController
{
    public function __construct()
    {
        $this->thapmb = new ThaPmbModel();
        $this->calonsiswa = new CalonsiswaModel();
        $this->user = new UserModel();

    }

    public function index()
    {
        //var_dump($this->thapmb->getThaPmb());
        //die;
        $tahun_lalu = '2020/2021';
		$jumlah_akun = $this->user->countAllResults();
		$jumlah_calonsiswa = $this->calonsiswa->countAllResults();
		$jumlah_tahunlalu = $this->calonsiswa->countTahunlalu($tahun_lalu);
		$jumlah_beasiswa = $this->calonsiswa->countBeasiswa($tahun_lalu);
        return view('siswa/index',[
            'jumlah_akun' => $jumlah_akun,
            'jumlah_calonsiswa' => $jumlah_calonsiswa,
            'jumlah_tahunlalu' => $jumlah_tahunlalu,
            'jumlah_beasiswa' => $jumlah_beasiswa,
        ]);
    }

    public function formulir()
    {
        //var_dump($this->thapmb->getThaPmb());
        //die;
        $tha = $this->thapmb->getThaPmb();
		$siswa = $this->calonsiswa->where(['email' => 'test@gmail.com'])->first();
        return view('siswa/formulir',[
            'tha_pmb' => $tha,
            'siswa' => $siswa,
        ]);
    }
}
