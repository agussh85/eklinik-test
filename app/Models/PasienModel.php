<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class PasienModel extends Model
{
    use HasFactory;
    protected $table = 'pasien_m';
    protected $primaryKey = 'id_pasien';

    
    public function jumlahpasien() {
        $total = DB::table('pasien_m')->select(DB::raw('count(*) as jum'))->first();

        return $total->jum;
    }

    public function lastpasien() {
        $data = DB::table('pasien_m')->select('id_pasien')->orderBy('id_pasien','DESC')->first();
        if(isset($data)) $nilai= $data->id_pasien;
        else $nilai = 0;
        return $nilai;
    }


    
    public function listpasien() {
        
        $pasien = DB::table('pasien_m as ps')
        ->select(['ps.*','rg.noregistrasi',
                    DB::raw("CASE 
                                WHEN ps.jenis_kelamin = 'L' THEN 'Laki-laki' 
                                WHEN ps.jenis_kelamin = 'P' THEN 'Perempuan' 
                                ELSE 'Tidak Diketahui' 
                            END AS namajeniskelamin")])
        ->leftJoin('registrasi_t as rg', function($join) {
            $join->on('rg.norm', '=', 'ps.id_pasien')
                ->whereRaw("LEFT(rg.noregistrasi, 4) = ?", [date('ym')]);
            })
        ->orderBy('ps.id_pasien','DESC')
        ->get();

        return $pasien;
    }

    
    public function simpanpasien($id,$nik,$pasien,$alamat,$telepon,$tanggallahir,$jeniskelamin,$tempatlahir,$foto) {
        
        $pasien = DB::table('pasien_m')->insert(
            array(
                    'id_pasien'     =>   $id, 
                   'nik'     =>   $nik, 
                   'nama_pasien'     =>   $pasien, 
                   'alamat'          =>   $alamat, 
                   'no_telepon'      =>   $telepon, 
                   'tanggal_lahir'   =>   $tanggallahir, 
                   'tempat_lahir'   =>   $tempatlahir, 
                   'foto'   =>   $foto, 
                   'jenis_kelamin'   =>   $jeniskelamin,
                   'statusenabled'  => 1
            )
       );

        return $pasien;
    }

    
    public function updatepasien($id,$nik,$pasien,$alamat,$telepon,$tanggallahir,$jeniskelamin,$tempatlahir,$foto) {
        $data = [
            'nik'            => $nik,
            'nama_pasien'    => $pasien,
            'alamat'         => $alamat,
            'no_telepon'     => $telepon,
            'tanggal_lahir'  => $tanggallahir,
            'tempat_lahir'   => $tempatlahir,
            'jenis_kelamin'  => $jeniskelamin
        ];

        // Jika ada foto baru, tambahkan ke array update
        if (!empty($foto)) {
            $data['foto'] = $foto;
        }

        $update = DB::table('pasien_m')
            ->where('id_pasien', $id)
            ->update($data);

        return $update;
    }


    public function deletepasien($id) {
        
        $update = DB::table('pasien_m')
        ->where('id_pasien',$id)
        ->delete();  
 
 
         return $update;
     }

    public function getpasien($id) {
        
        $pasien = DB::table('pasien_m')
        ->where('id_pasien',$id)->get();

        return $pasien;
    }
}
