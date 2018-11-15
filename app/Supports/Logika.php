<?php

namespace App\Supports ;

use App\Models\Hasil;
use App\Models\Kreteria;
use App\Models\Alternatif;

class Logika {

  public function __construct(
                              Kreteria $kreteria,
                              Alternatif $alternatif,
                              Hasil $hasil
                            ){
    $this->hasil      = $hasil;
    $this->kreteria   = $kreteria;
    $this->alternatif = $alternatif;
  }

  public function prosesVectorV()
  {
    $alternatif   = $this->alternatif->get();
    $nilai        = $this->prosesVectorS();
    $sumNilai     = array_sum($nilai);
    $hasilAkhir   = [];

    foreach ($alternatif as $index => $item) {
      $hasilAkhir[$item->id] = number_format($nilai[$item->id] / $sumNilai, 3);
    }

    return $hasilAkhir;
  }

  public function prosesVectorS()
  {
    $bobot        = $this->perbaikanBobotProses();
    $alternatif   = $this->alternatif->get();
    $hasilAKhir   = [];

    foreach ($alternatif as $index => $item){
      $hasil[] = $this->hasil->kondisiAlternatif($item->id)->get();
      foreach ($bobot as $key => $value){
        if($value->attribute == 'Benefit'){
          $nilaiBobot = (double) $value->nilai;
        }else{
          $nilaiBobot = (double) -1 * $value->nilai;
        }
        $pangkat[$item->id][$key] = pow($hasil[$index][$key]->nilai, $nilaiBobot);
      }
      $hasilAKhir[$item->id]  = $this->perkalian($pangkat[$item->id]);
    }

    return $hasilAKhir;
  }

  public function perkalian($nilai)
  {
    $jumlah = 1;
    foreach ($nilai as $index => $item) {
      $jumlah = $jumlah * $item;
    }

    return number_format($jumlah, 3);
  }

  public function perbaikanBobotProses()
  {
    $kreteria   = $this->kreteria->get();
    $sumBobot   = $this->kreteria->sum('bobot');
    $hasilAKhir = [];

    foreach ($kreteria as $index => $item){
      $nilai      = number_format($item->bobot / $sumBobot, 2);
      $kode       = $item->kode;
      $attribute  = $item->attribute;

      $hasilAKhir[] = (object) compact('kode', 'nilai', 'attribute');
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

  public function inputan($id,$keyword)
  {
    $kreteria   = $this->kreteria->get();
    $hasilAkhir = [];
    foreach ($kreteria as $index => $item) {
      $hasilAkhir[$item->id] = Hasil::kondisiKreteria($item->id,$id,$keyword)->value('nilai');
    }
    return $hasilAkhir;
  }
}
