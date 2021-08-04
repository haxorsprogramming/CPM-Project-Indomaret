<div id="div_sub_kegiatan">
    <div id="div_sub_data_kegiatan" class="row">
        <div style="margin-bottom:15px;">
            <a href="#!" class="btn btn-lg btn-primary  btn-icon icon-left" @click="tambah_sub_kegiatan_atc()">
                <i class="fas fa-plus-circle"></i> Tambah Kegiatan
            </a>
        </div>
        <table class="table" id="tbl_sub_data_kegiatan">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Sub Kegiatan</th>
                    <th>Nama Sub Kegiatan</th>
                    <th>Nama Kegiatan / Proyek</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
               @foreach($data_sub_kegiatan as $sub_kegiatan)
               @php
                $kd_kegiatan = $sub_kegiatan -> kd_kegiatan;
                $kd_proyek = $sub_kegiatan -> kegiatan_data -> kd_proyek;
                $data_proyek = DB::table('tbl_proyek') -> where('kd_proyek', $kd_proyek) -> get();
               @endphp
                <tr>
                    <td>{{ $loop -> iteration }}</td>
                    <td>{{ $sub_kegiatan -> kd_sub_kegiatan }}</td>
                    <td>{{ $sub_kegiatan -> nama_sub_kegiatan }}</td>
                    <td>{{ $sub_kegiatan -> kegiatan_data -> nama_kegiatan }} <br/><b>{{ $data_proyek[0] -> nama_proyek }}</b></td>
                    <td></td>
                </tr>
               @endforeach
            </tbody>
        </table>
    </div>
    <div id="div_tambah_sub_kegiatan" class="row" style="display:none;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
            <div class="form-group">
                <label>Kode Kegiatan</label>
                <input type="text" class="form-control" id="txt_kode_kegiatan">
            </div>
            <div class="form-group">
                <label>Nama Sub Kegiatan</label>
                <input type="text" class="form-control" id="txt_sub_nama_kegiatan">
            </div>
            <div class="form-group">
                <label>Deksripsi</label>
                <textarea class="form-control" style="resize:none;" id="txt_deksripsi"></textarea>
            </div>
            <div class="form-group">
                <label>Proyek</label>
                <select class="form-control" id="txt_proyek" onchange="set_proyek()">
                    <option value="none">-- Pilih Proyek --</option>
                    @foreach($data_proyek as $proyek)
                    <option value="{{ $proyek -> kd_proyek }}">{{ $proyek -> nama_proyek }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>Kegiatan</label>
                <select class="form-control" id="txt_kegiatan">
                    <option value="none">-- Pilih Kegiatan --</option>
                    <option v-for="kg in kegiatan" v-bind:value="kg.kd_kegiatan">@{{ kg.nama }}</option>
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
    var r_get_kegiatan = server + "dashboard/sub-kegiatan/get-kegiatan";
    var r_proses_tambah_sub_kegiatan = server + "dashboard/sub-kegiatan/tambah/proses";
    
    $("#tbl_sub_data_kegiatan").dataTable();

    var app_sub_kegiatan = new Vue({
        el : '#div_sub_kegiatan',
        data : {
            kegiatan : []
        },
        methods : {
            simpan_atc : function()
            {
                let kd_sub_kegiatan = document.querySelector("#txt_kode_kegiatan").value;
                let nama_sub_kegiatan = document.querySelector("#txt_sub_nama_kegiatan").value;
                let deksripsi = document.querySelector("#txt_deksripsi").value;
                let kd_kegiatan = document.querySelector("#txt_kegiatan").value;
                let kd_proyek = document.querySelector("#txt_proyek").value;
                let ds = {'kd_sub_kegiatan':kd_sub_kegiatan, 'nama_sub_kegiatan':nama_sub_kegiatan, 'deksripsi':deksripsi, 'kd_kegiatan':kd_kegiatan}

                axios.post(r_proses_tambah_sub_kegiatan, ds).then(function(res){
                    let dr = res.data;
                    if(dr.status === 'sukses'){
                        pesanUmumApp('success', 'Sukses', 'Berhasil menambahkan sub kegiatan ...');
                        divMain.titleApps = "Sub Kegiatan";
                        renderMenu("dashboard/sub-kegiatan/data");
                    }else{
                        
                    }
                });
            },
            tambah_sub_kegiatan_atc : function()
            {
                $("#div_sub_data_kegiatan").hide();
                $("#div_tambah_sub_kegiatan").show();
            }
        }
    });

    function set_proyek()
    {
        let kd_proyek = document.querySelector("#txt_proyek").value;
        let ds = {'kd_proyek':kd_proyek}
        axios.post(r_get_kegiatan, ds).then(function(res){
            let dr = res.data;
            let kegiatan = dr.data_kegiatan;
            let jlh_kegiatan = app_sub_kegiatan.kegiatan.length;
            var i;
            for(i = 0; i < jlh_kegiatan; i++){
                app_sub_kegiatan.kegiatan.splice(0,1);
            }
            kegiatan.forEach(render_kegiatan);
            function render_kegiatan(item, index){
                app_sub_kegiatan.kegiatan.push({nama:kegiatan[index].nama_kegiatan, kd_kegiatan:kegiatan[index].kd_kegiatan});
            }
        });
    }

</script>