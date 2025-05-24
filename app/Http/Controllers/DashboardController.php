<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\RegistrasiModel;
use App\Models\PasienModel;
use Validator;

class DashboardController extends Controller
{
    public function index() {
        if(!Session::get('username')){
            return redirect('/');
        } else {
            $judulhalaman = 'Dashboard ';
            $judulmodul = 'Dashboard ';

            
            $registrasi = new RegistrasiModel();
            $totalregistrasi=$registrasi->jumlahregistrasi();

            $pasien = new PasienModel();
            $totalpasien=$pasien->jumlahpasien();

            return view('dashboard/home',compact('judulhalaman','judulmodul','totalpasien','totalregistrasi'));
        }
    }
    

}
