<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\PasienModel;
use App\Models\KelurahanModel;
use Validator;

class PasienController extends Controller
{    
    public function list() {
        if(!Session::get('username')){
            return redirect('/');
        } else {
            $judulhalaman = 'Daftar Pasien ';
            $judulmodul = 'Daftar Pasien ';

            
            $pasien = new PasienModel();
            $datapasien=$pasien->listpasien();

            return view('pasien/pasien_list',compact('judulhalaman','judulmodul','datapasien'));
        }
    }

    
    public function cetakkartu($id) {
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kartu Pasien';
            $judulmodul = 'Kartu Pasien';
            
            $data = new PasienModel();
            $hasil = $data->getpasien($id);

            return view('pasien/pasien_kartu',compact('judulmodul','judulhalaman','hasil'));
        }
    }

 
    public function edit($id){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Pasien';
            $judulmodul = 'Pasien';

            $data = new PasienModel();
            $hasil = $data->getpasien($id);

            return view('pasien/pasien_edit',compact('judulmodul','judulhalaman','hasil'));
        }
    }

    public function add(){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Pendaftaran Pasien Baru';
            $judulmodul = 'Pendaftaran Pasien Baru';
            

            $pasien = new PasienModel();
            $datapasien=$pasien->lastpasien()+1;
            if($datapasien < 10) $datapasien="00000".$datapasien;
            else if($datapasien < 100) $datapasien="0000".$datapasien;
            else if($datapasien < 1000) $datapasien="000".$datapasien;
            else if($datapasien < 10000) $datapasien="00".$datapasien;
            else if($datapasien < 100000) $datapasien="0".$datapasien;
            else if($datapasien < 1000000) $datapasien=$datapasien;

            $nourut=$datapasien;

            return view('pasien/pasien_index',compact('judulmodul','judulhalaman','nourut'));
        }
    }

    public function update(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $id = $request->id;
            $nik = $request->nik;
            $pasien = $request->nama;
            $alamat = $request->alamat;
            $telepon = $request->telepon;
            $tanggallahir = $request->tanggallahir;
            $tempatlahir = $request->tempatlahir;
            $jeniskelamin = $request->jeniskelamin;
            
            if(!empty($pasien)) {

                // Upload foto
                if ($request->hasFile('foto')) {
                    
                    if (!empty($request->fotolama)) {
                        $pathLama = public_path('uploads/foto/' . $request->fotolama);
                        if (file_exists($pathLama)) {
                            unlink($pathLama); // Hapus file lama
                        }
                    }

                    $namaFileFoto = null;
                    $file = $request->file('foto');
                    $namaFileFoto = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/foto'), $namaFileFoto);
                }
                $data = new PasienModel();

                $hasil = $data->updatepasien($id,$nik,$pasien,$alamat,$telepon,$tanggallahir,$jeniskelamin,$tempatlahir,$namaFileFoto);

                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }
    public function save(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $id = $request->id;
            $nik = $request->nik;
            $pasien = $request->nama;
            $alamat = $request->alamat;
            $telepon = $request->telepon;
            $tanggallahir = $request->tanggallahir;
            $tempatlahir = $request->tempatlahir;
            $jeniskelamin = $request->jeniskelamin;

            if(!empty($pasien)) {
                
                // Upload foto
                $namaFileFoto = null;
                if ($request->hasFile('foto')) {
                    $file = $request->file('foto');
                    $namaFileFoto = time() . '_' . $file->getClientOriginalName();
                    $file->move(public_path('uploads/foto'), $namaFileFoto);
                }

                $data = new PasienModel();

                $hasil = $data->simpanpasien($id,$nik,$pasien,$alamat,$telepon,$tanggallahir,$jeniskelamin,$tempatlahir,$namaFileFoto);
                      
                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }

    
	public function delete($id)
	{
        if(!Session::get('username')){
            redirect('/');
        } else {
            $data = new PasienModel();

            $hasil = $data->deletepasien($id);

            echo json_encode(array("status" => TRUE));
        }
	}

}
