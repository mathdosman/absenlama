@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
          <div class="page-pretitle">
          SMA Negeri 1 Gianyar
          </div>
          <h2 class="page-title">
          KONFIGURASI JAM SEKOLAH
          </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
    <div class="container-xl">
            <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                        @endif

                        @if(Session::get('warning'))
                        <div class="alert alert-warning">
                            {{ Session::get('warning') }}
                        </div>
                        @endif
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col">
                                    <a href="#" class="btn btn-primary" id="tambahJS">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg>
                                    Tambah Data</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kode JS</th>
                                    <th>Nama JS</th>
                                    <th>Awal Jam Masuk</th>
                                    <th>Jam Masuk</th>
                                    <th>Akhir Jam Masuk</th>
                                    <th>Jam Pulang</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jam_sekolah as $d)
                                <tr class="text-center">
                                    <td>{{$loop -> iteration}}</td>
                                    <td>{{$d -> kode_jam_sekolah}}</td>
                                    <td>{{$d -> nama_jam_sekolah}}</td>
                                    <td>{{$d -> awal_jam_masuk}}</td>
                                    <td>{{$d -> jam_masuk}}</td>
                                    <td>{{$d -> akhir_jam_masuk}}</td>
                                    <td>{{$d -> jam_pulang}}</td>
                                    <td class="text-center">
                                        <a href="#" class="edit bg-info border text-light" style="padding: 0.4px;" kode_jam_sekolah="{{ $d -> kode_jam_sekolah }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                        </a>

                                        <form action="/konfigurasi/{{$d->kode_jam_sekolah}}/delete" method="POST">
                                        @csrf
                                        <a class="btn btn-danger btn-sm border delete-confirm" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>

    </div>
</div>

<div class="modal modal-blur fade" id="modal-inputJS" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Tambah Data Jam Sekolah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
        <form action="/konfigurasi/storejamsekolah" method="POST" id="frmjamsekolah" >
              @csrf
              <div class="row">
                  <div class="col-12">
                            <label for="">KODE JAM SEKOLAH</label>
                              <div class="input-icon mb-3">
                              <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-bell-school" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-6 0a6 6 0 1 0 12 0a6 6 0 1 0 -12 0" /><path d="M13.5 15h.5a2 2 0 0 1 2 2v1a2 2 0 0 1 -2 2h-8a2 2 0 0 1 -2 -2v-1a2 2 0 0 1 2 -2h.5" /><path d="M16 17a5.698 5.698 0 0 0 4.467 -7.932l-.467 -1.068" /><path d="M10 10v.01" /><path d="M20 8m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /></svg>
                              </span>
                              <input type="text" value="" name="kode_jam_sekolah" id="kode_jam_sekolah" class="form-control" placeholder="4 digit">
                              </div>

                              <label for="">NAMA JAM SEKOLAH</label>
                              <div class="input-icon mb-3">
                              <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-report" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h5.697" /><path d="M18 14v4h4" /><path d="M18 11v-4a2 2 0 0 0 -2 -2h-2" /><path d="M8 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" /><path d="M18 18m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M8 11h4" /><path d="M8 15h3" /></svg>
                              </span>
                              <input type="text" value="" name="nama_jam_sekolah" id="nama_jam_sekolah" class="form-control" placeholder="NAMA JAM SEKOLAH">
                              </div>

                              <label for="">AWAL JAM MASUK</label>
                              <div class="input-icon mb-3">
                              <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-8" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12l-3 2" /><path d="M12 7v5" /></svg>
                              </span>
                              <input type="time" value="" name="awal_jam_masuk" id="awal_jam_masuk" class="form-control" placeholder="AWAL JAM MASUK">
                              </div>

                              <label for="">JAM MASUK</label>
                              <div class="input-icon mb-3">
                              <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-9" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12h-3.5" /><path d="M12 7v5" /></svg>
                              </span>
                              <input type="time" value="" name="jam_masuk" id="jam_masuk" class="form-control" placeholder="JAM MASUK">
                              </div>

                              <label for="#akhir_jam_masuk">AKHIR JAM MASUK</label>
                              <div class="input-icon mb-3">
                              <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-hour-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M12 12l3 -2" /><path d="M12 7v5" /></svg>
                              </span>
                              <input type="time" value="" name="akhir_jam_masuk" id="akhir_jam_masuk" class="form-control" placeholder="AKHIR JAM MASUK">
                              </div>

                              <label for="jam_pulang">JAM PULANG</label>
                              <div class="input-icon mb-3">
                              <span class="input-icon-addon">
                              <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-clock-cancel" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20.997 12.25a9 9 0 1 0 -8.718 8.745" /><path d="M19 19m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" /><path d="M17 21l4 -4" /><path d="M12 7v5l2 2" /></svg>
                              </span>
                              <input type="time" value="" name="jam_pulang" id="jam_pulang" class="form-control" placeholder="JAM PULANG">
                              </div>
                  </div>
              </div>
          <div class="row">
              <div class="col modal-footer">
              <button type="button" class="btn me-auto" data-bs-dismiss="modal">Close</button>
              <button class="btn btn-primary">Tambah Data</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- =====================MODAL EDIT DATA======================= -->
<div class="modal modal-blur fade" id="modal-editjamsekolah" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Konfigurasi Jam Sekolah</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body" id="loadeditform">

        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('myscript')
<script>
$(function(){
    $("#tambahJS").click(function(){
                $("#modal-inputJS").modal("show");
            });

            $(".edit").click(function(){
                var kode_jam_sekolah = $(this).attr('kode_jam_sekolah');
                $.ajax({
                    type: 'POST',
                    url:'/konfigurasi/editjamsekolah',
                    cache: false ,
                    data: {
                        _token: "{{csrf_token(); }}",
                        kode_jam_sekolah : kode_jam_sekolah
                    },
                    success:function(respond){
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-editjamsekolah").modal("show");
            });

            $(".delete-confirm").click(function(e){
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                title: "Anda yakin?",
                text: "Data akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus data!"
                }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                    Swal.fire({
                    title: "Terhapus!",
                    text: "Data telah terhapus.",
                    icon: "success"
                    });
                }
                });
            });




            $('#frmjamsekolah').submit(function(){
                var kode_jam_sekolah = $('#kode_jam_sekolah').val();
                var nama_jam_sekolah = $('#nama_jam_sekolah').val();
                var awal_jam_masuk = $('#awal_jam_masuk').val();
                var jam_masuk = $('#jam_masuk').val();
                var Akhir_jam_masuk = $('#Akhir_jam_masuk').val();
                var jam_pulang = $('#jam_pulang').val();

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
                    text: 'Akhir Jam Harus Diisi !',
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

</script>
@endpush
