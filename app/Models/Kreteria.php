<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kreteria extends Model
{
    protected $table = "kreteria";

    public function hasil()
    {
      return $this->hasMany('App\Models\Hasil');
    }

    public function detail()
    {
    	return $this->hasMany('App\Models\Detail_kreteria', 'kreteria_id');
    }

    public function scopeBerdasarkan($query)
    {
      $query->orderBy('kode');
    }
}
