<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $hariini = date("Y-m-d");
        $bulanini = date("m")*1;
        $tahunini = date("Y");
        $nisn = Auth::guard('datasiswa')->user()->nisn;
        $presensihariini = DB::table('presensi')->where('nisn',$nisn)->where('tgl_presensi',$hariini)->first();
        $historibulanini = DB::table('presensi')
        -> leftJoin('jam_sekolah','presensi.kode_jam_sekolah','=','jam_sekolah.kode_jam_sekolah')
        -> where('nisn', $nisn)
        -> whereRaw('MONTH(tgl_presensi)="'.$bulanini.'"')
        -> whereRaw('YEAR(tgl_presensi)="'.$tahunini.'"')
        -> orderBy('tgl_presensi')
        -> get();

        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nisn) as jmlhadir, SUM(IF(jam_in > jam_masuk,1,0)) as jmltelat')
        ->leftjoin('jam_sekolah','presensi.kode_jam_sekolah','=','jam_sekolah.kode_jam_sekolah')
        -> where('nisn', $nisn)
        -> whereRaw('MONTH(tgl_presensi)="'.$bulanini.'"')
        -> whereRaw('YEAR(tgl_presensi)="'.$tahunini.'"')
        -> first();

        $namabulan =["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $leaderboard = DB::table('presensi')
        ->join('datasiswa','presensi.nisn','=','datasiswa.nisn')
        ->where('tgl_presensi', $hariini)
        -> orderBy('jam_in', "desc")
        -> get();

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit ')
        ->where('nisn', $nisn)
        -> whereRaw('MONTH(tgl_izin)="'.$bulanini.'"')
        -> whereRaw('YEAR(tgl_izin)="'.$tahunini.'"')
        -> where('status_approved',1)
        -> first();
        return view('dashboard.dashboard',compact('presensihariini', 'historibulanini','namabulan','bulanini','tahunini','rekappresensi','leaderboard', 'rekapizin'));
    }

    public function dashboardadmin(){
        $hariini = date("Y-m-d");
        $rekappresensi = DB::table('presensi')
        ->selectRaw('COUNT(nisn) as jmlhadir, SUM(IF(jam_in > "07:30",1,0)) as jmltelat')
        -> where('tgl_presensi', $hariini)
        -> first();

        $rekapizin = DB::table('pengajuan_izin')
        ->selectRaw('SUM(IF(status="i",1,0)) as jmlizin, SUM(IF(status="s",1,0)) as jmlsakit ')
        -> where('tgl_izin', $hariini)
        -> where('status_approved',1)
        -> first();
        return view('dashboard.dashboardadmin',compact('rekappresensi','rekapizin'));
    }
}
