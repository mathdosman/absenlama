<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class KegiatanController extends Controller
{
    public function index(){
        $kegiatan = DB::table('kegiatan')->orderBy('kode_kegiatan')->get();
        return view('kegiatan.index',compact('kegiatan'));
    }

    public function store(Request $request){
        $kode_kegiatan = $request->kode_kegiatan;
        $nama_kegiatan = $request->nama_kegiatan;
        $lokasi_kegiatan = $request->lokasi_kegiatan;
        $radius_kegiatan = $request->radius_kegiatan;
        try{
            $data =[
                'kode_kegiatan' => $kode_kegiatan,
                'nama_kegiatan' => $nama_kegiatan,
                'lokasi_kegiatan' => $lokasi_kegiatan,
                'radius_kegiatan' => $radius_kegiatan,
            ];
            DB::table('kegiatan')->insert($data);
            return Redirect ::back()->with(['success'=>'Data Berhasil Disimpan']);
        } catch (\Exception $e){
        return Redirect ::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public function edit(Request $request){
        $kode_kegiatan = $request->kode_kegiatan;
        $kegiatan=DB::table('kegiatan')->where('kode_kegiatan', $kode_kegiatan)->first();
        return view('kegiatan.edit', compact('kegiatan'));
    }

    public function update(Request $request){
        $kode_kegiatan = $request->kode_kegiatan;
        $nama_kegiatan = $request->nama_kegiatan;
        $lokasi_kegiatan = $request->lokasi_kegiatan;
        $radius_kegiatan = $request->radius_kegiatan;
        try{
            $data =[
                'nama_kegiatan' => $nama_kegiatan,
                'lokasi_kegiatan' => $lokasi_kegiatan,
                'radius_kegiatan' => $radius_kegiatan,
            ];
            DB::table('kegiatan')
            ->where('kode_kegiatan', $kode_kegiatan)
            ->update($data);
            return Redirect ::back()->with(['success'=>'Data Berhasil Disimpan']);
        } catch (\Exception $e){
        return Redirect ::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public function delete($kode_kegiatan){
        $delete = DB::table('kegiatan')->where('kode_kegiatan',$kode_kegiatan)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Gagal Dihapus']);
        }
    }
}
