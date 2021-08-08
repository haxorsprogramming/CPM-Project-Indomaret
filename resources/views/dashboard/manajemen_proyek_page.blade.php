<div id="div_proyek">
    <div id="div_data_proyek" class="row">
        <div style="margin-bottom:15px;">
            <a href="#!" class="btn btn-lg btn-primary  btn-icon icon-left" @click="tambah_proyek_atc()">
                <i class="fas fa-plus-circle"></i> Tambah Proyek
            </a>
        </div>
        <table class="table" id="tbl_data_proyek">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Proyek</th>
                    <th>Nama Proyek</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_proyek as $proyek)
                <tr>
                    <td>{{ $loop -> iteration }}</td>
                    <td>{{ $proyek -> kd_proyek }}</td>
                    <td>{{ $proyek -> nama_proyek }}</td>
                    <td>
                        <a href="javascript:void(0)" class="btn btn-warning" @click="editAtc('{{ $proyek -> kd_proyek }}')"><i class=""></i>Edit</a>
                        <a href="javascript:void(0)" class="btn btn-primary" @click="hapusAtc('{{ $proyek -> kd_proyek }}')"><i class="fa fa-trash"></i> Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="div_tambah_proyek" class="row" style="display:none;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
            <div class="form-group">
                <label>Kode Proyek</label>
                <input type="text" class="form-control" id="txt_kode_proyek">
            </div>
            <div class="form-group">
                <label>Nama Proyek</label>
                <input type="text" class="form-control" id="txt_nama_proyek">
            </div>
            <div class="form-group">
                <label>Deksripsi</label>
                <textarea class="form-control" style="resize:none;" id="txt_deksripsi"></textarea>
            </div>
            <div>
                <a href="#!" class="btn btn-primary btn-icon icon-left" @click="simpan_atc()">
                    <i class="fas fa-save"></i> Simpan
                </a>&nbsp;&nbsp;
               
            </div>
        </div>
    </div>
</div>

<script>
    // route 
    var r_proses_tambah_proyek = server + "dashboard/manajemen-proyek/tambah/proses";
    var r_proses_hapus = server + "dashboard/manajemen-proyek/hapus/proses";

    $("#tbl_data_proyek").dataTable();

    var app_proyek = new Vue({
        el: '#div_proyek',
        data: {

        },
        methods: {
            tambah_proyek_atc: function() {
                $("#div_data_proyek").hide();
                $("#div_tambah_proyek").show();
            },
            simpan_atc : function()
            {
                let kd_proyek = document.querySelector("#txt_kode_proyek").value;
                let nama_proyek = document.querySelector("#txt_nama_proyek").value;
                let deksripsi = document.querySelector("#txt_deksripsi").value;
                if(kd_proyek === '' || nama_proyek === '' || deksripsi === ''){
                    pesanUmumApp('warning', 'Fill field!!!', 'Harap isi seluruh field!!!');
                }else{
                    let ds = {'kd_proyek':kd_proyek, 'nama_proyek':nama_proyek, 'deksripsi':deksripsi}
                    axios.post(r_proses_tambah_proyek, ds).then(function(res){
                        let dr = res.data;
                        if(dr.status === 'sukses'){
                            pesanUmumApp('success', 'Sukses', 'Berhasil menambahkan proyek ');
                            divMain.titleApps = "Manajemen Proyek";
                            renderMenu("dashboard/manajemen-proyek/data");
                        }else{

                        }
                    });
                }
            },
            hapusAtc : function(kd_proyek)
            {
                let konfirmasi = window.confirm("Yakin menghapus proyek ... ?");
                if(konfirmasi === true){
                    let ds = {'kd_proyek':kd_proyek}
                    axios.post(r_proses_hapus, ds).then(function(res){
                        let dr = res.data;
                        pesanUmumApp('success', 'Sukses', 'Berhasil menghapus proyek');
                        divMain.titleApps = "Manajemen Proyek";
                        renderMenu("dashboard/manajemen-proyek/data");
                    });
                }else{

                }
            },
            editAtc : function(kd_proyek)
            {
                divMain.titleApps = "Edit Proyek";
                renderMenu("dashboard/manajemen-proyek/edit/"+kd_proyek);
            }
        }
    });
    
</script>