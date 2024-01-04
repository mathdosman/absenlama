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
          PENGAJUAN IZIN/SAKIT
          </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <div class="row">
            <div class="col-12">
                <form action="/presensi/izinsakit" method="GET" autocomplete="off">
                    <div class="row">
                        <div class="col-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                                </span>
                                <input type="text" value="{{Request('dari')}}" name="dari" id="dari" class="form-control" placeholder="Dari">
                                </div>
                        </div>
                        <div class="col-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-calendar" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12z" /><path d="M16 3v4" /><path d="M8 3v4" /><path d="M4 11h16" /><path d="M11 15h1" /><path d="M12 15v3" /></svg>
                                </span>
                                <input type="text" value="{{Request('sampai')}}" name="sampai" id="sampai" class="form-control" placeholder="Sampai">
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-prompt" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 7l5 5l-5 5" /><path d="M13 17l6 0" /></svg>
                                </span>
                                <input type="text" value="" name="nisn" id="nisn" class="form-control" placeholder="NISN">
                                </div>
                        </div>
                        <div class="col-3">
                            <div class="input-icon mb-3">
                                <span class="input-icon-addon">
                                  <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                                  <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-users" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                                </span>
                                <input type="text" value="{{Request('nama_lengkap')}}" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Siswa">
                                </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <select name="status_approved" id="status_approved" class="form-select">
                                    <option value="">Pilih Status</option>
                                    <option value="0" {{Request('status_approved')=== '0' ? 'selected' : ''}}>Menunggu</option>
                                    <option value="1" {{Request('status_approved')== 1 ? 'selected' : ''}}>Disetujui</option>
                                    <option value="2" {{Request('status_approved')== 2 ? 'selected' : ''}}>Ditolak</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <button class="btn btn-primary" type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-search" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                    Search
                                </button>
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
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>NISN</th>
                            <th>Nama Siswa</th>
                            <th>Kelas</th>
                            <th>Status Ajuan</th>
                            <th>Keterangan</th>
                            <th>Status Approve</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($izinsakit as $d)
                            <tr>
                                <td>{{ $loop -> iteration + $izinsakit -> firstItem() - 1 }}</td>
                                <td>{{date('d-m-Y', strtotime($d->tgl_izin))}}</td>
                                <td>00{{$d->nisn}}</td>
                                <td>{{$d->nama_lengkap}}</td>
                                <td>{{$d->kode_kelas}}</td>
                                <td>{{$d->status=="i" ? "Izin":"Sakit"}}</td>
                                <td>{{$d->keterangan}}</td>
                                <td>
                                    @if($d->status_approved==1)
                                    <span class="badge bg-success text-light">Disetujui</span>
                                    @elseif($d->status_approved==2)
                                    <span class="badge bg-danger text-light">Ditolak</span>
                                    @else
                                    <span class="badge bg-warning text-light">Menunggu</span>
                                    @endif
                                </td>
                                <td>
                                    @if($d->status_approved==0)
                                    <a href="#" class="btn btn-sm btn-primary susah" id_izinsakit="{{$d->id}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-indent-increase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M20 6l-11 0" /><path d="M20 12l-7 0" /><path d="M20 18l-11 0" /><path d="M4 8l4 4l-4 4" /></svg>
                                    </a>
                                        @else
                                        <a href="/presensi/{{$d->id}}/batalkanizinsakit" class="btn btn-sm btn-danger">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-x" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 6l-12 12" /><path d="M6 6l12 12" /></svg>
                                    </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $izinsakit -> links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
<div class="modal modal-blur fade" id="akupusing-modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Izin/Sakit</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="/presensi/approveizinsakit" method="POST">
            @csrf
            <input type="hidden" id="id_izinsakit_form" name="id_izinsakit_form">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                    <select name="status_approved" id="status_approved" class="form-select">
                        <option value="1">Disetujui</option>
                        <option value="2">Ditolak</option>
                    </select>
                </div>
            </div>
        </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="form-group">
                        <button class="btn btn-primary w-100" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-send" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>
                            SUBMIT
                        </button>
                    </div>
                    </div>
                </div>
          </form>
        </div>

      </div>
    </div>
  </div>
@endsection

@push('myscript')
    <script>
        $(function(){
            $(".susah").click(function(e){
                e.preventDefault();
                var id_izinsakit = $(this).attr("id_izinsakit");
                $("#id_izinsakit_form").val(id_izinsakit);
                $("#akupusing-modal").modal("show");
            });

            $("#dari, #sampai").datepicker({
        autoclose: true,
        todayHighlight: true,
        format: "yyyy-mm-dd"
        });
        });
    </script>
@endpush
