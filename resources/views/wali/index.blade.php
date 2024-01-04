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
          DATA WALI KELAS
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
                                <a href="#" class="btn btn-primary" id="tambahkelas">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg>
                                Tambah Data</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form action="/wali" method="GET">
                                    <div class="row mb-2">
                                        <div class="col-8">
                                            <div class="form-group">
                                                <input type="text" class="form-control" placeholder="Nama Wali" name="nama_wali" id="nama_wali" value="{{Request('nama_wali') }}">
                                            </div>
                                        </div>

                                        <div class="col-2">
                                            <div class="form-group">
                                                <button class="btn btn-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                                Cari</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                            </div>
                        </div>
                    <div class="row">
                        <div class="col-12">
                        <table class="table table-bordered">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Kelas</th>
                            <th>Wali</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wali as $d)

                        <tr>
                            <td class="text-center">{{ $loop -> iteration + $wali -> firstItem() - 1 }}</td>
                            <td class="text-center" >{{ $d-> kode_kelas }}</td>
                            <td>{{ $d->nama_wali }}</td>


                            <!-- AKSI start-->
                            <td class="text-center">
                                <a href="#" class="edit bg-info border" style="padding: 0.4px;" kode_kelas="{{ $d -> kode_kelas }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                </a>

                                <form action="/wali/{{$d->kode_kelas}}/delete" method="POST">
                                @csrf
                                <a class="btn btn-danger btn-sm border delete-confirm" ><svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-trash" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></a>
                                </form>
                            </td>
<!-- AKSI end -->
                            @endforeach
                    </tbody>
                </table>
                        </div>
                    </div>

                    {{ $wali -> links('vendor.pagination.bootstrap-5') }}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-blur fade" id="modal-inputkelas" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Kelas dan Wali</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="/wali/store" method="POST" id="frmwali" >
                @csrf
                <div class="row">
                    <div class="col-12">
                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-list-numbers" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M11 6h9" /><path d="M11 12h9" /><path d="M12 18h8" /><path d="M4 16a2 2 0 1 1 4 0c0 .591 -.5 1 -1 1.5l-3 2.5h4" /><path d="M6 10v-6l-2 2" /></svg>
                                </span>
                                <input type="text" value="" name="kode_kelas" id="kode_kelas" class="form-control" placeholder="KELAS">
                                </div>

                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0"></path><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2"></path></svg>
                                </span>
                                <input type="text" value="" id="nama_wali" class="form-control" name="nama_wali" placeholder="NAMA WALI">
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
<div class="modal modal-blur fade" id="modal-editwali" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Kelas dan Wali</h5>
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
            $("#tambahkelas").click(function(){
                $("#modal-inputkelas").modal("show");
            });

            $(".edit").click(function(){
                var kode_kelas = $(this).attr('kode_kelas');
                $.ajax({
                    type: 'POST',
                    url:'/wali/edit',
                    cache: false ,
                    data: {
                        _token: "{{csrf_token(); }}",
                        kode_kelas : kode_kelas
                    },
                    success:function(respond){
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-editwali").modal("show");
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




            $('#frmsiswa').submit(function(){
                var nisn = $('#nisn').val();
                var kode_kelas = $("frmsiswa").find('#kode_kelas').val();
                var jabatan = $("frmsiswa").find('#jabatan').val();
                var nama_lengkap = $('#nama_lengkap').val();
                var no_hp = $('#no_hp').val();
                var foto = $('#foto').val();
                if(nisn == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'NISN harus diisi',
                    icon: 'warning',
                    showconfirmButton: false,
                    timer:5000
                    });
                    $("#nisn").focus();
                    return false;
                }else
                if(kode_kelas == "Pilih Kelas"){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Kelas harus diisi',
                    icon: 'warning',
                    timer:5000
                    });
                    return false;
                }else
                if(jabatan == "Pilih Jabatan"){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Jabatan harus diisi',
                    icon: 'warning',
                    timer:5000
                    });
                    $("#jabatan").focus();
                    return false;
                }else if(nama_lengkap == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'Nama Lengkap harus diisi',
                    icon: 'warning',
                    showconfirmButton: false,
                    timer:5000
                    });
                    $("#nama_lengkap").focus();
                    return false;
                }else if(no_hp == ""){
                    Swal.fire({
                    title: 'Peringatan!',
                    text: 'No Hp harus diisi',
                    icon: 'warning',
                    showconfirmButton: false,
                    timer:5000
                    });
                    $("#no_hp").focus();
                    return false;
                }
            });
        });
    </script>
@endpush
