<div id="div_user">
    <div id="div_data_user" class="row">
        <div style="margin-bottom:15px;">
            <a href="#!" class="btn btn-lg btn-primary  btn-icon icon-left" @click="tambah_user_atc()">
                <i class="fas fa-plus-circle"></i> Tambah User
            </a>
        </div>
        <table class="table table-hover" id="tbl_data_user">
            <thead>
                <tr>
                    <th>No</th>
                    <th>User</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data_user as $user)
                <tr>
                    <td>{{ $loop -> iteration }}</td>
                    <td>{{ $user -> username }}</td>
                    @if($user -> tipe_user == 'admin')
                    <td>Manajer</td>
                    @else
                    <td>Kontraktor</td>
                    @endif
                    <td>
                        <a href="javascript:void(0)" class="btn btn-warning">Hapus</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div id="div_tambah_user" class="row" style="display:none;">
        <div class="col-lg-6 col-md-6 col-sm-6 col-12 mt-3">
            <div class="form-group">
                <label>Nama User</label>
                <input type="text" class="form-control" id="txt_username">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id="txt_password">
            </div>
            <div class="form-group">
                <label>Tipe</label>
                <select class="form-control" id="txt_tipe">
                    <option value="admin">Manager</option>
                    <option value="kontraktor">Kontraktor</option>
                </select>
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
    
    var r_tambah_user_proses = server + "dashboard/manajemen-user/tambah/proses";

    $("#tbl_data_user").dataTable();
    
    var user_app = new Vue({
        el : '#div_user',
        data : {

        },
        methods : {
            tambah_user_atc : function()
            {
                $("#div_tambah_user").show();
                $("#div_data_user").hide();
                document.querySelector("#txt_username").focus();
            },
            simpan_atc : function()
            {
                let username = document.querySelector("#txt_username").value;
                let password = document.querySelector("#txt_password").value;
                let tipe = document.querySelector("#txt_tipe").value;

                if(username === '' || password === ''){
                    pesanUmumApp('warning', 'Fill field!!!', 'Harap isi seluruh field!!!');
                }else{
                    let ds = {'username':username, 'password':password, 'tipe':tipe}
                    axios.post(r_tambah_user_proses, ds).then(function(res){
                        let dr = res.data;
                        pesanUmumApp('success', 'Sukses', 'Berhasil menambahkan user ...');
                        divMain.titleApps = "Manajemen User";
                        renderMenu("dashboard/manajemen-user/data");
                    });
                }

            }
        }
    });

    // route 
    
</script>