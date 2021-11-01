<?php

namespace App\Models;

use CodeIgniter\Model;

class CalonsiswaModel extends Model
{
    protected $DBGroup              = 'default';
    protected $table                = 'calonsiswa';
    protected $primaryKey           = 'nodaf';
    protected $useAutoIncrement     = false;
    protected $insertID             = 0;
    protected $returnType           = 'array';
    protected $useSoftDeletes       = false;
    protected $protectFields        = false;
    protected $allowedFields        = [];

    // Dates
    protected $useTimestamps        = true;
    protected $dateFormat           = 'datetime';
    protected $createdField         = 'tgldaftar';
    protected $updatedField         = '';
    protected $deletedField         = '';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks       = true;
    protected $beforeInsert         = [];
    protected $afterInsert          = [];
    protected $beforeUpdate         = [];
    protected $afterUpdate          = [];
    protected $beforeFind           = [];
    protected $afterFind            = [];
    protected $beforeDelete         = [];
    protected $afterDelete          = [];

    public function countTahunlalu($tahun_lalu = null)
    {
        $this->where('THN_AKADEMIK', $tahun_lalu);
        return $this->countAllResults();
    }

    public function countBeasiswa($tahun_lalu = null)
    {
        $this->where('THN_AKADEMIK', $tahun_lalu);
        $this->where('syarat2', 'Sudah');
        $this->where('ket_lulus', 'Lulus');
        $this->where('status_registrasi', 'Bidikmisi');
        return $this->countAllResults();
    }

    function genNodaf($ThaPmb, $startnum = '0001')
    {
        $th = substr($ThaPmb, 2, 2);
       
        $kode = 'OL';

        $this->select("max(replace(replace(nodaf,'AO',''),'OL',''))+1 as nodaf");
        $this->where('thn_akademik', $ThaPmb);
        $hasil = $this->get()->getRowArray();

        //var_dump($this->getLastQuery()->getQuery());
        //die;

        $nodafe = '';
        if (is_null($hasil['nodaf'])) {
            $nodafe = $th . $startnum . $kode;
        } else {
            $nodafe = $hasil['nodaf'] . $kode;
        }
        return $nodafe;
    }

    function nomor_referensi($nodaf)
    {
        $angka1 = "12345";
        $angka2 = "67890";
        for ($x = 0; $x < 6; $x++) {
            mt_srand((float) microtime() * 1000000);
            $angka_1[$x] = substr($angka1, mt_rand(0, strlen($angka1) - 1), 1);
            $angka_2[$x] = substr($angka2, mt_rand(0, strlen($angka2) - 1), 1);
        }

        $noref = $angka_1[0] . $angka_2[1] . $angka_1[2] . $angka_2[3] . $angka_1[4];
        $noref = $nodaf . $noref;
        return $noref;
    }
}
