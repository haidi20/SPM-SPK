<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Detail_kreteria;

class DetailKreteriaController extends Controller
{
    public function __construct(Detail_kreteria $detail_kreteria)
    {
    	$this->detail_kreteria = $detail_kreteria;

    	 view()->share([
    	 	'kreteria' => request('kreteria'),
    	 ]);
    }

    public function index()
    {
    	$detailKreteria = $this->detail_kreteria->where('kreteria_id', request('kreteria'))->get();

    	return view('detail_kreteria.index', compact('detailKreteria'));
    }

    public function create()
    {
    	return $this->form();
    }

    public function edit($id)
    {
    	return $this->form($id);
    }

    public function form($id = null)
    {
    	$kreteriaDetailFind = $this->detail_kreteria::find($id);

      if ($kreteriaDetailFind) {
        session()->flashInput($kreteriaDetailFind->toArray());
        $action = route('detail-kreteria.update',$id);
        $method = 'PUT';
      }else{
        $action = route('detail-kreteria.store');
        $method = 'POST';
      }

      return view('detail_kreteria.form', compact('action','method'));
    }

    public function store()
    {
      return $this->save();
    }

    public function update($id)
    {
      return $this->save($id);
    }

    public function save($id = null)
    {
    	if($id) {
        	$detail_kreteria 	= $this->detail_kreteria::find($id);
        	$kreteria 			= $detail_kreteria->kreteria_id;
      	}else{
        	$detail_kreteria 	= new $this->detail_kreteria;
        	$kreteria 			= request('kreteria');
      	}

      	$detail_kreteria->kreteria_id 	= $kreteria;
      	$detail_kreteria->nama 			= request('nama');
      	$detail_kreteria->nilai 		= request('nilai');
      	$detail_kreteria->save();

      	return redirect()->route('detail-kreteria.index', compact('kreteria'));
    }

    public function destroy($id)
    {
      $kreteria = $this->detail_kreteria::find($id);
      $kreteria->delete();

      return redirect()->back();
    }
}
