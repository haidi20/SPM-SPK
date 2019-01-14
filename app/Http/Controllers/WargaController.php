<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Hasil;
use App\Models\Kreteria;
use App\Models\Alternatif;

use App\Supports\Logika;

class WargaController extends Controller
{

    public function __construct(Logika $logika){
      $this->logika = $logika;
    }

    public function index(){
      $kreteria   = Kreteria::berdasarkan()->get();
      $warga      = Hasil::berdasarkanAlternatif()->get();
      $nilai      = $this->logika->warga();

      session()->put('aktif','warga');
      session()->put('aktiff','dasar');

      return view('warga.index',compact('nilai','kreteria','warga'));
    }

    public function create(){
      return $this->form();
    }

    public function edit($id){
      return $this->form($id);
    }

    public function form($id = null){
      $hasilFind = Hasil::where('alternatif_id',$id)->get();

      if (count($hasilFind)) {
        session()->flashInput($hasilFind->toArray());
        $action = Route('warga.update',$id);
        $method = "PUT";
      }else{
        $action = Route('warga.store');
        $method = "POST";
      }

      $alternatif     = Alternatif::all();
      $alternatif_id  = Alternatif::find($id);
      $kreteria       = Kreteria::orderBy('kode')->get();
      $hasil          = Hasil::kreteriaAlternatif($id)->get();
      $nilai          = $this->logika->inputan($id,'no-ajax');

      return view('warga.form',compact(
        'action','method','alternatif','hasil','kreteria','nilai','alternatif_id'
      ));
    }

    public function store(){
      return $this->save();
    }

    public function update($id){
      return $this->save($id);
    }

    public function save($id = null){
      $hasil = [];
      $array = request('kreteria_detail');
      $kreteria = request('kreteria');

      // input data ke table hasil
      foreach ($array as $index => $item) {
        $kreteria_detail_id = $item;
        $kreteria_id = $kreteria[$index];
        $alternatif_id = request('alternatif');

        $hasil = Hasil::FirstOrCreate(compact('alternatif_id','kreteria_id'));
        $hasil->kreteria_detail_id = $kreteria_detail_id;
        $hasil->save();
      }

      session()->put('controller','warga');

      return redirect()->route('warga.index');
    }

    public function destroy($id){
      $hasil = Hasil::where('alternatif_id',$id);
      $hasil->delete();
      $normalisasi = Normalisasi::where('alternatif_id',$id);
      $normalisasi->delete();

      return redirect()->back();
    }
}
