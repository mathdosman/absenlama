<?php

namespace App\Http\Controllers;

use App\Models\Setjamsekolah;
use App\Models\Setjamkelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KonfigurasiController extends Controller
{
    public function lokasisekolah(){
        $lok_sekolah = DB::table('konfigurasi_lokasi')->where('id', 1)->first();
        return view('konfigurasi.lokasisekolah',compact('lok_sekolah'));
    }

    public function updatelokasi(Request $request){
        $lokasi_sekolah = $request -> lokasi_sekolah;
        $radius = $request -> radiusx;

        $update = DB::table('konfigurasi_lokasi')->where('id', 1)->update([
            'lokasi_sekolah' => $lokasi_sekolah,
            'radius' => $radius
        ]);
        if($update){
            return Redirect::back()->with(['success'=>'Data Berhasil Diupdate']);
        }else{
            return Redirect::back()->with(['warning'=>'Data Gagal Diupdate']);
        }
    }

    public  function jamsekolah(){
        $jam_sekolah = DB:: table('jam_sekolah')->orderBy('kode_jam_sekolah')->get();
        return view('konfigurasi.jamsekolah',compact('jam_sekolah'));
    }

    public  function storejamsekolah(Request $request){
        $kode_jam_sekolah = $request-> kode_jam_sekolah;
        $nama_jam_sekolah = $request-> nama_jam_sekolah;
        $awal_jam_masuk = $request-> awal_jam_masuk;
        $jam_masuk = $request-> jam_masuk;
        $akhir_jam_masuk = $request-> akhir_jam_masuk;
        $jam_pulang = $request-> jam_pulang;
        try{
            $data =[
                'kode_jam_sekolah' => $kode_jam_sekolah,
                'nama_jam_sekolah' => $nama_jam_sekolah,
                'awal_jam_masuk' => $awal_jam_masuk,
                'jam_masuk' => $jam_masuk,
                'akhir_jam_masuk' => $akhir_jam_masuk,
                'jam_pulang' => $jam_pulang
            ];
            DB::table('jam_sekolah')->insert($data);
            return Redirect ::back()->with(['success'=>'Data Berhasil Disimpan']);
        } catch (\Exception $e){
        return Redirect ::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public function editjamsekolah(Request $request){
        $kode_jam_sekolah = $request->kode_jam_sekolah;
        $kodejs=DB::table('jam_sekolah')->where('kode_jam_sekolah', $kode_jam_sekolah)->first();
        return view('konfigurasi.editjamsekolah', compact('kodejs'));
    }

    public function updatejs(Request $request){
        $kode_jam_sekolah = $request-> kode_jam_sekolah;
        $nama_jam_sekolah = $request-> nama_jam_sekolah;
        $awal_jam_masuk = $request-> awal_jam_masuk;
        $jam_masuk = $request-> jam_masuk;
        $akhir_jam_masuk = $request-> akhir_jam_masuk;
        $jam_pulang = $request-> jam_pulang;
        try{
            $data =[
                'nama_jam_sekolah' => $nama_jam_sekolah,
                'awal_jam_masuk' => $awal_jam_masuk,
                'jam_masuk' => $jam_masuk,
                'akhir_jam_masuk' => $akhir_jam_masuk,
                'jam_pulang' => $jam_pulang,
            ];
            DB::table('jam_sekolah')
            ->where('kode_jam_sekolah', $kode_jam_sekolah)
            ->update($data);
            return Redirect ::back()->with(['success'=>'Data Berhasil Disimpan']);
        } catch (\Exception $e){
        return Redirect ::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public function deletejamsekolah($kode_jam_sekolah){
        $hapus = DB::table('jam_sekolah')->where('kode_jam_sekolah',$kode_jam_sekolah)->delete();
        if($hapus){
            return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Dihapus']);
        }
    }

    public function setjamsekolah($nisn){
        $siswa =DB::table('datasiswa')->where('nisn',$nisn)->first();
        $jamsekolah = DB::table('jam_sekolah')->orderBy('nama_jam_sekolah')->get();
        $cekjamsekolah =DB::table('konfigurasi_jam')->where('nisn',$nisn)->count();
        if($cekjamsekolah > 0){
            $setjamsekolah=DB::table('konfigurasi_jam')->where('nisn', $nisn)->get();
            return view('konfigurasi.editsetjamsekolah',compact('siswa','jamsekolah','setjamsekolah'));
        }else{
            return view('konfigurasi.setjamsekolah',compact('siswa','jamsekolah'));
        }
    }

    public function storesetjamsekolah(Request $request){
        $nisn= $request -> nisn;
        $hari = $request -> hari;
        $kode_jam_sekolah = $request -> kode_jam_sekolah;

        for($i=0; $i<count($hari); $i++){
            $data[]=[
                'nisn' => $nisn,
                'hari' => $hari[$i],
                'kode_jam_sekolah' => $kode_jam_sekolah[$i]
            ];
        }
        try{
            Setjamsekolah::insert($data);
            return redirect('/siswa')->with(['success'=>'Jam Sekolah Berhasil Diseting !']);
        } catch(\Exception $e){
            return redirect('/siswa')->with(['warning'=>'Jam Sekolah Gagal Diseting !']);
        }
    }

    public function updatesetjamsekolah(Request $request){
        $nisn= $request -> nisn;
        $hari = $request -> hari;
        $kode_jam_sekolah = $request -> kode_jam_sekolah;

        for($i=0; $i<count($hari); $i++){
            $data[]=[
                'nisn' => $nisn,
                'hari' => $hari[$i],
                'kode_jam_sekolah' => $kode_jam_sekolah[$i]
            ];
        }
        DB::beginTransaction();
        try{
            DB::table('konfigurasi_jam')->where('nisn', $nisn)->delete();
            Setjamsekolah::insert($data);
            DB::commit();
            return redirect('/siswa')->with(['success'=>'Jam Sekolah Berhasil Diseting !']);
        } catch(\Exception $e){
            DB::rollBack();
            return redirect('/siswa')->with(['warning'=>'Jam Sekolah Gagal Diseting !']);
        }
    }

    public function jamkelas(){
        $jamkelas = DB::table('konfigurasi_jam_kelas')
        ->join('kegiatan','konfigurasi_jam_kelas.kode_kegiatan','=','kegiatan.kode_kegiatan')
        ->get();
        return view ('konfigurasi.jamkelas',compact('jamkelas'));
    }

    public function createjamkelas(){
        $jamsekolah = DB::table('jam_sekolah')->orderBy('nama_jam_sekolah')->get();
        $sesi =DB::table('kegiatan')->get();
        $kelas =DB::table('tabelkelas')->get();
        return view('konfigurasi.createjamkelas',compact('jamsekolah','sesi','kelas'));
    }


    public function storejamkelas(Request $request){
        $kode_kegiatan = $request ->kode_kegiatan;
        $kode_kelas = $request ->kode_kelas;
        $hari = $request -> hari;
        $kode_jam_sekolah = $request -> kode_jam_sekolah;
        $kode_js_kelas = "P".$kode_kegiatan.$kode_kelas;

        DB::beginTransaction();
        try{
            //menyimpan data ke tabel konfigurasi_jam_kelas
            DB::table('konfigurasi_jam_kelas')->insert([
                'kode_js_kelas'=> $kode_js_kelas,
                'kode_kegiatan' => $kode_kegiatan,
                'kode_kelas' => $kode_kelas
            ]);

            for($i=0; $i<count($hari); $i++){
                $data[]=[
                    'kode_js_kelas' => $kode_js_kelas,
                    'hari' => $hari[$i],
                    'kode_jam_sekolah' => $kode_jam_sekolah[$i]
                ];
            }
            Setjamkelas::insert($data);
            DB::commit();
            return redirect('/konfigurasi/jamkelas')->with(['success'=>'Data Berhasil Disimpan !']);
        }catch(\Exception $e){
            DB::rollBack();
            return redirect('/konfigurasi/jamkelas')->with(['warning'=>'Data Gagal Disimpan !']);
        }

    }
}
