<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public  function proseslogin(Request $request)
    {
        // $pass = 123;
        // echo Hash::make($pass);
        if(Auth::guard('datasiswa')->attempt(['nisn'=> $request -> nisn, 'password'=> $request -> password]))
        {
            return redirect('/dashboard');
        } else {
            return redirect('/') -> with(['warning'=>'NISN atau Password Salah']);
        }
    }

    public function proseslog_out()
    {
        if(Auth::guard('datasiswa')->check()){
            Auth::guard('datasiswa')->logout();
            return redirect('/');
        }
        
    }

    public function proseslog_outadmin(){
        if(Auth::guard('user')->check()){
            Auth::guard('user')->logout();
            return redirect('/panel');
        }
    }

    public  function prosesloginadmin(Request $request)
    {
        if(Auth::guard('user')->attempt(['email'=> $request -> email, 'password'=> $request -> password]))
        {
            return redirect('/panel/dashboardadmin');
        } else {
            return redirect('/panel') -> with(['warning'=>'Username atau Password Salah']);
        }
    }
}
