<html>
<head>
	<title>Laporan CPM</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
	<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
	</style>
	<center>
		<h5>Laporan Perhitungan CPM</h4>
		<h6>Project {{ $data_proyek -> nama_proyek }}</h5>
	</center>
 
	<table class="table table-hover" id="tbl_data_manajemen_kegiatan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Durasi (Hari)</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>ES</th>
                    <th>EF</th>
                    <th>LS</th>
                    <th>LF</th>
                    <th>Slack</th>
                    <th>Biaya Normal</th>
                    <th>Biaya Crash</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_hasil as $hasil)
                <tr>
                    <td>{{ $loop -> iteration }}</td>
                    <td>{{ $hasil -> kegiatan_data -> nama_kegiatan }}</td>
                    <td>{{ $hasil -> durasi }}</td>
                    <td>{{ $hasil -> mulai }}</td>
                    <td>{{ $hasil -> selesai }}</td>
                    <td>{{ $hasil -> es }}</td>
                    <td>{{ $hasil -> ef }}</td>
                    <td>{{ $hasil -> ls }}</td>
                    <td>{{ $hasil -> lf }}</td>
                    <td>{{ $hasil -> total_slack }}</td>
                    <td>Rp. {{ number_format($hasil -> biaya_normal) }}</td>
                    <td>Rp. {{ number_format($hasil -> biaya_crash) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <hr/>
        <div>
            <strong>Total biaya normal : Rp. {{ number_format($biaya_normal) }}</strong><br/>
            <strong>Total biaya crash : Rp. {{ number_format($biaya_crash) }}</strong><br/>
            <strong>Selisih : Rp. {{ number_format($biaya_crash - $biaya_normal) }}</strong>
        </div>
</body>
</html>