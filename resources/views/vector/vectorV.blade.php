@extends('_layouts.default')

@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Data Vector V</h1>
      </div>
    </div>
    <hr class="dashed mb20 mt20">
    <br>
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        <table class="table table-bordered text-center">
          <thead >
            <tr>
              <th class="no">No</th>
              <th>Nama Warga</th>
              <th>Nilai</th>
              <th>Rangking</th>
            </tr>
          </thead>
          <tbody>
            @foreach($hasil as $index => $item)
              <tr>
                <td>{{($index + 1)}}</td>
                <td>{{$item->alternatif}}</td>
                <td>{{$item->hasilPembagian}}</td>
                <td>{{$item->peringkat}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection