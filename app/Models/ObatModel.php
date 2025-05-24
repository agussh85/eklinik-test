<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ObatModel extends Model
{
    use HasFactory;
    protected $table = 'obat_m';
    protected $primaryKey = 'id_obat';

    
    public function jumlahobat() {
        $total = DB::table('obat_m')->select(DB::raw('count(*) as jum'))->first();

        return $total->jum;
    }

    public function lastobat() {
        $data = DB::table('obat_m')->select('id_obat')->orderBy('id_obat','DESC')->first();
        $nilai= $data->id_obat;
        return $nilai;
    }


    
    public function listobat() {
        
        $obat = DB::table('obat_m')
        ->select(['obat_m.*'])
        ->orderBy('id_obat','DESC')
        ->get();

        return $obat;
    }

    
    public function simpanobat($kodeobat,$obat,$satuan,$jumlah,$harga,$keterangan) {
        
        $obat = DB::table('obat_m')->insert(
            array(
                   'code'     =>   $kodeobat, 
                   'nama_obat'     =>   $obat, 
                   'satuan'     =>   $satuan, 
                   'jumlah'      =>   $jumlah, 
                   'harga'      =>   $harga, 
                   'keterangan'   =>   $keterangan, 
                   'statusenabled'  => 1
            )
       );

        return $obat;
    }

    
    public function updateobat($id,$kodeobat,$obat,$satuan,$jumlah,$harga,$keterangan) {
        $data = [
                   'code'     =>   $kodeobat, 
                   'nama_obat'     =>   $obat, 
                   'satuan'     =>   $satuan, 
                   'jumlah'      =>   $jumlah, 
                   'harga'      =>   $harga, 
                   'keterangan'   =>   $keterangan, 
                   'statusenabled'  => 1
        ];

        $update = DB::table('obat_m')
            ->where('id_obat', $id)
            ->update($data);

        return $update;
    }


    public function deleteobat($id) {
        
        $update = DB::table('obat_m')
        ->where('id_obat',$id)
        ->delete();  
 
 
         return $update;
     }

    public function getobat($id) {
        
        $obat = DB::table('obat_m')
        ->where('id_obat',$id)->first();

        return $obat;
    }
}
