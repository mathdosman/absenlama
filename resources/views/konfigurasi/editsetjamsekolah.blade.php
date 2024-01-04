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
          SET JAM SEKOLAH
          </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
    <div class="container-xl">
            <div class="row">
                    <div class="col-12">
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
                                <table class="table">
                                    <tr>
                                        <th>NISN</th>
                                        <td>:</td>
                                        <td>00{{$siswa->nisn}}</td>
                                    </tr>
                                    <tr>
                                        <th>Nama Lengkap</th>
                                        <td>:</td>
                                        <td>{{$siswa->nama_lengkap}}</td>
                                    </tr>

                                </table>
                            </div>
                        </div>
                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 border">
                                        <form action="/konfigurasi/updatesetjamsekolah" method="POST">
                                            @csrf
                                            <input type="hidden" name="nisn" value="{{$siswa->nisn}}">
                                            <table class="table">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Hari</th>
                                                        <th>Sekolah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($setjamsekolah as $s)
                                                    <tr>
                                                        <td>
                                                            {{$s->hari}}
                                                            <input type="hidden" name="hari[]" value="{{$s->hari}}">
                                                        </td>
                                                        <td>
                                                            <select name="kode_jam_sekolah[]" id="kode_jam_sekolah" class="form-select">
                                                                <option value="">Pilih Jam Sekolah</option>
                                                                @foreach ($jamsekolah as $d)
                                                                    <option {{$d -> kode_jam_sekolah ==$s->kode_jam_sekolah ? 'selected' : ''}} value="{{$d->kode_jam_sekolah}}">{{$d->nama_jam_sekolah}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <button class="btn btn-primary w-100" type="submit">Update</button>
                                        </form>
                                    </div>
                                    <div class="col-6 border">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th colspan="6" class="text-center">MASTER JAM SEKOLAH</th>
                                                </tr>
                                                <tr>
                                                    <th>Kode</th>
                                                    <th>Nama</th>
                                                    <th>Awal Masuk</th>
                                                    <th>Bel Masuk</th>
                                                    <th>Akhir Masuk</th>
                                                    <th>Bel Pulang</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jamsekolah as $d)
                                                <tr>
                                                        <td>{{$d->kode_jam_sekolah}}</td>
                                                        <td>{{$d->nama_jam_sekolah}}</td>
                                                        <td>{{$d->awal_jam_masuk}}</td>
                                                        <td>{{$d->jam_masuk}}</td>
                                                        <td>{{$d->akhir_jam_masuk}}</td>
                                                        <td>{{$d->jam_pulang}}</td>
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
</div>
@endsection
