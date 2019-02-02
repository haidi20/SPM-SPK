<?php

namespace App\Supports ;

use App\Models\Hasil;
use App\Models\Kreteria;
use App\Models\Detail_kreteria;
use App\Models\Alternatif;

class Logika {

  public function __construct(
                              Kreteria $kreteria,
                              Detail_kreteria $detailKreteria,
                              Alternatif $alternatif,
                              Hasil $hasil
                            ){
    $this->hasil      = $hasil;
    $this->kreteria   = $kreteria;
    $this->detailKreteria   = $detailKreteria;
    $this->alternatif = $alternatif;
  }

  public function prosesVectorV()
  {
    $alternatif   = $this->alternatif->get();
    $nilai        = $this->prosesVectorS();
    $sumNilai     = array_sum($nilai);
    $hasilAkhir   = [];

    if($nilai != null){
      foreach ($alternatif as $index => $item) {
        $hasilPembagian = number_format($nilai[$item->id] / $sumNilai, 3);
        $alternatif     = $item->nama;

        $hasil[]        = (object) compact('hasilPembagian', 'alternatif');
      }

      rsort($hasil);

      for ($i=0; $i < count($hasil); $i++) { 
        $peringkat                  = $i + 1;
        $hasil[$i]->peringkat       = $peringkat;
        $hasil[$i]->hasilPembagian  = (double) $hasil[$i]->hasilPembagian;
        $hasilAkhir[] = $hasil[$i];
      }
    }

    return $hasilAkhir;
  }

  public function prosesVectorS()
  {
    $bobot        = $this->prosesPerbaikanBobot();
    $alternatif   = $this->alternatif->all();
    $hasilAkhir   = [];
    $pangkat      = [];
    $hasil        = [];

    if($bobot){
      foreach ($alternatif as $index => $item){
        $hasil[] = $this->hasil->select('kreteria_detail_id')->where('alternatif_id', $item->id)->get();
        foreach ($bobot as $key => $value){          
          $nilaiBobot = $value->attribute == 'Benefit' ? (double) $value->nilai : (double) -1 * $value->nilai;
          $detailKreteria = $this->detailKreteria->where('id', $hasil[$index][$key]->kreteria_detail_id)->value('nilai');

          $pangkat[$item->id][$key] = number_format(pow($detailKreteria, $nilaiBobot), 2);
        }

        $hasilAkhir[$item->id]  = $this->perkalian($pangkat[$item->id]);
      }
    }

    return $hasilAkhir;
  }

  public function perkalian($nilai)
  {
    $jumlah = 1;
    
    if($nilai != null){
      foreach ($nilai  as $index => $item) {
        $jumlah = $jumlah * $item;
      }
    }

    return number_format($jumlah, 2);
  }

  public function prosesPerbaikanBobot()
  {
    $kreteria   = $this->kreteria->get();
    $sumBobot   = $this->kreteria->sum('bobot');
    $hasilAKhir = [];

    foreach ($kreteria as $index => $item){
      $nilai      = number_format($item->bobot / $sumBobot, 2);
      $kode       = $item->kode;
      $attribute  = $item->attribute;
      $kreteria   = $item->id;

      // compact = array('variable' => 'value');
      $hasilAKhir[] = (object) compact('kode', 'nilai', 'attribute', 'kreteria');
    }

    return $hasilAKhir;
  }

  public function warga()
  {
    $alternatif = $this->alternatif->get();
    $kreteria   = $this->kreteria->get();
    $hasilAkhir = [];

    foreach ($alternatif as $index => $item) {
      $hasil[$item->id] = $this->hasil->kondisiAlternatif($item->id)->pluck('kreteria_detail_id', 'kreteria_id');
      foreach ($kreteria as $key => $value) {
        $idKreteria = array_get($hasil[$item->id], $value->id);
        $hasilAkhir[$item->id][$value->id] = $this->detailKreteria->where('id', $idKreteria)->value('nilai');
      }
    }

    return $hasilAkhir;
  }

  public function inputan($id)
  {
    $kreteria   = $this->kreteria->get();
    $hasilAkhir = [];

    foreach ($kreteria as $index => $item) {
      $kreteria_id            = Hasil::kondisiKreteria($item->id, $id)->value('kreteria_detail_id');
      foreach ($item->detail as $key => $value) {
        $hasilAkhir[$item->id]  = $value->where('id', $kreteria_id)->value('id');
      }
    }

    return $hasilAkhir;
  }
}
