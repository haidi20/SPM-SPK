@extends('_layouts.default')

@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-6">
        <h1>Data Warga</h1>
      </div>
      <div class="col-md-6 text-right">
        @if(Auth::user()->role == 'admin')
        {{-- <a href="{{route('warga.create')}}" class="btn btn-md btn-success buat">Buat</a> --}}
        @endif
      </div>
    </div>
    <hr class="dashed mb20 mt20">
    <br>
    @include('warga.table')
  </div>
@endsection
