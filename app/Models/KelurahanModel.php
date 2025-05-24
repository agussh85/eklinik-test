<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class KelurahanModel extends Model
{
    use HasFactory;
    protected $table = 'kelurahan_m';
    protected $primaryKey = 'id_kelurahan';

    
    public function jumlahkelurahan() {
        $total = DB::table('kelurahan_m')->select(DB::raw('count(*) as jum'))->first();

        return $total->jum;
    }

    public function listkelurahan() {
        
        $kelurahan = DB::table('kelurahan_m')
        ->select(['kelurahan_m.*'])
        ->orderBy('nama_kelurahan','ASC')
        ->get();

        return $kelurahan;
    }

    
    public function simpankelurahan($kelurahan,$kecamatan,$kota) {
        
        $kelurahan = DB::table('elurahan_m')->insert(
            array(
                   'nama_kelurahan'     =>   $kelurahan, 
                   'nama_kecamatan'     =>   $kecamatan, 
                   'nama_kota'   =>   $kota
            )
       );

        return $kelurahan;
    }

    
    public function updatekelurahan($id,$kelurahan,$kecamatan,$kota) {
        
       $update = DB::table('kelurahan_m')
       ->where('id_kelurahan',$id)
       ->update(['nama_kelurahan'     =>   $kelurahan, 
                'nama_kecamatan'     =>   $kecamatan, 
                'nama_kota'   =>   $kota
        ]);  


        return $update;
    }


    public function deletekelurahan($id) {
        
        $update = DB::table('kelurahan_m')
        ->where('id_kelurahan',$id)
        ->delete();  
 
 
         return $update;
     }

    public function getkelurahan($id) {
        
        $kelurahan = DB::table('kelurahan_m')->where('id_kelurahan',$id)->get();

        return $kelurahan;
    }
}
