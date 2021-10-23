<?php

namespace App\Controllers;

use App\Models\CalonsiswaModel;
use App\Models\GelombangModel;
use App\Models\ThaPmbModel;
use App\Models\UserModel;

class Siswa extends BaseController
{
    protected $tahun_pmb = null;

    public function __construct()
    {
        $this->mcalonsiswa = new CalonsiswaModel();
        $this->mtahun = new ThaPmbModel();
        $this->muser = new UserModel();
        $this->mgelombang = new GelombangModel();

        $this->tahun_pmb = $this->mtahun->getThaPmb();

    }

    public function index()
    {
        //var_dump($this->thapmb->getThaPmb());
        //die;
        $tahun_lalu = '2020/2021';
		$jumlah_akun = $this->muser->countAllResults();
		$jumlah_calonsiswa = $this->mcalonsiswa->countAllResults();
		$jumlah_tahunlalu = $this->mcalonsiswa->countTahunlalu($tahun_lalu);
		$jumlah_beasiswa = $this->mcalonsiswa->countBeasiswa($tahun_lalu);
        return view('siswa/index',[
            'jumlah_akun' => $jumlah_akun,
            'jumlah_calonsiswa' => $jumlah_calonsiswa,
            'jumlah_tahunlalu' => $jumlah_tahunlalu,
            'jumlah_beasiswa' => $jumlah_beasiswa,
        ]);
    }

    public function formulir()
    {
        $siswa = $this->mcalonsiswa->where(['email' => 'test@gmail.com'])->first();
        $tha = $this->tahun_pmb;
        $gelombang= $this->mgelombang->cek_daftar(['thn_akademik'=>$tha]);
        return view('siswa/formulir',[
            'tha_pmb' => $tha,
            'gelombang' => $gelombang['kode'],
            'siswa' => $siswa,
        ]);
    }
}
