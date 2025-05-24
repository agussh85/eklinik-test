<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoginModel;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class LoginController extends Controller
{
    public function index() {

            return view('/login');

    }

    public function proses(Request $request) {
        $admin = new LoginModel();
        $username = $request->username;
        $password = $request->password;
        
        $passw=hash('sha512',$password);

        $cek=$admin->ceklogin($username,$passw);
        if(empty($cek)) {
            return redirect('/')->with('logingagal','Login Gagal! Silahkan periksa kembali Username dan Password anda '.$passw);
        } else {
            Session::put('username',$username);
            Session::put('jabatan',$cek->jabatan);
            return redirect('/dashboard');
        }
    }


    public function logout(){
        Session::flush();
        return redirect('/')->with('logingagal','Anda berhasil logout.');
    }



//end of class
}
