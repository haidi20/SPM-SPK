<?php
Route::get('/',function(){
  return redirect()->route('login');
});
Route::group(['middleware' => 'auth'],function(){
  Route::get('dashboard',function(){
    session()->put('aktif','dashboard');
    session()->put('aktiff','');
    return view('dashboard.index');
  })->name('dashboard');

  Route::resource('warga','WargaController');
  Route::resource('kreteria','KreteriaController');
  Route::resource('alternatif','AlternatifController');
  Route::resource('detail-kreteria', 'DetailKreteriaController');

  Route::get('vector/s', 'VectorController@vectorS')->name('vector.s');
  Route::get('vector/v', 'VectorController@vectorV')->name('vector.v');
  Route::get('laporan', 'LaporanController@index')->name('laporan');
});

//auth laravel
Auth::routes();
