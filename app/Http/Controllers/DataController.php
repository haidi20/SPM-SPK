<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Perbaikan_bobot;

use App\Supports\Logika;

use Auth;

class DataController extends Controller
{
  public function __construct(Logika $logika, Perbaikan_bobot $perbaikanBobot){
    $this->logika         = $logika;
    $this->perbaikanBobot = $perbaikanBobot;
  }

  public function index()
  {
    $this->inputPerbaikanBobot();

    return $this->jalur();
  }

  public function inputPerbaikanBobot()
  {
    $inputPerbaikanBobot = $this->logika->perbaikanBobotProses();

    foreach ($inputPerbaikanBobot as $index => $item) {
      $nilai  = (double) $item->nilai;
      $kode   = $item->kode;

      $perbaikanBobot = $this->perbaikanBobot::updateOrCreate(compact('kode'));
      $perbaikanBobot->nilai = $nilai;
      $perbaikanBobot->save();
    }
  }

  public function jalur()
  {
    if (session()->get('controller') == 'warga'){
      return redirect()->route('warga.index');
    }
    else if (session()->get('controller') == 'kreteria'){
      return redirect()->route('kreteria.index');
    }
  }
}
