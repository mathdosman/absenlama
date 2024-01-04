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
        <form action="/konfigurasi/jamkelas/store" method="POST">
            @csrf
            <div class="row">
                    <div class="col-12">
                            <div class="row mt-2">
                                <div class="col-6">
                                    <div class="form-group">
                                        <select name="kode_kegiatan" id="kode_kegiatan" class="form-select">
                                            <option value="">Pilih Sesi Kegiatan</option>
                                            @foreach ($sesi as $d)
                                                <option value="{{$d->kode_kegiatan}}">{{$d->nama_kegiatan}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <select name="kode_kelas" id="kode_kelas" class="form-select">
                                            <option value="">Pilih Kelas</option>
                                            @foreach ($kelas as $d)
                                                <option value="{{$d->kode_kelas}}">{{$d->nama_kelas}}</option>
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
                                                    <tr>
                                                        <td>Senin
                                                            <input type="hidden" name="hari[]" value="Senin">
                                                        </td>
                                                        <td>
                                                            <select name="kode_jam_sekolah[]" id="kode_jam_sekolah" class="form-select">
                                                                <option value="">Pilih Jam Sekolah</option>
                                                                @foreach ($jamsekolah as $d)
                                                                    <option value="{{$d->kode_jam_sekolah}}">{{$d->nama_jam_sekolah}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Selasa
                                                            <input type="hidden" name="hari[]" value="Selasa">
                                                        </td>
                                                        <td>
                                                            <select name="kode_jam_sekolah[]" id="kode_jam_sekolah" class="form-select">
                                                                <option value="">Pilih Jam Sekolah</option>
                                                                @foreach ($jamsekolah as $d)
                                                                    <option value="{{$d->kode_jam_sekolah}}">{{$d->nama_jam_sekolah}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Rabu
                                                            <input type="hidden" name="hari[]" value="Rabu">
                                                        </td>
                                                        <td>
                                                            <select name="kode_jam_sekolah[]" id="kode_jam_sekolah" class="form-select">
                                                                <option value="">Pilih Jam Sekolah</option>
                                                                @foreach ($jamsekolah as $d)
                                                                    <option value="{{$d->kode_jam_sekolah}}">{{$d->nama_jam_sekolah}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Kamis
                                                            <input type="hidden" name="hari[]" value="Kamis">
                                                        </td>
                                                        <td>
                                                            <select name="kode_jam_sekolah[]" id="kode_jam_sekolah" class="form-select">
                                                                <option value="">Pilih Jam Sekolah</option>
                                                                @foreach ($jamsekolah as $d)
                                                                    <option value="{{$d->kode_jam_sekolah}}">{{$d->nama_jam_sekolah}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Jumat
                                                            <input type="hidden" name="hari[]" value="Jumat">
                                                        </td>
                                                        <td>
                                                            <select name="kode_jam_sekolah[]" id="kode_jam_sekolah" class="form-select">
                                                                <option value="">Pilih Jam Sekolah</option>
                                                                @foreach ($jamsekolah as $d)
                                                                    <option value="{{$d->kode_jam_sekolah}}">{{$d->nama_jam_sekolah}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Sabtu
                                                            <input type="hidden" name="hari[]" value="Sabtu">
                                                        </td>
                                                        <td>
                                                            <select name="kode_jam_sekolah[]" id="kode_jam_sekolah" class="form-select">
                                                                <option value="">Pilih Jam Sekolah</option>
                                                                @foreach ($jamsekolah as $d)
                                                                    <option value="{{$d->kode_jam_sekolah}}">{{$d->nama_jam_sekolah}}</option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                    </tr>
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
