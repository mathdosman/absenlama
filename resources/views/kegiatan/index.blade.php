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
          CABANG KEGIATAN
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
                                <a href="#" class="btn btn-primary" id="tambahkegiatan">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg>
                                Tambah Data</a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <form action="/kegiatan" method="GET">
                                    <div class="row mb-2">
                                        <div class="col-8">
                                            <select name="kode_kegiatan" class="form-select" id="">
                                                <option value="">Semua Lokasi</option>
                                            </select>
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
                            <th>Kode Kegiatan</th>
                            <th>Nama Kegiatan</th>
                            <th>Lokasi</th>
                            <th>Radius</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kegiatan as $d)
                            <tr class="text-center">
                                <td>{{ $loop -> iteration}}</td>
                                <td>{{ $d -> kode_kegiatan}}</td>
                                <td class="text-start !importan">{{ $d -> nama_kegiatan}}</td>
                                <td>{{ $d -> lokasi_kegiatan}}</td>
                                <td>{{ $d -> radius_kegiatan}} meter</td>
                                <td class="text-center">
                                <a href="#" class="edit bg-info border text-light" style="padding: 0.4px;" kode_kegiatan="{{ $d -> kode_kegiatan }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                </a>

                                <form action="/kegiatan/{{$d->kode_kegiatan}}/delete" method="POST">
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

                    {{-- {{ $wali -> links('vendor.pagination.bootstrap-5') }} --}}

                    </div>
                </div>
            </div>
        </div>
    </div>

<div class="modal modal-blur fade" id="modal-inputkegiatan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data KEGIATAN</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
          <form action="/kegiatan/store" method="POST" id="frmkegiatan" >
                @csrf
                <div class="row">
                    <div class="col-12">
                                <div class="input-icon mb-3">

                                <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-square-asterisk" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 3m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v14a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" /><path d="M12 8.5v7" /><path d="M9 10l6 4" /><path d="M9 14l6 -4" /></svg>
                                </span>
                                <input type="text" value="" name="kode_kegiatan" id="kode_kegiatan" class="form-control" placeholder="KODE KEGIATAN">
                                </div>

                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-id-badge-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 12h3v4h-3z" /><path d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" /><path d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" /><path d="M14 16h2" /><path d="M14 12h4" /></svg>
                                </span>
                                <input type="text" value="" id="nama_kegiatan" class="form-control" name="nama_kegiatan" placeholder="NAMA KEGIATAN">
                                </div>

                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-map-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" /><path d="M9 4v13" /><path d="M15 7v5.5" /><path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" /><path d="M19 18v.01" /></svg>
                                </span>
                                <input type="text" value="" name="lokasi_kegiatan" id="lokasi_kegiatan" class="form-control" placeholder="LOKASI KEGIATAN">
                                </div>

                                <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-radar-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M15.51 15.56a5 5 0 1 0 -3.51 1.44" /><path d="M18.832 17.86a9 9 0 1 0 -6.832 3.14" /><path d="M12 12v9" /></svg>
                                </span>
                                <input type="text" value="" id="radius_kegiatan" class="form-control" name="radius_kegiatan" placeholder="RADIUS">
                                </div>
                    </div>
                </div>
            <div class="row">
                <span>CATATAN: kode kegiatan max 6 karakter</span>
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
<div class="modal modal-blur fade" id="modal-editkegiatan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data kegiatan</h5>
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
            $("#tambahkegiatan").click(function(){
                $("#modal-inputkegiatan").modal("show");
            });

            $(".edit").click(function(){
                var kode_kegiatan = $(this).attr('kode_kegiatan');
                $.ajax({
                    type: 'POST',
                    url:'/kegiatan/edit',
                    cache: false ,
                    data: {
                        _token: "{{csrf_token(); }}",
                        kode_kegiatan : kode_kegiatan
                    },
                    success:function(respond){
                        $("#loadeditform").html(respond);
                    }
                });
                $("#modal-editkegiatan").modal("show");
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


            $('#frmkegiatan').submit(function(){
                var kode_kegiatan = $('#kode_kegiatan').val();
                var nama_kegiatan = $('#nama_kegiatan').val();
                var lokasi_kegiatan = $('#lokasi_kegiatan').val();
                var radius_kegiatan = $('#radius_kegiatan').val();
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
@endpush
