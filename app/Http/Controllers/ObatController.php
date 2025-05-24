<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\ObatModel;
use Validator;

class ObatController extends Controller
{    
    public function list() {
        if(!Session::get('username')){
            return redirect('/');
        } else {
            $judulhalaman = 'Daftar Obat ';
            $judulmodul = 'Daftar Obat ';

            
            $obat = new ObatModel();
            $dataobat=$obat->listobat();

            return view('obat/obat_list',compact('judulhalaman','judulmodul','dataobat'));
        }
    }

    
 
    public function edit($id){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Edit Obat';
            $judulmodul = 'Edit Obat';

            $data = new ObatModel();
            $query = $data->getobat($id);

            return view('obat/obat_edit',compact('judulmodul','judulhalaman','query'));
        }
    }

    public function add(){
        if(!Session::get('username')){
            redirect('/');
        } else {
            $judulhalaman = 'Tambah Obat';
            $judulmodul = 'Tambah Obat';
            
            return view('obat/obat_index',compact('judulmodul','judulhalaman'));
        }
    }

    public function update(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {

            $id = $request->id;
            $code = $request->kodeobat;
            $obat = $request->nama;
            $satuan = $request->satuan;
            $jumlah = $request->jumlah;
            $harga = $request->harga;
            $keterangan = $request->keterangan;
            
            if(!empty($obat)) {

                $data = new ObatModel();

                $hasil = $data->updateobat($id,$code,$obat,$satuan,$jumlah,$harga,$keterangan);

                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }
    public function save(Request $request) {
        if(!Session::get('username')){
            redirect('/');
        } else {


            $code = $request->kodeobat;
            $obat = $request->nama;
            $satuan = $request->satuan;
            $jumlah = $request->jumlah;
            $harga = $request->harga;
            $keterangan = $request->keterangan;

            if(!empty($obat)) {
                
                $data = new ObatModel();

                $hasil = $data->simpanobat($code,$obat,$satuan,$jumlah,$harga,$keterangan);
                      
                echo json_encode(array("status" => TRUE));
            } else { echo json_encode(array("status" => FALSE)); }
        }   
    }

    
	public function delete($id)
	{
        if(!Session::get('username')){
            redirect('/');
        } else {
            $data = new ObatModel();

            $hasil = $data->deleteobat($id);

            echo json_encode(array("status" => TRUE));
        }
	}

}
