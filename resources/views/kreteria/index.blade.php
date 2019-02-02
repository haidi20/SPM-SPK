@extends('_layouts.default')

@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Data Kriteria</h1>
      </div>
      <div class="col-md-6 text-right">
        @if(Auth::user()->role == 'admin')
        <a href="{{route('kreteria.create')}}" class="btn btn-md btn-success buat">Buat</a>
        @endif
      </div>
    </div>
    <hr class="dashed mb20 mt20">
    <br>
    <div class="row">
      <div class="col-md-offset-2 col-md-8">
        <table class="table table-bordered text-center">
          <thead>
            <tr>
              <th class="no">No</th>
              <th>ID</th>
              <th>Kreteria</th>
              <th>Attribut</th>
              <th>Bobot</th>
              <th>Perbaikan Bobot</th>
              @if(Auth::user()->role == 'admin')
              <th class="action">Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse ($kreteria as $index => $item)
              <tr>
                <td>{{$index + 1}}</td>
                <td>{{$item->kode}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->attribute}}</td>
                <td>{{$item->bobot}}</td>
                <td>{{array_get($perbaikanBobot, $item->id)}}</td>
                @if(Auth::user()->role == 'admin')
                <td>
                  <a href="{{route('detail-kreteria.index',['kreteria' => $item->id])}}" class="btn btn-warning btn-sm">Detail</a>
                  <a href="{{route('kreteria.edit',$item->id)}}" class="btn btn-info btn-sm ">Edit</a>
                  <a href="{{route('kreteria.destroy',$item->id)}}"
                    data-method="DELETE" data-confirm="Anda yakin akan menghapus data ini?"
                    class="btn btn-sm btn-danger" title="Hapus Data">
                    Delete
                  </a>
                </td>
                @endif
              </tr>
            @empty
              <tr>
                <td colspan="6">Data Tidak Ada</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
