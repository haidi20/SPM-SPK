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
    $this->kreteria   = $kreteria;
    $this->alternatif = $alternatif;
    $this->hasil      = $hasil;
    $this->kinerja    = $kinerja;
  }

  public function normalisasiProses()
  {
    $kreteria = $this->kreteria->get();

    foreach ($kreteria as $index => $item){
      $dataHasil            = $this->hasil->kreteriaAlternatif($item->id)->get();
      $hitungNormalisasi[]  = $this->hitungNormalisasi($dataHasil, $item);
    }

    return $hitungNormalisasi;
  }

  public function hitungNormalisasi($nilai, $kreteria)
  {
      $maksMin          = '';
      $hasilAkhir       = [];
      $attribute        = $kreteria->attribute;
      $kreteria         = $kreteria->id;
      $nilaiKeseluruhan = [];

      // memasukkan nilai ke dalam array
      foreach ($nilai as $index => $item){
        $nilaiKeseluruhan[] = $item->nilai;
      }

      // kondisi attribute nilai max atau min
      if($attribute == 'Benefit'){
        $maksMin = max($nilaiKeseluruhan);
      }else{
        $maksMin = min($nilaiKeseluruhan);
      }

      // perhitungan normaliasi berdasarkan kondisi attribute
      foreach ($nilai as $index => $item){
        if($item->nilai != 0){
          if($attribute == 'Benefit'){
            $nilai = $item->nilai / $maksMin;
          }else{
            $nilai = $maksMin / $item->nilai;
          }
        }else{
          $nilai = 0;
        }

        $alternatif   = $item->alternatif_id;
        $hasilAkhir[] = (object) compact('nilai', 'alternatif');
      }

      return (object) compact('hasilAkhir', 'attribute', 'kreteria');
  }

  public function kinerjaProses(){
    $kreteria   = $this->kreteria->get();
    $hasilAkhir = [];

    foreach ($kreteria as $index => $item){
      $nilai = Normalisasi::where('kreteria_id', $item->id)->get();
      $hasilAkhir[] = $this->pengalianBobot($item->bobot, $nilai);
    }

    return $hasilAkhir;
  }

  public function pengalianBobot($bobot, $nilai)
  {
    $hasilAkhir = [];

    foreach ($nilai as $index => $item){
      $nilai          = $item->nilai * $bobot;
      $alternatif_id  = $item->alternatif_id;
      $kreteria_id    = $item->kreteria_id;

      $hasilAkhir[]   = (object) compact('nilai', 'alternatif_id', 'kreteria_id');
    }

    return $hasilAkhir;
  }

  public function peringkatProses(){
    $alternatif = $this->alternatif->get();

    foreach($alternatif as $index => $item){
      $nilai          = $this->kinerja->where('alternatif_id', $item->id)->sum('nilai');
      $alternatif_id  = $item->id;

      $pengurutan[]   = (object) compact('nilai', 'alternatif_id'); 
    }

    $hasilAkhir = $this->prosesPengurutan($pengurutan);

    return $hasilAkhir;
  } 

  public function prosesPengurutan($pengurutan)
  {
    $hasilAkhir = [];

    foreach ($pengurutan as $index => $item) {
      $nilai      = strval($item->nilai);
      $alternatif = $item->alternatif_id;
      $hasil[]    = (object) compact('nilai', 'alternatif');
    }

    rsort($hasil);

    for ($i=0; $i < count($hasil); $i++) { 
      $peringkat = $i + 1;
      $hasil[$i]->peringkat = $peringkat;
      $hasil[$i]->nilai = (double) $hasil[$i]->nilai;
      $hasilAkhir[] = $hasil[$i];
    }

    return $hasilAkhir;
  } 

  public function normalisasi($jenis){
    $alternatif = $this->alternatif->get();
    $nilai      = [];

    foreach ($alternatif as $index => $item) {
      $nilai[$item->id] = Normalisasi::alternatifKreteria($item->id)->pluck('nilai','kreteria_id');
    }

    return $nilai ;
  }

  public function sekolah(){
    $alternatif = $this->alternatif->get();
    $hasilAkhir = [];

    foreach ($alternatif as $index => $item) {
      $hasilAkhir[$item->id] = $this->hasil->kondisiAlternatif($item->id)->pluck('nilai','kreteria_id');
    }

    return $hasilAkhir;
  }

  public function inputan($id,$keyword){
    $kreteria   = $this->kreteria->get();
    $hasilAkhir = [];

    foreach ($kreteria as $index => $item) {
      $hasilAkhir[$item->id] = Hasil::kondisiKreteria($item->id,$id,$keyword)->value('nilai');
    }

    return $hasilAkhir;
  }
}
