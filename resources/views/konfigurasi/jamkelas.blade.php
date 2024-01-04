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
          KONFIGURASI JAM PER KELAS
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
                                    <a href="/konfigurasi/jamkelas/create" class="btn btn-primary" id="tambahJS">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-plus" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M12 11l0 6" /><path d="M9 14l6 0" /></svg>
                                    Tambah Data</a>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                <table class="table table-bordered">
                            <thead>
                                <tr class="text-center">
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>KELAS</th>
                                    <th>SESI KEGIATAN</th>
                                    <th>AKSI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($jamkelas as $d)
                                    <tr class="text-center">
                                        <td>{{$loop -> iteration}}</td>
                                        <td>{{$d -> kode_js_kelas}}</td>
                                        <td>{{$d -> kode_kelas}}</td>
                                        <td>{{$d -> nama_kegiatan}}</td>
                                        <td class="text-center">
                                            <a href="#" class="edit bg-info border" style="padding: 0.4px;">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" /><path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" /><path d="M16 5l3 3" /></svg>
                                            </a>
                                            <a href="#h" class="bg-success border text-light" style="padding: 0.4px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-eye" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" /></svg>
                                            </a>
                                            <form action="#" method="POST">
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


@endsection

