<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <!-- Normalize or reset CSS with your favorite library -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">

  <!-- Load paper.css for happy printing -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <!-- Set page size here: A5, A4 or A3 -->
  <!-- Set also "landscape" if you need -->
  <style>@page { size: A4 }
#title{
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    font-size: 18px;
    font-weight: bold;
  }
  .tabeldatasiswa {
    margin-top:40px;
  }
  .tabelpresensi{
    width: 100%;
    margin-top: 20px;
    border-collapse: collapse;
}
.tabelpresensi  tr th{
      border:1px solid #0c0c0c;
      text-align: center;
    paddings: 8px;
    background-color: #d6d3d3
  }
.tabelpresensi  tr td{
    border:1px solid #0c0c0c;
    paddings: 5px;
    font-size: 12px;
    text-align: center;
  }
  .avatar{
    width: 40px;
    height: 45px;
  }
</style>

</head>

<!-- Set "A5", "A4" or "A3" for class name -->
<!-- Set also "landscape" if you need -->
<body class="A4">
<?php
function selisih($jam_masuk, $jam_keluar)
        {
            list($h, $m, $s) = explode(":", $jam_masuk);
            $dtAwal = mktime($h, $m, $s, "1", "1", "1");
            list($h, $m, $s) = explode(":", $jam_keluar);
            $dtAkhir = mktime($h, $m, $s, "1", "1", "1");
            $dtSelisih = $dtAkhir - $dtAwal;
            $totalmenit = $dtSelisih / 60;
            $jam = explode(".", $totalmenit / 60);
            $sisamenit = ($totalmenit / 60) - $jam[0];
            $sisamenit2 = $sisamenit * 60;
            $jml_jam = $jam[0];
            return $jml_jam . ":" . round($sisamenit2);
        }
?>
  <!-- Each sheet element should have the class "sheet" -->
  <!-- "padding-**mm" is optional: you can set 10, 15, 20 or 25 -->
  <section class="sheet padding-10mm">
<table style="width: 100%">
    <tr>
        <td style="width: 30px">
            <img src="{{asset('assets/img/logodosman.png')}}" width="100" height="100" alt="">
        </td>
        <td style="text-align: center">
            <span id="title"><b> Laporan Absensi Siswa <br> Periode {{$namabulan[$bulan]}} {{$tahun}} </b>
            </span> <br>
                <span > <b> SMA Negeri 1 Gianyar</span> </b> <br>
                <span style="margin-top:2px">Jln. Ratna, Tegal Tugu Gianyar, Telp: (0361) 943034</span> <br>
                <small>Website:https//sman1-gianyar.sch.id, email:sman1.gianyar1963@gmail.com</small>
        </td>
    </tr>
</table>
<table class="tabeldatasiswa" style="padding: 1rem">
    <tr>
        <td rowspan="6">
            @php
                $path = Storage::url('uploads/datasiswa/'.$siswa -> foto);
            @endphp
            @if ($siswa->foto != null)
            <img src="{{url($path)}}" width="80" height="100" alt="">
            @else
            <img src="/tabler/static/no_foto.jpg" alt="xxxx" width="80" height="100">
            @endif

            {{-- <img src="{{url($path)}}" alt="" width="80" height="100"> --}}
        </td>
    </tr>
    <tr>
        <td>NISN</td>
        <td>:</td>
        <td>{{$siswa ->nisn}}</td>
    </tr>
    <tr>
        <td>Nama Siswa</td>
        <td>:</td>
        <td>{{$siswa ->nama_lengkap}}</td>
    </tr>
    <tr>
        <td>Kelas</td>
        <td>:</td>
        <td>{{$siswa ->kode_kelas}}</td>
    </tr>
    <tr>
        <td>No. Hp</td>
        <td>:</td>
        <td>{{$siswa ->no_hp}}</td>
    </tr>
</table>

<table class="tabelpresensi"  >
<tr>
    <th>No</th>
    <th>Tanggal</th>
    <th>Jam Masuk</th>
    <th>Foto</th>
    <th>Jam Pulang</th>
    <th>Foto</th>
    <th>Keterangan <br>(jam:menit)</th>
</tr>
<tr>
@foreach ($presensi as $d)
@php
$path_in = Storage::url('uploads/absensi/'.$d -> foto_in);
$path_out = Storage::url('uploads/absensi/'.$d -> foto_out);
$jamterlambat = selisih($d->jam_masuk,$d->jam_in);
@endphp
<td>{{$loop ->iteration}}</td>
<td>{{date("d-m-Y",strtotime($d->tgl_presensi))}}</td>
<td>{{$d -> jam_in}}</td>
<td>
    <img src="{{url($path_in)}}" alt="" class="avatar">
</td>
<td>{{$d -> jam_out !== null ? $d -> jam_out: 'belum absen'}}</td>
<td>
    @if ($d->foto_out != null)
    <img src="{{url($path_out)}}" alt="" class="avatar">
    @else
    <img src="/tabler/static/no_foto.jpg" class="avatar" alt="xxxx">
    @endif
</td>
<td>
    @if ($d->jam_in > $d->jam_masuk)
    Terlambat {{$jamterlambat}}
    @else
    Tepat Waktu
    @endif
</td>
</tr>
@endforeach
</table>
<table width="100%" style="margin-top: 80px" >
    <tr>
        <td style="text-align: left">
            <span style="margin-left: 500px;">Gianyar, {{date('d-m-Y')}}</span>
            <br>
            <br>
            <br>
            <br>
           <u style="margin-left: 500px"> I Putu Darma Putra, S.Pd </u> <br>
           <i style="margin-left: 500px"><b>Guru Piket</b></i>
        </td>
    </tr>
</table>

  </section>

</body>

</html>
