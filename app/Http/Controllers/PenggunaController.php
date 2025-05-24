<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PenggunaModel;
use Validator;

class PenggunaController extends Controller
{    
    public function list() {
        if(!Session::get('username')){
            return redirect('/');
        } else {
            $judulhalaman = 'Daftar Pengguna ';
            $judulmodul = 'Daftar Pengguna ';

            
            $pengguna = new PenggunaModel();
            $datapengguna=$pengguna->listpengguna();

            //if( Session::get('username')=='admin') 
            return view('pengguna/pengguna_list',compact('judulhalaman','judulmodul','datapengguna'));
        }
    }
 
    public function edit($id){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Edit Pengguna';
            $judulmodul = 'Edit Pengguna';

            $data = new PenggunaModel();
            $query = $data->getpengguna($id);

            
            $jabatan = [
                'dokter' => 'DOKTER',
                'perawat' => 'PERAWAT',
                'apoteker' => 'APOTEKER',
                'pendaftaran' => 'PENDAFTARAN',
            ];


            if( Session::get('username')=='admin') return view('pengguna/pengguna_edit',compact('judulmodul','judulhalaman','query','jabatan'));
        }
    }

    public function add(){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Tambah Pengguna';
            $judulmodul = 'Tambah Pengguna';

            $jabatan = [
                'dokter' => 'DOKTER',
                'perawat' => 'PERAWAT',
                'apoteker' => 'APOTEKER',
                'pendaftaran' => 'PENDAFTARAN',
            ];

            if( Session::get('username')=='admin') return view('pengguna/pengguna_index',compact('judulmodul','judulhalaman','jabatan'));
        }
    }

    public function update(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $id = $request->id;
            $nik = $request->nik;
            $nama = $request->nama;
            $jabatan = $request->jabatan;

            $password='';
            if(!empty($request->password)) {
                $passw = $request->password;
                $password=hash('sha512',$passw);
            }          
            
            if(!empty($nama)) {

                $data = new penggunaModel();

                $hasil = $data->updatepengguna($id,$nik,$nama,$jabatan,$password);

                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }

    public function save(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $nik = $request->nik;
            $nama = $request->nama;
            $jabatan = $request->jabatan;
            $username = $request->username;
            $passw = $request->password;

            $password=hash('sha512',$passw);

            $cek= new PenggunaModel();
            $cari=$cek->searchpengguna($username);

            if(!$cari) {
                if(!empty($nama)) {
                    $data = new PenggunaModel();

                    $hasil = $data->simpanpengguna($username,$password,$nama,$nik,$jabatan);
                        
                    echo json_encode(array("status" => TRUE));
                } else { echo json_encode(array("status" => 2)); }
            }  else { echo json_encode(array("status" => 3)); }
        }   
    }

    
	public function delete($id)
	{
        if(!Session::get('username')){
            redirect('/');
        } else {
            $data = new penggunaModel();

            $hasil = $data->deletepengguna($id);

            echo json_encode(array("status" => TRUE));
        }
	}

}
