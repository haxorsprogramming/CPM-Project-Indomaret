<div id="div_edit_proyek">
    <div class="form-group">
        <label>Kode Proyek</label>
        <input type="text" class="form-control" id="txt_kode_proyek" readonly value="{{ $data_proyek -> kd_proyek }}">
    </div>
    <div class="form-group">
        <label>Nama Proyek</label>
        <input type="text" class="form-control" id="txt_nama_proyek" value="{{ $data_proyek -> nama_proyek }}">
    </div>
    <div class="form-group">
        <label>Deksripsi</label>
        <textarea class="form-control" style="resize:none;" id="txt_deksripsi">{{ $data_proyek -> deksripsi }}</textarea>
    </div>

    <div class="form-group">
        <a href="javascript:void(0)" class="btn btn-primary" @click="update_atc()">Update</a>
    </div>
</div>
<script>

    var r_update_proses = server + "dashboard/manajemen-proyek/edit/proses";

    var edit_app = new Vue({
        el: '#div_edit_proyek',
        data: {

        },
        methods: {
            update_atc: function() {
                let kd_proyek = document.querySelector("#txt_kode_proyek").value;
                let nama_proyek = document.querySelector("#txt_nama_proyek").value;
                let deksripsi = document.querySelector("#txt_deksripsi").value;
                let ds = {'kd_proyek':kd_proyek, 'nama_proyek':nama_proyek, 'deksripsi':deksripsi}
                axios.post(r_update_proses, ds).then(function(res){
                    let dr = res.data;
                    pesanUmumApp('success', 'Sukses', 'Berhasil mengumpdate proyek ');
                    divMain.titleApps = "Manajemen Proyek";
                    renderMenu("dashboard/manajemen-proyek/data");
                });
            }
        }
    });
</script>