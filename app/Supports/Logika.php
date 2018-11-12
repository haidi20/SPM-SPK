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
                              Hasil $hasil
                            ){
    $this->kreteria   = $kreteria;
    $this->alternatif = $alternatif;
    $this->hasil      = $hasil;
  }

  public function normalisasiProses()
  {
    $kreteria = $this->kreteria->get();

    foreach ($kreteria as $index => $item) {
      $dataHasil            = $hasil->kreteriaAlternatif($item->id)->get();
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
      foreach ($nilai as $index => $item) {
        $nilaiKeseluruhan[] = $item->nilai;
      }

      // kondisi attribute nilai max atau min
      if($attribute == 'Benefit'){
        $maksMin = max($nilaiKeseluruhan);
      }else{
        $maksMin = min($nilaiKeseluruhan);
      }

      // perhitungan normaliasi berdasarkan kondisi attribute
      foreach ($nilai as $index => $item) {
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

  public function peringkatProses(){
    $alternatif = Hasil::groupBy('alternatif_id')->get();
    $x      = [];

    foreach ($alternatif as $index => $item) {
      $jumlah = Kinerja::where('alternatif_id',$item->alternatif_id)
                       ->where('jenis','kinerja')
                       ->sum('nilai');
      $x[] = [
        'nilai'=>number_format($jumlah,4),
        'alternatif' => $item->alternatif_id,
      ];
    }

    $hasil = proses_pengurutan($x);

    return $hasil ;
  }

// memunculkan data kinerja untuk SAW dan data terbobot untuk TOPSIS //
  public function kinerjaProses($jenis){
    $ciNilai = [];

    foreach ($this->kreteria as $index => $item) {
      $normalNilai = Normalisasi::where('kreteria_id',$item->id)
                                ->kondisiJenis($jenis)
                                ->get();
      $ciNilai[] = proses_pengalian_bobot($item->bobot,$normalNilai);
    }

    return $ciNilai ;
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
    $kreteria     = $this->kreteria->get() ;
    $hasilAkhir        = [];

    foreach ($kreteria as $index => $item) {
      $hasilAkhir[$item->id] = Hasil::kondisiKreteria($item->id,$id,$keyword)
                                ->value('nilai');
    }

    return $hasilAkhir;
  }
}
