@extends('_layouts.default')

@section('konten')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="jumbotron">
          <h1>SPK RASKIN SUMBERMULYO</h1>
          <br>
          @if (\Auth::user()->nama == 'WP')
            <p>
             
            </p>
          @elseif(\Auth::user()->nama == 'WP')
            <p>
              
            </p>
          @endif
          <br>
        </div>
      </div>
    </div>
  </div>
@endsection
