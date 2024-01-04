<?php

namespace App\Http\Controllers;

use App\Models\Pengajuanizin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class PresensiController extends Controller
{
    public function gethari()
    {
        $hari = date("D");
        switch($hari){
            case 'Sun':
                $hari_ini = "Minggu";
                break;
            case 'Mon':
                $hari_ini = "Senin";
                break;
            case 'Tue':
                $hari_ini = "Selasa";
                break;
            case 'Wed':
                $hari_ini = "Rabu";
                break;
            case 'Thu':
                $hari_ini = "Kamis";
                break;
            case 'Fri':
                $hari_ini = "Jumat";
                break;
            case 'Sat':
                $hari_ini = "Sabtu";
                break;

            default:
            $hari_ini = "Tidak diketahui";
            break;
        }
        return $hari_ini;
    }
    public function create()
    {
        $hariini = date("Y-m-d");
        $namahari = $this ->gethari();
        $nisn = Auth::guard('datasiswa')->user()->nisn;
        $cek = DB::table('presensi')->where('tgl_presensi', $hariini)->where('nisn', $nisn)->count();
        $kode_kegiatan = Auth::guard('datasiswa')->user()->kode_kegiatan;
        $lok_sekolah =DB::table('kegiatan')->where('kode_kegiatan',$kode_kegiatan)->first();
        $jamsekolah = DB::table('konfigurasi_jam')
        ->join('jam_sekolah','jam_sekolah.kode_jam_sekolah','=','konfigurasi_jam.kode_jam_sekolah')
        ->where('nisn',$nisn)->where('hari', $namahari)->first();
        return view('presensi.create',compact('cek','lok_sekolah','jamsekolah'));
    }
    public function store(Request $request)
    {
        $nisn = Auth::guard('datasiswa')->user()->nisn;
        $kode_kegiatan = Auth::guard('datasiswa')->user()->kode_kegiatan;
        $tgl_presensi = date("Y-m-d");
        $jam = date("H:i:s");
        $lok_sekolah =DB::table('kegiatan')->where('kode_kegiatan',$kode_kegiatan)->first();
        $lok = explode(",",$lok_sekolah -> lokasi_kegiatan);

        $lokasi = $request -> lokasi;
        $latitudekegiatan = $lok[0];
        $longitudekegiatan = $lok[1];
        $lokasiuser=explode(",",$lokasi);
        $latitudeuser = $lokasiuser[0];
        $longitudeuser = $lokasiuser[1];
        $jarak = $this->distance($latitudekegiatan, $longitudekegiatan,$latitudeuser,$longitudeuser);
        $radius = round($jarak["meters"]);

//CEK JAM SEKOLAH
        $namahari = $this ->gethari();
        $jamsekolah = DB::table('konfigurasi_jam')
        ->join('jam_sekolah','jam_sekolah.kode_jam_sekolah','=','konfigurasi_jam.kode_jam_sekolah')
        ->where('nisn',$nisn)->where('hari', $namahari)->first();

        $cek = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nisn', $nisn)->count();

        if($cek > 0){
            $ket="out";
        } else{
            $ket = "in";
        }
        $image = $request -> image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nisn . "-". $tgl_presensi."-".$ket;
        $image_parts = explode(";base64", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath.$fileName;



        if($radius > $lok_sekolah ->radius_kegiatan){
            echo "error|Maaf Anda Berada diluar radius absen, jarak anda ".$radius." meter dari sekolah|radius";
        }else{
            if($cek > 0){
                if($jam < $jamsekolah ->jam_pulang){
                    echo "error|Maaf Absensi Pulang Belum Dapat Dilakukan !|out";
                }else {
                    $data_pulang=[
                        'jam_out' => $jam,
                        'foto_out' => $fileName,
                        'lokasi_out' => $lokasi
                    ];
                    $update = DB::table('presensi')->where('tgl_presensi', $tgl_presensi)->where('nisn',$nisn)->update($data_pulang);
                    if($update){
                        echo "success|Hati-hati di jalan!|out";
                        storage::put($file, $image_base64);
                    } else {
                        echo "error|Maaf Gagal Absen, Hubungi Tim IT|out";
                    }
                }

        } else {
            if($jam < $jamsekolah->awal_jam_masuk){
                echo "error|Maaf, Belum Waktunya melakukan Absensi Masuk!|in";
            } else if($jam > $jamsekolah->akhir_jam_masuk){
                echo "error|Maaf, Waktu Absensi Masuk Telah Berakhir !|in";
            } else {
                $data=[
                    'nisn' => $nisn,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi,
                    'kode_jam_sekolah' => $jamsekolah->kode_jam_sekolah
                ];
                $simpan = DB::table('presensi')->insert($data);
            if($simpan){
                echo "success|Selamat Belajar!|in";
                storage::put($file, $image_base64);
            }else{
                echo "error|Maaf Gagal Absen, Hubungi Tim IT|in";
            }
            }

        }
        }
    }

    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }



    public function editprofile()
    {
        $nisn = Auth::guard('datasiswa')->user()->nisn;
        $datasiswa = DB::table('datasiswa')->where('nisn', $nisn)->first();
        return view('presensi.editprofile', compact('datasiswa') );
    }

    public function updateprofile(Request $request){
        $nisn = Auth::guard('datasiswa')->user()->nisn;
        $nama_lengkap = $request ->nama_lengkap;
        $no_hp = $request -> no_hp;
        $password = Hash::make($request->password);
        $datasiswa = DB::table('datasiswa')->where('nisn', $nisn)->first();
        if($request ->hasFile('foto')){
            $foto = $nisn.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto=$datasiswa -> foto;
        }

        if(empty($request -> password)){
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto
            ];

        }else{
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'password' => $password,
                'foto' => $foto
            ];
        }

        $update = DB::table('datasiswa')->where('nisn', $nisn)->update($data);
        if($update){
            if($request->hasFile('foto')){
                $folderPath = "public/uploads/datasiswa/";
                $request -> file('foto')->storeAs($folderPath, $foto);
            }
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        }else{
            return Redirect::back()->with(['success'=>'Data Gagal di Diupdate']);
        }
    }

    public function histori()
    {
        $namabulan =["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        return view('presensi.histori',compact('namabulan'));
    }

    public function gethistori(Request $request){
            $bulan = $request -> bulan;
            $tahun = $request -> tahun;
            $nisn = Auth::guard('datasiswa')->user()->nisn;

            $histori = DB::table('presensi')
            -> whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
            -> whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
            ->where('nisn',$nisn)
            ->orderBy('tgl_presensi')
            ->get();

            return view('presensi.gethistori', compact('histori'));
    }

    public function izin()
    {
        $nisn = Auth::guard('datasiswa')->user()->nisn;
        $dataizin = DB::table('pengajuan_izin') -> where('nisn',$nisn)->get();
        return view('presensi.izin', compact('dataizin'));
    }

    public function buatizin()
    {

        return view('presensi.buatizin');
    }

    public function storeizin(Request $request)
    {
        $nisn = Auth::guard('datasiswa')->user()->nisn;
        $tgl_izin = $request -> tgl_izin;
        $status = $request -> status;
        $keterangan = $request -> keterangan;

        $data = [
            'nisn' =>$nisn,
            'tgl_izin' =>$tgl_izin,
            'status' =>$status,
            'keterangan' =>$keterangan
        ];

        $simpan = DB::table('pengajuan_izin')->insert($data);

        if($simpan){
            return redirect('/presensi/izin')->with(['success'=>'Data Berhasil dikirim']);
        } else{
            return redirect('/presensi/izin')->with(['error'=>'Data Gagal dikirim']);
        }

    }


    public function monitoring()
    {
        return view('presensi.monitoring');
    }

    public function getpresensi(Request $request)
    {
        $tanggal = $request->tanggal;
        $presensi = DB::table('presensi')
        ->select('presensi.*','nama_lengkap','nama_kelas','jam_masuk','nama_jam_sekolah','jam_masuk','jam_pulang')
        -> leftjoin('jam_sekolah','presensi.kode_jam_sekolah','=','jam_sekolah.kode_jam_sekolah')
        ->join('datasiswa','presensi.nisn','=','datasiswa.nisn')
        ->join('tabelkelas','datasiswa.kode_kelas','=','tabelkelas.kode_kelas')
        ->where('tgl_presensi',$tanggal)
        ->get();
        return view('presensi.getpresensi',compact('presensi'));

    }

    public function tampilkanpeta(Request $request)
    {
        $id = $request -> id;
        $presensi = DB::table('presensi')->where('id', $id)
        -> join('datasiswa', 'presensi.nisn','=','datasiswa.nisn')
        ->first();
        $lok_sekolah =DB::table('konfigurasi_lokasi')->where('id',1)->first();
        return view ('presensi.showmap', compact('presensi','lok_sekolah'));
    }

    public function laporan(){
        $namabulan =["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $siswa=DB::table('datasiswa')->orderBy('nama_lengkap')->get();
        return view('presensi.laporan', compact('namabulan','siswa'));
    }

    public function cetaklaporan(Request $request){
        $nisn = $request ->nisn;
        $bulan = $request -> bulan;
        $tahun = $request -> tahun;
        $namabulan =["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $siswa = DB::table('datasiswa')->where ('nisn',$nisn)
        ->join('tabelkelas','datasiswa.kode_kelas',"=",'tabelkelas.kode_kelas')
        ->first();

        $presensi = DB::table('presensi')
        -> leftjoin('jam_sekolah','presensi.kode_jam_sekolah','=','jam_sekolah.kode_jam_sekolah')
        -> where('nisn',$nisn)
        -> whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        -> whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->orderBy('tgl_presensi','desc')
        ->get();
        if(isset($_POST['exportexcel'])){
            $time = date("d-M-Y H:i:s");
            //Fungsi header dengan mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            //Mendefiniskikan nama file ekspor "hasil-export.xls"
            header("Content-Disposition:attachment; filename=Laporan Absensi $time.xls");
            return view('presensi.cetaklaporanexcel', compact('bulan', 'tahun', 'namabulan','siswa','presensi'));
        }
        return view('presensi.cetaklaporan', compact('bulan', 'tahun', 'namabulan','siswa','presensi'));
    }

    public function rekap(){
        $namabulan =["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $kelas=DB::table('tabelkelas')->orderBy('kode_kelas')->get();
        return view('presensi.rekap', compact('namabulan','kelas'));
    }

    public function cetakrekap(Request $request)
    {
        $bulan = $request -> bulan;
        $tahun = $request -> tahun;
        $namabulan =["","Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $rekap = DB::table('presensi')
        ->selectRaw('presensi.nisn, nama_lengkap, jam_masuk, jam_pulang,
        MAX(IF(DAY(tgl_presensi)=1,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_1,
        MAX(IF(DAY(tgl_presensi)=2,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_2,
        MAX(IF(DAY(tgl_presensi)=3,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_3,
        MAX(IF(DAY(tgl_presensi)=4,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_4,
        MAX(IF(DAY(tgl_presensi)=5,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_5,
        MAX(IF(DAY(tgl_presensi)=6,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_6,
        MAX(IF(DAY(tgl_presensi)=7,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_7,
        MAX(IF(DAY(tgl_presensi)=8,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_8,
        MAX(IF(DAY(tgl_presensi)=9,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_9,
        MAX(IF(DAY(tgl_presensi)=10,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_10,
        MAX(IF(DAY(tgl_presensi)=11,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_11,
        MAX(IF(DAY(tgl_presensi)=12,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_12,
        MAX(IF(DAY(tgl_presensi)=13,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_13,
        MAX(IF(DAY(tgl_presensi)=14,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_14,
        MAX(IF(DAY(tgl_presensi)=15,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_15,
        MAX(IF(DAY(tgl_presensi)=16,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_16,
        MAX(IF(DAY(tgl_presensi)=17,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_17,
        MAX(IF(DAY(tgl_presensi)=18,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_18,
        MAX(IF(DAY(tgl_presensi)=19,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_19,
        MAX(IF(DAY(tgl_presensi)=20,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_20,
        MAX(IF(DAY(tgl_presensi)=21,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_21,
        MAX(IF(DAY(tgl_presensi)=22,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_22,
        MAX(IF(DAY(tgl_presensi)=23,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_23,
        MAX(IF(DAY(tgl_presensi)=24,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_24,
        MAX(IF(DAY(tgl_presensi)=25,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_25,
        MAX(IF(DAY(tgl_presensi)=26,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_26,
        MAX(IF(DAY(tgl_presensi)=27,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_27,
        MAX(IF(DAY(tgl_presensi)=28,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_28,
        MAX(IF(DAY(tgl_presensi)=29,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_29,
        MAX(IF(DAY(tgl_presensi)=30,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_30,
        MAX(IF(DAY(tgl_presensi)=31,CONCAT(jam_in,"-",IFNULL(jam_out,"00:00:00")),"")) as tgl_31
        ')
        ->join('datasiswa','presensi.nisn','=','datasiswa.nisn')
        -> leftjoin('jam_sekolah','presensi.kode_jam_sekolah','=','jam_sekolah.kode_jam_sekolah')
        ->whereRaw('MONTH(tgl_presensi)="'.$bulan.'"')
        ->whereRaw('YEAR(tgl_presensi)="'.$tahun.'"')
        ->groupByRaw('presensi.nisn,nama_lengkap,jam_masuk')
        -> get();
        if(isset($_POST['exportexcel'])){
            $time = date("d-M-Y H:i:s");
            //Fungsi header dengan mengirimkan raw data excel
            header("Content-type: application/vnd-ms-excel");
            //Mendefiniskikan nama file ekspor "hasil-export.xls"
            header("Content-Disposition:attachment; filename=Rekap Absensi $time.xls");
        }
        return view('presensi.cetakrekap',compact('namabulan','bulan','tahun','rekap'));
    }

    public function izinsakit(Request $request){
        $query = Pengajuanizin::query();
        $query ->select('id','tgl_izin','pengajuan_izin.nisn','nama_lengkap','kode_kelas','status_approved','keterangan');
        $query -> join('datasiswa','pengajuan_izin.nisn','=','datasiswa.nisn');

        if(!empty($request->dari) && !empty($request->sampai)){
            $query->whereBetween('tgl_izin',[$request -> dari, $request->sampai]);
        }
        if(!empty($request->nisn)){
            $query->where('pengajuan_izin.nisn',$request->nisn);
        }
        if(!empty($request->nama_lengkap)){
            $query->where('nama_lengkap','like','%'. $request->nama_lengkap.'%' );
        }
        if($request->status_approved === '0' || $request->status_approved === '1' || $request->status_approved === '2'){
            $query->where('status_approved',$request->status_approved);
        }


        $query -> orderBy('tgl_izin','desc');
        $izinsakit = $query->paginate(25);
        $izinsakit -> appends($request -> all());
        return view('presensi.izinsakit',compact('izinsakit'));
    }

    public function approveizinsakit(Request $request){
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request -> id_izinsakit_form;
        $update =DB::table('pengajuan_izin')->where('id',$id_izinsakit_form)->update([
            'status_approved' => $status_approved
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        }else{
            return Redirect::back()->with(['warning'=>'Data Gagal di Diupdate']);
    }
}

    public function batalkanizinsakit($id)
    {
        $update =DB::table('pengajuan_izin')->where('id',$id)->update([
            'status_approved' => 0
        ]);
        if($update){
            return Redirect::back()->with(['success' => 'Data Berhasil Diupdate']);
        }else{
            return Redirect::back()->with(['warning'=>'Data Gagal di Diupdate']);
    }
    }

    public function cekpengajuanizin(Request $request){
        $tgl_izin = $request -> tgl_izin;
        $nisn = Auth::guard('datasiswa')->user()->nisn;
        $cek = DB::table('pengajuan_izin')->where('nisn', $nisn)->where('tgl_izin',$tgl_izin)->count();
        return $cek;
    }

}
