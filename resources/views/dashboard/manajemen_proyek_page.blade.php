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
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
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
                <a href="#!" class="btn btn-primary btn-icon icon-left">
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
    $("#tbl_data_proyek").dataTable();

    var app_proyek = new Vue({
        el: '#div_proyek',
        data: {

        },
        methods: {
            tambah_proyek_atc: function() {
                $("#div_data_proyek").hide();
                $("#div_tambah_proyek").show();
            }
        }
    });
</script>