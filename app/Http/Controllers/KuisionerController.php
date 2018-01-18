<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Pertanyaan;

class KuisionerController extends Controller
{
    public function baca(){
      return Pertanyaan::with('keterangan')->paginate(10);
    }

    public function index(){
      return view('kuisioner.index',compact('pertanyaan'));
    }

    public function store(){
      return 'kuisioner store';
    }
}
