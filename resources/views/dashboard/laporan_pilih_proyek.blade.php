<div id="div_pilih_proyek">
    <div class="form-group">
        <label>Pilih proyek</label>
        <select class="form-control" id="txt_kd_proyek" onchange="set_proyek()">
            <option value="none">-- Pilih proyek --</option>
            @foreach($data_proyek as $proyek)
            <option value="{{ $proyek -> kd_proyek }}">{{ $proyek -> nama_proyek }}</option>
            @endforeach
        </select>
    </div>
</div>

<script>

    function set_proyek()
    {
        let kd_proyek = document.querySelector("#txt_kd_proyek").value;
        divMain.titleApps = "Laporan Proyek "+kd_proyek;
        renderMenu("dashboard/laporan-proyek/"+kd_proyek);
    }

</script>