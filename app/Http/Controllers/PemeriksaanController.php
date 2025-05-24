<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\RegistrasiModel;
use App\Models\PenggunaModel;
use Validator;

class PemeriksaanController extends Controller
{    
    public function pemeriksaanPerawat($id){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Pemeriksaan Perawat';
            $judulmodul = 'Pemeriksaan Perawat';


            $data = new RegistrasiModel();
            $hasil = $data->getpemeriksaan($id);


            $dk=new PenggunaModel();
            $petugas=$dk->getperawat();

            return view('registrasi/pemeriksaan_perawat',compact('judulmodul','judulhalaman','hasil','petugas'));
        }
    }
    
    public function savePemeriksaanPerawat(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $norm = $request->norm;
            $noregistrasi = $request->noregistrasi;
            $beratbadan = $request->beratbadan;
            $tinggibadan = $request->tinggibadan;
            $tekanandarah = $request->tekanandarah;
            $petugas = $request->petugas;

            if(!empty($noregistrasi)) {
                $data = new RegistrasiModel();

                $hasil = $data->simpanpemeriksaanperawat($norm,$noregistrasi,$petugas,$beratbadan,$tinggibadan,$tekanandarah);
                      
                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }


    
    public function pemeriksaanDokter($id){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Pemeriksaan Dokter';
            $judulmodul = 'Pemeriksaan Dokter';

            
            $data = new RegistrasiModel();
            $hasil = $data->getpemeriksaan($id);


            $dk=new PenggunaModel();
            $dokter=$dk->getdokter();

            return view('registrasi/pemeriksaan_dokter',compact('judulmodul','judulhalaman','hasil','dokter'));
        }
    }

    public function savePemeriksaanDokter(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $norm = $request->norm;
            $noregistrasi = $request->noregistrasi;
            $dokter = $request->dokter;
            $keluhan = $request->keluhan;
            $diagnosa = $request->diagnosa;

            if(!empty($noregistrasi)) {
                $data = new RegistrasiModel();

                $hasil = $data->simpanpemeriksaandokter($norm,$noregistrasi,$dokter,$keluhan,$diagnosa);
                      
                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }

}
