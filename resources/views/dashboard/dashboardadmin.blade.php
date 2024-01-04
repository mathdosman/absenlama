@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
  <div class="container-xl">
    <div class="row g-2 align-items-center">
        <div class="col">
        <!-- Page pre-title -->
          <div class="page-pretitle">
          Overview
          </div>
          <h2 class="page-title">
          Dashboard
          </h2>
      </div>
    </div>
  </div>
</div>
<div class="page-body">
  <div class="container-xl">
    <div class="row">
      <!-- widget start -->
      <div class="col-md-6 col-xl-3">
        <div class="card card-sm">
          <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-success text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-fingerprint" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18.9 7a8 8 0 0 1 1.1 5v1a6 6 0 0 0 .8 3" /><path d="M8 11a4 4 0 0 1 8 0v1a10 10 0 0 0 2 6" /><path d="M12 11v2a14 14 0 0 0 2.5 8" /><path d="M8 15a18 18 0 0 0 1.8 6" /><path d="M4.9 19a22 22 0 0 1 -.9 -7v-1a8 8 0 0 1 12 -6.95" /></svg>
              </span>
            </div>
            <div class="col">
            <div class="font-weight-medium">
              {{ $rekappresensi -> jmlhadir != null ? $rekappresensi -> jmlhadir : 0 }}
            </div>
            <div class="text-secondary">
              Siswa Hadir
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- widget end -->
<!-- widget start -->
    <div class="col-md-6 col-xl-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-info text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-file-check" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 3v4a1 1 0 0 0 1 1h4" /><path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" /><path d="M9 15l2 2l4 -4" /></svg>
              </span>
            </div>
            <div class="col">
            <div class="font-weight-medium">
            {{ $rekapizin -> jmlizin != null ? $rekapizin -> jmlizin : 0}}
            </div>
            <div class="text-secondary">
              Siswa Izin
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- widget end -->
<!-- widget start -->
    <div class="col-md-6 col-xl-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-warning text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-first-aid-kit" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 8v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" /><path d="M4 8m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M10 14h4" /><path d="M12 12v4" /></svg>
              </span>
            </div>
            <div class="col">
            <div class="font-weight-medium">
            {{ $rekapizin -> jmlsakit != null ? $rekapizin -> jmlsakit : 0}}
            </div>
            <div class="text-secondary">
              Siswa Sakit
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- widget end -->
<!-- widget start -->
    <div class="col-md-6 col-xl-3">
      <div class="card card-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <span class="bg-danger text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/currency-dollar -->
              <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-hourglass-high" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M6.5 7h11" /><path d="M6 20v-2a6 6 0 1 1 12 0v2a1 1 0 0 1 -1 1h-10a1 1 0 0 1 -1 -1z" /><path d="M6 4v2a6 6 0 1 0 12 0v-2a1 1 0 0 0 -1 -1h-10a1 1 0 0 0 -1 1z" /></svg>
              </span>
            </div>
            <div class="col">
            <div class="font-weight-medium">
            {{ $rekappresensi -> jmltelat !=null ? $rekappresensi -> jmltelat : 0 }}
            </div>
            <div class="text-secondary">
            Siswa Terlambat
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<!-- widget end -->
    </div>
  </div>
</div>
@endsection