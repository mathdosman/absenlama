@extends('layouts.presensi')
@section('header')
<!-- App Header -->
<div class="appHeader bg-primary text-light">
    <div class="left">
        <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
        </a>
    </div>
    <div class="pageTitle">e-Absen</div>
    <div class="right"></div>
</div>
<!-- * App Header -->
@endsection
@section('content')
<div class="row" style="margin-top: 70px">
    <div class="col">
        <div class="alert alert-warning">
            <p>
                Maaf, Hari ini tidak ada jadwal absen <br>
                <span class="text-center"><b>Hubungi TIM IT</b></span>
            </p>
        </div>
        </div>
    </div>
</div>
@endsection
