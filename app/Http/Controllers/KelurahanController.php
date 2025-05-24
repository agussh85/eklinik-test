<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\KelurahanModel;
use Validator;

class KelurahanController extends Controller
{    
    public function list() {
        if(!Session::get('username')){
            return redirect('/');
        } else {
            $judulhalaman = 'Daftar Kelurahan ';
            $judulmodul = 'Daftar Kelurahan ';

            
            $kelurahan = new KelurahanModel();
            $datakelurahan=$kelurahan->listkelurahan();

            if( Session::get('username')=='admin') return view('kelurahan/kelurahan_list',compact('judulhalaman','judulmodul','datakelurahan'));
        }
    }
 
    public function edit($id){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Kelurahan';
            $judulmodul = 'Kelurahan';

            $data = new KelurahanModel();
            $hasil = $data->getkelurahan($id);

            if( Session::get('username')=='admin') return view('kelurahan/kelurahan_edit',compact('judulmodul','judulhalaman','hasil'));
        }
    }

    public function add(){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Tambah Kelurahan';
            $judulmodul = 'Tambah Kelurahan';
            if( Session::get('username')=='admin') return view('kelurahan/kelurahan_index',compact('judulmodul','judulhalaman'));
        }
    }

    public function update(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $id = $request->id;
            $kelurahan = $request->kelurahan;
            $kecamatan = $request->kecamatan;
            $kota = $request->kota;
            
            if(!empty($kelurahan)) {

                $data = new KelurahanModel();

                $hasil = $data->updatekelurahan($id,$kelurahan,$kecamatan,$kota);

                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }
    public function save(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $kelurahan = $request->kelurahan;
            $kecamatan = $request->kecamatan;
            $kota = $request->kota;

            if(!empty($kelurahan)) {
                $data = new KelurahanModel();

                $hasil = $data->simpankelurahan($kelurahan,$kecamatan,$kota);
                      
                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }

    
	public function delete($id)
	{
        if(!Session::get('username')){
            redirect('/');
        } else {
            $data = new KelurahanModel();

            $hasil = $data->deletekelurahan($id);

            echo json_encode(array("status" => TRUE));
        }
	}

}
