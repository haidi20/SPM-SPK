<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Perbaikan_bobot extends Model
{
    protected $table = 'perbaikan_bobot';
    public $fillable = ['nilai', 'kode'];
}
