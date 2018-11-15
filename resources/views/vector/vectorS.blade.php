@extends('_layouts.default')

@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Data Vector S</h1>
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
            </tr>
          </thead>
          <tbody>
            @foreach($alternatif as $index => $item)
              <tr>
                <td>{{($index + 1)}}</td>
                <td>{{$item->nama}}</td>
                <td>{{array_get($hasil, $item->id)}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection