<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\RegistrasiModel;
use App\Models\PenggunaModel;
use Validator;

class RegistrasiController extends Controller
{    
    public function list($id=null) {
        if(!Session::get('username')){
            return redirect('/');
        } else {
            $judulhalaman = 'Daftar Registrasi ';
            $judulmodul = 'Daftar Registrasi ';

            if(isset($id)) $tgl=$id;
            else $tgl=date('Y-m-d');
            
            $registrasi = new RegistrasiModel();
            $dataregistrasi=$registrasi->listregistrasi($tgl);


            //if( Session::get('username')=='admin') 
            return view('registrasi/registrasi_list',compact('judulhalaman','judulmodul','dataregistrasi','tgl'));
        }
    }
 
    public function edit($id){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Registrasi';
            $judulmodul = 'Registrasi';

            
            $registrasi = new RegistrasiModel();
            $dataregistrasi=$registrasi->lastpasien()+1;
            if($dataregistrasi < 10) $dataregistrasi="00000".$dataregistrasi;
            else if($dataregistrasi < 100) $dataregistrasi="0000".$dataregistrasi;
            else if($dataregistrasi < 1000) $dataregistrasi="000".$dataregistrasi;
            else if($dataregistrasi < 10000) $dataregistrasi="00".$dataregistrasi;
            else if($dataregistrasi < 100000) $dataregistrasi="0".$dataregistrasi;
            else if($dataregistrasi < 1000000) $dataregistrasi=$dataregistrasi;

            $nourut=date('ym').$dataregistrasi;

            $data = new RegistrasiModel();
            $hasil = $data->getregistrasi($id);


            $dk=new PenggunaModel();
            $dokter=$dk->getdokter();

            return view('registrasi/registrasi_edit',compact('judulmodul','judulhalaman','hasil','nourut','dokter'));
        }
    }

    public function add(){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Tambah Registrasi';
            $judulmodul = 'Tambah Registrasi';
            if( Session::get('username')=='admin') return view('registrasi/registrasi_index',compact('judulmodul','judulhalaman'));
        }
    }

    public function update(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $id = $request->id;
            $registrasi = $request->registrasi;
            $kecamatan = $request->kecamatan;
            $kota = $request->kota;
            
            if(!empty($registrasi)) {

                $data = new RegistrasiModel();

                $hasil = $data->updateregistrasi($id,$registrasi,$kecamatan,$kota);

                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }
    public function save(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $norm = $request->norm;
            $noregistrasi = $request->noregistrasi;
            $dokter = $request->dokter;

            if(!empty($noregistrasi)) {
                $data = new RegistrasiModel();

                $hasil = $data->simpanregistrasi($norm,$noregistrasi,$dokter);
                      
                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }

    
	public function delete($id)
	{
        if(!Session::get('username')){
            redirect('/');
        } else {
            $data = new RegistrasiModel();

            $hasil = $data->deleteregistrasi($id);

            echo json_encode(array("status" => TRUE));
        }
	}

}
