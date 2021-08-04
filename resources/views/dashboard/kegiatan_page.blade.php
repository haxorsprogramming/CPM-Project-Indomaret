<div id="div_kegiatan">
    <div id="div_data_kegiatan" class="row">
        <div style="margin-bottom:15px;">
            <a href="#!" class="btn btn-lg btn-primary  btn-icon icon-left" @click="tambah_kegiatan_atc()">
                <i class="fas fa-plus-circle"></i> Tambah Kegiatan
            </a>
        </div>
        <table class="table" id="tbl_data_kegiatan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Kegiatan</th>
                    <th>Nama Kegiatan</th>
                    <th>Nama Proyek</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_kegiatan as $kegiatan)
                <tr>
                    <td>{{ $loop -> iteration }}</td>
                    <td>{{ $kegiatan -> kd_kegiatan }}</td>
                    <td>{{ $kegiatan -> nama_kegiatan }}</td>
                    <td>{{ $kegiatan -> proyek_data -> nama_proyek }}</td>
                    <td></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="div_tambah_kegiatan" class="row" style="display:none;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
            <div class="form-group">
                <label>Kode Kegiatan</label>
                <input type="text" class="form-control" id="txt_kode_kegiatan">
            </div>
            <div class="form-group">
                <label>Nama Kegiatan</label>
                <input type="text" class="form-control" id="txt_nama_kegiatan">
            </div>
            <div class="form-group">
                <label>Deksripsi</label>
                <textarea class="form-control" style="resize:none;" id="txt_deksripsi"></textarea>
            </div>
            <div class="form-group">
                <label>Proyek</label>
                <select class="form-control" id="txt_proyek">
                    <option value="none">-- Pilih Proyek --</option>
                    @foreach($data_proyek as $proyek)
                    <option value="{{ $proyek -> kd_proyek }}">{{ $proyek -> nama_proyek }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Kegiatan pendahulu</label>
                <select class="form-control" id="txt_kegiatan_pendahulu">
                    <option value="none">-- Pilih Kegiatan --</option>
                    <option value="no">-- Tidak ada kegiatan pendahulu --</option>
                </select>
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
    // route 
    var r_proses_tambah_kegiatan = server + "dashboard/kegiatan/tambah/proses";

    $("#tbl_data_kegiatan").dataTable();

    var app_kegiatan = new Vue({
        el : '#div_kegiatan',
        data : {
            
        },
        methods : {
            tambah_kegiatan_atc : function()
            {
                $("#div_data_kegiatan").hide();
                $("#div_tambah_kegiatan").show();
            },
            simpan_atc : function()
            {
                let kd_kegiatan = document.querySelector("#txt_kode_kegiatan").value;
                let nama_kegiatan = document.querySelector("#txt_nama_kegiatan").value;
                let deksripsi = document.querySelector("#txt_deksripsi").value;
                let kd_proyek = document.querySelector("#txt_proyek").value;
                let kd_kegiatan_pendahulu = document.querySelector("#txt_kegiatan_pendahulu").value;

                if(kd_kegiatan === '' || nama_kegiatan === '' || deksripsi === '' || kd_proyek === 'none'){
                    pesanUmumApp('warning', 'Fill field!!!', 'Harap isi seluruh field!!!');
                }else{
                    let ds = {'kd_kegiatan':kd_kegiatan, 'nama_kegiatan':nama_kegiatan, 'deksripsi':deksripsi, 'kd_proyek':kd_proyek, 'kd_kegiatan_pendahulu':kd_kegiatan_pendahulu}
                    axios.post(r_proses_tambah_kegiatan, ds).then(function(res){
                        let dr = res.data;
                        if(dr.status === 'sukses'){
                            pesanUmumApp('success', 'Sukses', 'Berhasil menambahkan kegiatan ...');
                            renderMenu("dashboard/kegiatan/data");
                        }else{

                        }
                    });
                }
                
            }
        }
    });

</script>