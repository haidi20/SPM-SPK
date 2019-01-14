@extends('_layouts.default')

@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Data Alternatif</h1>
      </div>
      <div class="col-md-6 text-right">
        @if(Auth::user()->role == 'admin')
        <a href="{{route('alternatif.create')}}" class="btn btn-success btn-md buat" >Buat</a>
        @endif
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
              <th>Kode warga</th>
              <th>Nama warga</th>
              @if(Auth::user()->role == 'admin')
              <th class="action">Action</th>
              @endif
            </tr>
          </thead>
          <tbody>
            @forelse ($alternatif as $index => $item)
              <tr>
                <td>{{$index + 1}}</td>
                <td>{{$item->kode}}</td>
                <td>{{$item->nama}}</td>
                @if(Auth::user()->role == 'admin')
                <td>
                  <a href="{{route('alternatif.edit',$item->id)}}" class="btn btn-info btn-sm ">Edit</a>
                  <a href="{{route('alternatif.destroy',$item->id)}}"
                    data-method="DELETE" data-confirm="Anda yakin akan menghapus data ini?"
                    class="btn btn-sm btn-danger" title="Hapus Data">
                    Delete
                  </a>
                </td>
                @endif
              </tr>
            @empty
              <tr>
                <td colspan="4">Data Tidak Ada</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
