<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    public function index(Request $request){
        $query = Siswa::query();
        $query -> select('datasiswa.*','nama_kelas');
        $query ->join('tabelkelas','datasiswa.kode_kelas', '=', 'tabelkelas.kode_kelas');
        $query -> orderBy('nama_lengkap');
        if(!empty($request -> nama_siswa)){
            $query -> where('nama_lengkap', 'like', '%'. $request ->nama_siswa.'%');
        }
        if(!empty($request -> kode_kelas)){
            $query -> where('datasiswa.kode_kelas', $request ->kode_kelas);
        }
        $siswa = $query -> paginate(25);

        $kelas=DB::table('tabelkelas')->get();
        $kegiatan =DB::table('kegiatan')->orderBy('kode_kegiatan')->get();
        return view('siswa.index', compact('siswa','kelas','kegiatan'));
    }

    public function store(Request $request){
        $nisn = $request-> nisn;
        $kode_kelas = $request-> kode_kelas;
        $jabatan = $request-> jabatan;
        $nama_lengkap = $request-> nama_lengkap;
        $no_hp = $request-> no_hp;
        $password = Hash::make('123456');
        $kode_kegiatan = $request -> kode_kegiatan;
        if($request ->hasFile('foto')){
            $foto = $nisn.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto=null;
        }

        try{
            $data = [
                'nisn' => $nisn,
                'kode_kelas' => $kode_kelas,
                'jabatan' => $jabatan,
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto,
                'password' => $password,
                'kode_kegiatan' => $kode_kegiatan
            ];
            $simpan = DB::table('datasiswa')->insert($data);

            if ($simpan){
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/datasiswa/";
                    $request -> file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e){
            if($e->getCode()==23000){
                $message="(Data dengan NISN ".$nisn." sudah ada!)";
            } else {
                $message = "Hubungi TIM IT";
            }
            return Redirect::back()->with(['warning'=>'Data Gagal Disimpan '.$message]);
        }
    }
    public function edit(Request $request)
    {
        $nisn = $request -> nisn;
        $kelas=DB::table('tabelkelas')->get();
        $siswa = DB::table('datasiswa')->where('nisn',$nisn)->first();
        $kegiatan =DB::table('kegiatan')->orderBy('kode_kegiatan')->get();
        return view('siswa.edit',compact('kelas','siswa','kegiatan'));
    }

    public function update($nisn, Request $request)
    {
        $nisn = $request-> nisn;
        $kode_kelas = $request-> kode_kelas;
        $kode_kegiatan = $request-> kode_kegiatan;
        $jabatan = $request-> jabatan;
        $nama_lengkap = $request-> nama_lengkap;
        $no_hp = $request-> no_hp;
        $password = Hash::make('12345');
        $old_foto = $request -> old_foto;
        if($request ->hasFile('foto')){
            $foto = $nisn.".".$request->file('foto')->getClientOriginalExtension();
        }else{
            $foto = $old_foto;
        }

        try{
            $data = [
                'kode_kelas' => $kode_kelas,
                'kode_kegiatan' => $kode_kegiatan,
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'foto' => $foto,
                'password' => $password
            ];
            $update = DB::table('datasiswa')->where('nisn', $nisn)->update($data);

            if ($update){
                if($request->hasFile('foto')){
                    $folderPath = "public/uploads/datasiswa/";
                    $folderPathOld = "public/uploads/datasiswa/".$old_foto;
                    Storage::delete($folderPathOld);
                    $request -> file('foto')->storeAs($folderPath, $foto);
                }
                return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
            }
        } catch (\Exception $e){
            return Redirect::back()->with(['warning'=>'Data Gagal Disimpan']);
        }
    }

    public  function delete($nisn){
        $delete = DB::table('datasiswa')->where('nisn',$nisn)->delete();
        if($delete){
            return Redirect::back()->with(['success'=>'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning'=>'Data Berhasil Dihapus']);
        }
    }
}
