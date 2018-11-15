<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Alternatif;
use App\Supports\Logika;

class VectorController extends Controller
{
	public function __construct(Logika $logika, Alternatif $alternatif){
		$this->logika 		= $logika;
		$this->alternatif 	= $alternatif;
	}

    public function vectorS()
    {
    	$alternatif = $this->alternatif->all();
    	$hasil 		= $this->logika->prosesVectorS();

    	return view('vector.vectorS', compact('alternatif', 'hasil'));
    }

    public function vectorV()
    {
    	return $this->logika->prosesVectorV();
    }
}
