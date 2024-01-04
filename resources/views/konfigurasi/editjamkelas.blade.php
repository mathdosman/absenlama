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
          EDIT SET JAM KELAS
          </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
    <div class="container-xl">
        <form action="/konfigurasi/jamkelas/{{$jamkelas->kode_js_kelas}}/update" method="POST">
            @csrf
            <div class="row">
                    <div class="col-12">
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select name="kode_kegiatan" id="kode_kegiatan" class="form-select" disabled>
                                            <option value="">Pilih Sesi Kegiatan</option>
                                            @foreach ($sesi as $d)
                                                <option {{$jamkelas -> kode_kegiatan == $d->kode_kegiatan ? 'selected':'' }} value="{{$d->kode_kegiatan}}">{{$d->nama_kegiatan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select name="kode_kelas" id="kode_kelas" class="form-select" disabled>
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($kelas as $d)
                                                <option {{$jamkelas -> kode_kelas == $d->kode_kelas ? 'selected':'' }} value="{{$d->kode_kelas}}">{{$d->nama_kelas}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        <div class="card mt-2">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6 border">
                                            <table class="table">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th>Hari</th>
                                                        <th>Sekolah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($jamkelas_detail as $s)
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
                                            <button class="btn btn-primary w-100" type="submit">Simpan</button>

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
        </form>
    </div>
</div>
@endsection
