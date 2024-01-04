<?php

namespace App\Http\Controllers;

use App\Models\Wali;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class WaliController extends Controller
{
    public function index(Request $request)
    {
        $nama_wali = $request -> nama_wali;
        $query = Wali::query();
        $query -> select('*');
        $query -> orderBy('kode_kelas');
        if(!empty($nama_wali)){
            $query->where('nama_wali','like','%'.$nama_wali.'%');
        }
        $wali = $query -> get();
        $wali = $query -> paginate(20);

        // $wali = DB::table('tabelkelas')->orderBy('kode_kelas')->get();
        return view('wali.index',compact('wali'));
    }

    public function store(Request $request){
        $kode_kelas = $request -> kode_kelas;
        $nama_wali = $request -> nama_wali;
        $data = [
            'kode_kelas' => $kode_kelas,
            'nama_wali' => $nama_wali,
            'nama_kelas' => $kode_kelas
        ];
        $cek = DB::table('tabelkelas')->where('kode_kelas',$kode_kelas)->count();
        if($cek > 0){
            return Redirect::back() ->with(['warning'=>'Data dengan Kelas '.$kode_kelas.' sudah ada!']);
        }
        $simpan = DB::table('tabelkelas')-> insert($data);
        if($simpan){
            return Redirect::back() ->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back() ->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public function edit(Request $request)
    {
        $kode_kelas = $request -> kode_kelas;
        $wali = DB::table('tabelkelas')->where('kode_kelas',$kode_kelas)->first();
        return view('wali.edit',compact('wali'));
    }

    public function update($kode_kelas, Request $request)
    {
        $nama_wali = $request -> nama_wali;
        $data =[
            'nama_wali' => $nama_wali,
        ];
        $update = DB::table('tabelkelas')->where('kode_kelas', $kode_kelas)->update($data);
        if($update){
            return Redirect::back() ->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back() ->with(['warning'=>'Data Gagal Disimpan']);
        }

    }

    public  function delete($kode_kelas){
        $delete = DB::table('tabelkelas')->where('kode_kelas',$kode_kelas)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data Berhasil Dihapus']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Berhasil Dihapus']);
        }
    }
}
