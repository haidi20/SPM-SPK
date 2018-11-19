<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alternatif;
use App\Models\Kreteria;

use App\Supports\Logika;

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
    	$kriteria 		= $this->kreteria->get();
    	$alternatif 	= $this->alternatif->get();
    	$vectorS 		= $this->logika->prosesVectorS();
    	$vectorV 		= $this->logika->prosesVectorV();
    	$perbaikanBobot	= $this->logika->prosesPerbaikanBobot();

    	return view('laporan.index', compact(
    		'alternatif', 'kriteria', 'perbaikanBobot', 'vectorS', 'vectorV'
    	));
    }
}
