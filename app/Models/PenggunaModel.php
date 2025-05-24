<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PenggunaModel extends Model
{
    use HasFactory;
    protected $table = 'user_m';
    protected $primaryKey = 'id_user';

    
    public function jumlahpengguna() {
        $total = DB::table('user_m')->select(DB::raw('count(*) as jum'))->first();

        return $total->jum;
    }

    public function listpengguna() {
        
        $user = DB::table('user_m')
        ->select(['user_m.*'])
        ->where('jabatan','!=','admin')
        ->orderBy('id_user','ASC')
        ->get();

        return $user;
    }

    
    public function simpanpengguna($user,$passw,$nama,$nik,$jabatan) {
        
        $user = DB::table('user_m')->insert(
            array(
                   'username'     =>   $user, 
                   'password' =>   $passw, 
                   'nama'   =>   $nama, 
                   'nik'   =>   $nik, 
                   'jabatan'   =>   $jabatan,
                   'statusenabled' => 1
            )
       );

        return $user;
    }

    public function updatepengguna($id, $nik, $nama, $jabatan, $passw) {
        $data = [
            'nama' => $nama,
            'nik' => $nik,
            'jabatan' => $jabatan,
            'statusenabled' => 1
        ];

        // Hanya update password jika tidak kosong
        if (!empty($passw)) {
            $data['password'] = $passw;
        }

        $update = DB::table('user_m')
            ->where('id_user', $id)
            ->update($data);

        return $update;
    }


    public function deletepengguna($id) {
        
        $update = DB::table('user_m')
        ->where('id_user',$id)
        ->delete();  
 
 
         return $update;
     }

    public function getpengguna($id) {
        
        $user = DB::table('user_m')->where('id_user',$id)->first();

        return $user;
    }

    public function searchpengguna($id) {
        
        $user = DB::table('user_m')->where('username',$id)->first();

        return $user;
    }

    
    public function getdokter() {
        
        $user = DB::table('user_m')->select('id_user','nama')->where('jabatan','dokter')->get();

        return $user;
    }
    
    public function getperawat() {
        
        $user = DB::table('user_m')->select('id_user','nama')->where('jabatan','perawat')->get();

        return $user;
    }
}
