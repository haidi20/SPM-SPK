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

		session()->put('aktif','vectorS');
	  	session()->put('aktiff','');

		return view('vector.vectorS', compact('alternatif', 'hasil'));
    }

    public function vectorV()
    {
    	$hasil	= $this->logika->prosesVectorV();

    	session()->put('aktif','vectorV');
      	session()->put('aktiff','');

    	return view('vector.vectorV', compact('hasil'));
    }
}
