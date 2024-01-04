<form action="/kegiatan/update" method="POST" id="frmkegiatanEdit" >
    @csrf
    <div class="row">
        <div class="col-12">
                    <div class="input-icon mb-3">

                    <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-asterisk" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M12 8.5v7" /><path d="M9 10l6 4" /><path d="M9 14l6 -4" /></svg>
                    </span>
                    <input type="text" value="{{$kegiatan->kode_kegiatan}}" name="kode_kegiatan" id="kode_kegiatan" class="form-control" placeholder="KODE KEGIATAN" readonly>
                    </div>

                    <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12h3v4h-3z" /><path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" /><path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M14 16h2" /><path d="M14 12h4" /></svg>
                    </span>
                    <input type="text" value="{{$kegiatan->nama_kegiatan}}" id="nama_kegiatan" class="form-control" name="nama_kegiatan" placeholder="NAMA KEGIATAN">
                    </div>

                    <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
                    </span>
                    <input type="text" value="{{$kegiatan->lokasi_kegiatan}}" name="lokasi_kegiatan" id="lokasi_kegiatan" class="form-control" placeholder="LOKASI KEGIATAN">
                    </div>

                    <div class="input-icon mb-3">
                    <span class="input-icon-addon">
                    <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44" /><path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14" /><path d="M12 12v9" /></svg>
                    </span>
                    <input type="text" value="{{$kegiatan->radius_kegiatan}}" id="radius_kegiatan" class="form-control" name="radius_kegiatan" placeholder="RADIUS">
                    </div>
        </div>
    </div>
<div class="row">
    <div class="col modal-footer">
    <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
    <button class="btn btn-primary">Simpan Perubahan</button>
</div>
</form>
<script>
$(function(){
    $('#frmkegiatanEdit').submit(function(){
                var kode_kegiatan = $("#frmkegiatanEdit").find('#kode_kegiatan').val();
                var nama_kegiatan = $("#frmkegiatanEdit").find('#nama_kegiatan').val();
                var lokasi_kegiatan = $("#frmkegiatanEdit").find('#lokasi_kegiatan').val();
                var radius_kegiatan = $("#frmkegiatanEdit").find('#radius_kegiatan').val();
                if(kode_kegiatan == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Kode Kegiatan Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#kode_kegiatan").focus();
                    });
                    return false;
                } else  if(nama_kegiatan == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Nama Kegiatan Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#nama_kegiatan").focus();
                    });
                    return false;
                } else if(lokasi_kegiatan == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Lokasi Kegiatan Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#lokasi_kegiatan").focus();
                    });
                    return false;
                } else if(radius_kegiatan == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Radius Kegiatan Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#radius_kegiatan").focus();
                    });
                    return false;
                }
            });
});
</script>
