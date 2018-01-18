<div class="row">
  <div class="col-md-12">
    <table class="table table-bordered table-custom">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Sekolah</th>
          <th>jenjang</th>
          <th>Kecamatan</th>
          <th>Alamat</th>
          <th width="200px">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($sekolah as $index => $item)
          <tr align="center">
            <td>{{$index + 1}}</td>
            <td>{{$item->nama}}</td>
            <td>jenjang</td>
            <td>kecamatan</td>
            <td>{{$item->alamat}}</td>
            <td>
              <a href="#" class="btn btn-info btn-sm" id="modal" data-toggle="modal" data-target="#myIp2">Detail</a>
              <a href="#" class="btn btn-warning btn-sm">Edit</a>
              <a href="#" class="btn btn-danger btn-sm">Delete</a>
            </td>
            <modalsekolah></modalsekolah>
          </tr>
        @empty
          <tr>
            <td colspan="4">Tidak Ada Data</td>
          </tr>
        @endforelse
        {{-- <tr align="center">
          <td>1</td>
          <td>sd muh 2</td>
          <td>sekolah dasar</td>
          <td>samarinda ulu</td>
          <td>telok lerong</td>
          <td>
            <a href="#" class="btn btn-info btn-sm" id="modal" data-toggle="modal" data-target="#myIp2">Detail</a>
            <a href="#" class="btn btn-warning btn-sm">Edit</a>
            <a href="#" class="btn btn-danger btn-sm">Delete</a>
          </td>
          <modalsekolah></modalsekolah>
        </tr> --}}
      </tbody>
    </table>
    {{$sekolah->links()}}
  </div>
</div>
