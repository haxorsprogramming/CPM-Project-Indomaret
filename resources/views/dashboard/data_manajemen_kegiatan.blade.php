<div id="div_manajemen_kegiatan">
    <div id="div_data_manajemen_kegiatan" class="row">
        <div style="margin-bottom:15px;">
            <a href="#!" class="btn btn-lg btn-primary  btn-icon icon-left" @click="input_cpm_atc()">
                <i class="fas fa-plus-circle"></i> Input CPM
            </a>
            <a href="#!" class="btn btn-lg btn-info  btn-icon icon-left" @click="proses_perhitungan_cpm()">
                <i class="fas fa-plus-circle"></i> Proses Perhitungan CPM
            </a>
            <a href="#!" class="btn btn-lg btn-success  btn-icon icon-left" @click="export_pdf()">
                <i class="fas fa-plus-circle"></i> Export PDF
            </a>
            <input type="hidden" value="{{ $kd_proyek }}" id="txt_hid_kd_proyek">
        </div>
        <table class="table table-hover" id="tbl_data_manajemen_kegiatan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kegiatan</th>
                    <th>Durasi</th>
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
    </div>
    <div id="div_input_cpm" class="row" style="display:none;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
            <div class="form-group">
                <label>Nama Kegiatan</label>
                <select class="form-control" id="txt_kegiatan">
                    <option value="none">-- Pilih kegiatan --</option>
                    @foreach($data_kegiatan as $kegiatan)
                    <option value="{{ $kegiatan -> kd_kegiatan }}">{{ $kegiatan -> nama_kegiatan }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Sub Kegiatan</label>
                <select class="form-control">
                    <option value="none">-- Pilih sub-kegiatan --</option>
                </select>
            </div>
            <div class="form-group">
                <label>Biaya Crash</label>
                <input type="number" class="form-control" id="txt_biaya_crash">
            </div>
            <div class="form-group">
                <label>Biaya Normal</label>
                <input type="number" class="form-control" id="txt_biaya_normal">
            </div>
            <div class="form-group">
                <label>Tanggal Mulai</label>
                <input type="date" class="form-control" id="txt_tanggal_mulai">
            </div>
            <div class="form-group">
                <label>Tanggal Selesai</label>
                <input type="date" class="form-control" id="txt_tanggal_selesai">
            </div>
            <div>
                <a href="#!" class="btn btn-primary btn-icon icon-left" @click="simpan_atc()">
                    <i class="fas fa-save"></i> Simpan
                </a>&nbsp;&nbsp;
                <a href="#!" class="btn btn-info btn-icon icon-left">
                    <i class="fas fa-i-cursor"></i> Clear
                </a>
            </div>
        </div>
    </div>
</div>

<script>

    var r_to_proses_cpm = server + "dashboard/manajemen-kegiatan/cpm/proses";
    var r_hitung_cpm = server + "dashboard/manajemen-kegiatan/cpm/hitung";
    var r_export = server + "dashboard/manajemen-kegiatan/cpm/export-pdf/";

    $("#tbl_data_manajemen_kegiatan").dataTable();

    var app_manajemen = new Vue({
        el : '#div_manajemen_kegiatan',
        data : {

        },
        methods : {
            simpan_atc : function()
            {
                let kd_kegiatan = document.querySelector("#txt_kegiatan").value;
                let biaya_crash = document.querySelector("#txt_biaya_crash").value;
                let biaya_normal = document.querySelector("#txt_biaya_normal").value;
                let mulai = document.querySelector("#txt_tanggal_mulai").value;
                let selesai = document.querySelector("#txt_tanggal_selesai").value;
                let ds = {'kd_kegiatan':kd_kegiatan, 'biaya_crash':biaya_crash, 'biaya_normal':biaya_normal, 'mulai':mulai, 'selesai':selesai}
                axios.post(r_to_proses_cpm, ds).then(function(res){
                    let dr = res.data;
                    console.log(dr);
                });
            },
            input_cpm_atc : function()
            {
                $("#div_data_manajemen_kegiatan").hide();
                $("#div_input_cpm").show();
            },
            proses_perhitungan_cpm : function()
            {
                let kd_proyek = document.querySelector("#txt_hid_kd_proyek").value;
                let ds = {'kd_proyek':kd_proyek}
                axios.post(r_hitung_cpm, ds).then(function(res){
                    let dr = res.data;
                    pesanUmumApp('success', 'Sukses', 'Berhasil melakukan perhitungan CPM...');
                    divMain.titleApps = "Kegiatan";
                    renderMenu("dashboard/manajemen-kegiatan/detail/"+kd_proyek);
                });
                
            },
            export_pdf : function()
            {
                let kd_proyek = document.querySelector("#txt_hid_kd_proyek").value;
                window.open(r_export+kd_proyek);
            }
        }
    });

</script>