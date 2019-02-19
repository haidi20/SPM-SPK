<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alternatif;
use App\Models\Kreteria;

use App\Supports\Logika;

use WordTemplate;
use Carbon\Carbon;

class LaporanController extends Controller
{
    public function __construct(
    							Alternatif $alternatif, 
    							Kreteria $kreteria, 
    							Logika $logika 
    						)
    {
    	$this->alternatif 	= $alternatif;
    	$this->kreteria 	= $kreteria;
    	$this->logika 		= $logika;
    }

    public function index()
    {
    	// $kriteria 		= $this->kreteria->get();
    	// $alternatif 	= $this->alternatif->get();
    	// $vectorS 		= $this->logika->prosesVectorS();
    	// $vectorV 		= $this->logika->prosesVectorV();
    	// $perbaikanBobot	= $this->logika->prosesPerbaikanBobot();

    	// return view('laporan.index', compact(
    	// 	'alternatif', 'kriteria', 'perbaikanBobot', 'vectorS', 'vectorV'
    	// ));

        $vectorV        = $this->logika->prosesVectorV();
        $array = [];

        foreach ($vectorV as $index => $item) {
            $array['[nama_'.($index + 1).']']           = $item->alternatif;
            $array['[nilai_'.($index + 1).']']          = $item->hasilPembagian;
            $array['[peringkat_'.($index + 1).']']      = $item->peringkat;
        }

        return $array;

        $array['[TANGGAL_SEKARANG]'] = Carbon::now()->format('Y-m-d');

        $file       = public_path('storages/laporan_raskin.rtf');
        $nama_file  = 'surat-perpindahan.doc';
        
        return WordTemplate::export($file, $array, $nama_file);
    }
}
