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
          MONITORING ABSENSI
          </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
    <div class="container-xl">
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                <div class="form-group">
                <div class="input-icon mb-3">
                                <span class="input-icon-addon" >
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12.5 21h-6.5a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v5" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M16 19h6" /><path d="M19 16v6" /></svg>
                                </span>
                                <input type="text" value="{{ date("Y-m-d")}}" id="tanggal" name="tanggal" class="form-control" placeholder="Tanggal Absen" autocomplete="off">
                              </div>
            </div>
        </div>
                </div>
            </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table table-bordered">
                <thead class="text-center">
                    <tr>
                        <th>No</th>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas</th>
                        <th>Jadwal</th>
                        <th>Jam Masuk</th>
                        <th>Foto Masuk</th>
                        <th>Jam Pulang</th>
                        <th>Foto Pulang</th>
                        <th>Keterangan <br> (jam:menit)</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="loadpresensi" class="text-center">

                </tbody>
            </table>
        </div>
    </div>

    </div>
</div>
<!-- =====================MODAL EDIT DATA======================= -->
<div class="modal modal-blur fade" id="modal-tampilkanpeta" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Lokasi Absensi Siswa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadmaps">

          </div>

        </div>
      </div>
    </div>
@endsection

@push('myscript')
    <script>
    $(function () {
        $("#tanggal").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd"
        });

        function loadpresensi(){
            var tanggal = $("#tanggal").val();
            $.ajax({
                type:'POST',
                url:'/getpresensi',
                data:{
                    _token:"{{csrf_token()}}",
                    tanggal: tanggal
                },
                cache:false,
                success:function(respond){
                    $("#loadpresensi").html(respond);
                }
            });
        }

        $("#tanggal").change(function(e){
            loadpresensi();
        });

        loadpresensi();

    });
    </script>
@endpush
