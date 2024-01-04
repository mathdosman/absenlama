<form action="/konfigurasi/updatejs" method="POST" id="frmJs" >
    @csrf
    <div class="row">
        <div class="col-12">
            <label for="">KODE JAM SEKOLAH</label>
            <div class="input-icon mb-3">
            <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-school" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" /><path d="M13.5 15h.5a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-1a2 2 0 0 1 2 -2h.5" /><path d="M16 17a5.698 5.698 0 0 0 4.467 -7.932l-.467 -1.068" /><path d="M10 10v.01" /><path d="M20 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
            </span>
            <input type="text" value="{{$kodejs->kode_jam_sekolah}}" name="kode_jam_sekolah" id="kode_jam_sekolah" class="form-control" placeholder="4 digit" readonly>
            </div>

            <label for="">NAMA JAM SEKOLAH</label>
            <div class="input-icon mb-3">
            <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" /><path d="M18 14v4h4" /><path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" /><path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M8 11h4" /><path d="M8 15h3" /></svg>
            </span>
            <input type="text" value="{{$kodejs->nama_jam_sekolah}}" name="nama_jam_sekolah" id="nama_jam_sekolah" class="form-control" placeholder="NAMA JAM SEKOLAH">
            </div>

            <label for="">AWAL JAM MASUK</label>
            <div class="input-icon mb-3">
            <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12l-3 2" /><path d="M12 7v5" /></svg>
            </span>
            <input type="time" value="{{$kodejs->awal_jam_masuk}}" name="awal_jam_masuk" id="awal_jam_masuk" class="form-control" placeholder="AWAL JAM MASUK">
            </div>

            <label for="">JAM MASUK</label>
            <div class="input-icon mb-3">
            <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-9" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12h-3.5" /><path d="M12 7v5" /></svg>
            </span>
            <input type="time" value="{{$kodejs->jam_masuk}}" name="jam_masuk" id="jam_masuk" class="form-control" placeholder="JAM MASUK">
            </div>

            <label for="#akhir_jam_masuk">AKHIR JAM MASUK</label>
            <div class="input-icon mb-3">
            <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12l3 -2" /><path d="M12 7v5" /></svg>
            </span>
            <input type="time" value="{{$kodejs->akhir_jam_masuk}}" name="akhir_jam_masuk" id="akhir_jam_masuk" class="form-control" placeholder="AKHIR JAM MASUK">
            </div>

            <label for="jam_pulang">JAM PULANG</label>
            <div class="input-icon mb-3">
            <span class="input-icon-addon">
            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-cancel" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20.997 12.25a9 9 0 1 0 -8.718 8.745" /><path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M17 21l4 -4" /><path d="M12 7v5l2 2" /></svg>
            </span>
            <input type="time" value="{{$kodejs->jam_pulang}}" name="jam_pulang" id="jam_pulang" class="form-control" placeholder="JAM PULANG">
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
    $('#frmJs').submit(function(){
                var kode_jam_sekolah = $("#frmJs").find('#kode_jam_sekolah').val();
                var nama_jam_sekolah = $("#frmJs").find('#nama_jam_sekolah').val();
                var awal_jam_masuk = $("#frmJs").find('#awal_jam_masuk').val();
                var jam_masuk = $("#frmJs").find('#jam_masuk').val();
                var akhir_jam_masuk = $("#frmJs").find('#akhir_jam_masuk').val();
                var jam_pulang = $("#frmJs").find('#jam_pulang').val();

                if(kode_jam_sekolah == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Kode Jam Sekolah Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#kode_jam_sekolah").focus();
                    });
                    return false;
                } else  if(nama_jam_sekolah == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Nama Jam Sekolah Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#nama_jam_sekolah").focus();
                    });
                    return false;
                } else if(awal_jam_masuk == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Awal Jam Masuk Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#awal_jam_masuk").focus();
                    });
                    return false;
                } else if(jam_masuk == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Jam Masuk Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#jam_masuk").focus();
                    });
                    return false;
                } else if(akhir_jam_masuk == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Akhir Jam Masuk Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#akhir_jam_masuk").focus();
                    });
                    return false;
                } else if(jam_pulang == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Jam Pulang Harus Diisi !',
                    icon: 'warning',
                    confirmButtonText: 'Ok',
                    }).then((result)=>{
                        $("#jam_pulang").focus();
                    });
                    return false;
                }
            });
});
