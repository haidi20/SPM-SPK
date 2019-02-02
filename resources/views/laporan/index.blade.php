<html>
	<head>
		<title></title>
	</head>
	<style>
		.content{
			/*margin-left:45%;*/
			text-align: center;
			position: center;
		}
		table{
			text-align: center;
			margin-left: auto;
			margin-right: auto;
		}
	</style>
	<body>
		<div class="content">
			<h1>Warga</h1>
			<br>
			<table border="1">
				<tr>
					<th>No</th>
					<th>Nama Warga</th>
				</tr>
				@foreach($alternatif as $index => $item)
				<tr>
					<td>{{($index + 1)}}</td>
					<td>{{$item->nama}}</td>
				</tr>
				@endforeach
			</table>
			<br>
			<h1>Kriteria</h1>
			<br>
			<table border="1">
				<tr>
					<th>No</th>
					<th>Nama Kriteria</th>
					<th>Bobot</th>
				</tr>
				@foreach($kriteria as $index => $item)
				<tr>
					<td>{{($index + 1)}}</td>
					<td>{{$item->nama}}</td>
					<td>{{$item->bobot}}</td>
				</tr>
				@endforeach
			</table>
			<br>
			<h1>Perbaikan Bobot</h1>
			<br>
			<table border="1">
				<tr>
					<th>No</th>
					<th>Kode</th>
					<th>Nilai</th>
					<td>Bobot</td>
				</tr>
				@foreach($perbaikanBobot as $index => $item)
				<tr>
					<td>{{($index + 1)}}</td>
					<td>{{$item->kode}}</td>
					<td>{{$item->nilai}}</td>
					<td>{{$item->attribute}}</td>
				</tr>
				@endforeach
			</table>
			<br>
			<h1>Vector S</h1>
			<br>
			<table border="1">
				<tr>
					<th>No</th>
					<th>Nilai</th>
				</tr>
				@foreach($vectorS as $index => $item)
				<tr>
					<td>{{($index)}}</td>
					<td>{{$item}}</td>
				</tr>
				@endforeach
			</table>
			<br>
			<h1>Vector V</h1>
			<br>
			<table border="1">
				<tr>
					<th>No</th>
					<th>Nama Warga</th>
					<th>Nilai</th>
					<th>Ranking</th>
				</tr>
				@foreach($vectorV as $index => $item)
				<tr>
					<td>{{($index + 1)}}</td>
					<td>{{$item->alternatif}}</td>
					<td>{{$item->hasilPembagian}}</td>
					<td>{{$item->peringkat}}</td>
				</tr>
				@endforeach
			</table>
			<br><br><br>
		</div>
	</body>
</html>