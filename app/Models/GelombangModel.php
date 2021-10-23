<?php

namespace App\Models;

use CodeIgniter\Model;

class GelombangModel extends Model
{
  protected $DBGroup              = 'default';
  protected $table                = 'data_gelombang';
  protected $primaryKey           = 'kode';
  protected $useAutoIncrement     = false;
  protected $insertID             = 0;
  protected $returnType           = 'array';
  protected $useSoftDeletes       = false;
  protected $protectFields        = false;
  protected $allowedFields        = [];

  // Dates
  protected $useTimestamps        = false;
  protected $dateFormat           = 'datetime';
  protected $createdField         = '';
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

  function cek_daftar(array $data): array
  {
    $tamp = $this->where($data)->first();
    return $tamp;
    if (!empty($tamp)) {
      foreach ($tamp as $key => $value) {
        $waktu_sekarang = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
        $waktu_awal = mktime(date("H", strtotime($value['tgl_mulai'])), date("i", strtotime($value['tgl_mulai'])), date("s", strtotime($value['tgl_mulai'])), date("m", strtotime($value['tgl_mulai'])), date("d", strtotime($value['tgl_mulai'])), date("Y", strtotime($value['tgl_mulai'])));
        $waktu_akhir = mktime(date("H", strtotime($value['tgl_selesai'])), date("i", strtotime($value['tgl_selesai'])), date("s", strtotime($value['tgl_selesai'])), date("m", strtotime($value['tgl_selesai'])), date("d", strtotime($value['tgl_selesai'])), date("Y", strtotime($value['tgl_selesai'])));
        if ($waktu_sekarang >= $waktu_awal && $waktu_sekarang <= $waktu_akhir) return $value;
      }
    } else {
      return "0";
    }
  }
}
