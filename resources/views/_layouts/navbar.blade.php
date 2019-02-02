<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      {{-- <a class="navbar-brand brand" href="#">Standar Pelayanan Raskin</a> --}}
      <a href="" class="navbar-brand brand">
        {{-- Sistem Pendukung Keputusan Metode WP --}}
      </a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav ukuran-huruf">
        <li class="{{session()->get('aktif') == 'dashboard'?'active':''}}"><a href="{{route('dashboard')}}" style="font-size:25px">Dashboard</a></li>
        <li class="dropdown {{session()->get('aktiff') == 'dasar'?'active':''}}">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Data Dasar <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li class="{{session()->get('aktif') == 'alternatif'?'active':''}}"><a href="{{route('alternatif.index')}}">Alternatif</a></li>
            <li class="{{session()->get('aktif') == "warga"?'active':''}}"><a href="{{route('warga.index')}}">Warga</a></li>
            <li class="{{session()->get('aktif') == 'kreteria'?'active':''}}"><a href="{{route('kreteria.index')}}">Kriteria</a></li>
          </ul>
        </li>
        <li class="{{session()->get('aktif') == 'vectorS'?'active':''}}"><a href="{{route('vector.s')}}">Vector S</a></li>
        <li class="{{session()->get('aktif') == 'vectorV'?'active':''}}"><a href="{{route('vector.v')}}">Vector V</a></li>
        <li ><a href="{{route('laporan')}}">Laporan</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right ukuran-huruf">
        <li>
          <a href="{{url('/logout')}}"
                  onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                  Keluar
          </a>

          <form id="logout-form" action="{{url('/logout')}}" method="POST" >
              {{ csrf_field() }}
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>
