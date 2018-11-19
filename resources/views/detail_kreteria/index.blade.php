@extends('_layouts.default')

@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Data Detail Kriteria</h1>
      </div>
      <div class="col-md-6 text-right">
        <a href="{{route('kreteria.index')}}" class="btn btn-info btn-md buat">Kembali</a>
        <a href="{{route('detail-kreteria.create', ['kreteria' => $kreteria])}}" class="btn btn-md btn-success buat">Buat</a>
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
              <th>Nama Detail Kriteria</th>
              <th>Bobot</th>
              <th class="action">Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($detailKreteria as $index => $item)
              <tr>
                <td>{{$index + 1}}</td>
                <td>{{$item->nama}}</td>
                <td>{{$item->nilai}}</td>
                <td>
                  <a href="{{route('detail-kreteria.edit', $item->id)}}" class="btn btn-info btn-sm ">Edit</a>
                  <a href="{{route('detail-kreteria.destroy', $item->id)}}"
                    data-method="DELETE" data-confirm="Anda yakin akan menghapus data ini?"
                    class="btn btn-sm btn-danger" title="Hapus Data">
                    Delete
                  </a>
                </td>
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
