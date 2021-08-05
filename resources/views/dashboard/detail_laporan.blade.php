<div id="div_laporan">
    <div id="div_data_laporan" class="row" style="margin-left:20px;">
        <div style="margin-bottom:15px;">
        <h6>Nama Proyek : </h6>
            <a href="#!" class="btn btn-lg btn-primary  btn-icon icon-left">
                <i class="fas fa-plus-circle"></i> Cetak
            </a>
        </div>
        <table class="table table-hover" id="tbl_data_laporan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Durasi</th>
                    <th>Mulai</th>
                    <th>Selesai</th>
                    <th>Sisa Hari</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_hasil as $hasil)
                @php 
                    $selesai = date_create($hasil -> selesai);
                    $sekarang = date_create();
                    $selisih_tanggal = date_diff($selesai, $sekarang);
                    $total_sisa = $selisih_tanggal -> d;
                @endphp
                <tr>
                    <td>{{ $loop -> iteration }}</td>
                    <td>{{ $hasil -> kegiatan_data -> nama_kegiatan }}</td>
                    <td>{{ $hasil -> durasi }}</td>
                    <td>{{ $hasil -> mulai }}</td>
                    <td>{{ $hasil -> selesai }}</td>
                    <td>{{ $selisih_tanggal -> d }} hari</td>
                    <td>
                        @if($total_sisa < 1)
                            <span class="badge badge-success">Selesai</span>
                        @else
                            <span class="badge badge-warning">Belum selesai</span>
                        @endif
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-success"><i class="fas fa-search-plus"></i></a>
                    </td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tbl_data_laporan').dataTable();
</script>