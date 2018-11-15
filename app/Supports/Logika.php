<?php

namespace App\Supports ;

use App\Models\Hasil;
use App\Models\Kinerja;
use App\Models\Kreteria;
use App\Models\Alternatif;
use App\Models\Normalisasi;

class Logika {

  public function __construct(
                              Kreteria $kreteria,
                              Alternatif $alternatif,
                              Hasil $hasil,
                              Kinerja $kinerja
                            ){
    $this->hasil      = $hasil;
    $this->kinerja    = $kinerja;
    $this->kreteria   = $kreteria;
    $this->alternatif = $alternatif;
  }

  public function perbaikanBobotProses()
  {
    $kreteria   = $this->kreteria->get();
    $sumBobot   = $this->kreteria->sum('bobot');
    $hasilAKhir = [];

    foreach ($kreteria as $index => $item){
      $nilai  = number_format($item->bobot / $sumBobot, 2);
      $kode   = $item->kode; 

      $hasilAKhir[] = (object) compact('kode', 'nilai');
    }

    return $hasilAKhir;
  }

  public function warga()
  {
    $alternatif = $this->alternatif->get();
    $hasilAkhir = [];

    foreach ($alternatif as $index => $item) {
      $hasilAkhir[$item->id] = $this->hasil->kondisiAlternatif($item->id)->pluck('nilai','kreteria_id');
    }

    return $hasilAkhir;
  }
}
