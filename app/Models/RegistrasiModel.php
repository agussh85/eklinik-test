<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RegistrasiModel extends Model
{
    use HasFactory;
    protected $table = 'registrasi_t';
    protected $primaryKey = 'id_registrasi';

    
    public function jumlahregistrasi() {
        $total = DB::table('registrasi_t')
            ->select(DB::raw('count(*) as jum'))
            ->whereDate('tanggal_registrasi', date('Y-m-d'))
            ->first();

        return $total->jum;
    }

    
    public function lastpasien() {
        $bulanTahun = date('ym'); // Contoh: 202509

        $data = DB::table('registrasi_t')
            ->select('noregistrasi')
            ->whereRaw('LEFT(noregistrasi, 4) = ?', [$bulanTahun])
            ->orderBy('noregistrasi', 'DESC')
            ->first();

        if(isset($data)) $nilai= substr($data->noregistrasi,4,6);
        else $nilai = 0;
        return $nilai;
    }



    public function listregistrasi($tgl) {
        
        $registrasi = DB::table('registrasi_t as rg')
        ->select(['rg.*','ps.nama_pasien','us.nama as namapegawai',
                'pp.tanggal_pemeriksaan as tgl_pemeriksaan_perawat','pp.beratbadan','pp.tinggibadan','pp.tekanandarah','pp.namaperawat',
                'pd.tanggal_pemeriksaan as tgl_pemeriksaan_dokter','pd.keluhan','pd.diagnosa','pd.namadokter'])
        ->leftjoin('pasien_m as ps','ps.id_pasien','=','rg.norm')
        ->leftjoin('user_m as us','us.id_user','=','rg.pegawaifk')
        ->leftjoin('pemeriksaan_perawat_t as pp','pp.noregistrasi','=','rg.noregistrasi')
        ->leftjoin('pemeriksaan_dokter_t as pd','pd.noregistrasi','=','rg.noregistrasi')
        ->whereDate('rg.tanggal_registrasi', $tgl)
        ->orderBy('rg.noregistrasi','ASC')
        ->get();

        return $registrasi;
    }

    
    public function simpanregistrasi($norm,$noregistrasi,$dokter) {
        
        $uuid = Str::uuid();
        $registrasi = DB::table('registrasi_t')->insert(
            array(
                   'norec'     =>   $uuid, 
                   'noregistrasi'     =>   $noregistrasi, 
                   'tanggal_registrasi'   =>   date('Y-m-d H:i:s'),
                   'pegawaifk'  => $dokter,
                   'norm'  => $norm,
                   'statusenabled'  => 1
            )
       );

        return $registrasi;
    }

    
    public function updateregistrasi($id,$registrasi,$kecamatan,$kota) {
        
       $update = DB::table('registrasi_t')
       ->where('id_registrasi',$id)
       ->update(['nama_registrasi'     =>   $registrasi, 
                'nama_kecamatan'     =>   $kecamatan, 
                'nama_kota'   =>   $kota
        ]);  


        return $update;
    }


    public function deleteregistrasi($id) {
        
        $update = DB::table('registrasi_t')
        ->where('id_registrasi',$id)
        ->delete();  
 
 
         return $update;
     }

    public function getregistrasi($id) {
        
        $registrasi = DB::table('pasien_m')->where('id_pasien',$id)->get();

        return $registrasi;
    }

    
    public function getpemeriksaan($id) {
        
        $registrasi = DB::table('registrasi_t as rg')
            ->select(['rg.*','ps.nama_pasien'])
            ->leftjoin('pasien_m as ps','ps.id_pasien','=','rg.norm')
            ->where('noregistrasi',$id)->get();

        return $registrasi;
    }

    
    public function simpanpemeriksaanperawat($norm,$noregistrasi,$petugas,$beratbadan,$tinggibadan,$tekanandarah) {
        
        $pg = DB::table('user_m')->select('nama')->where('id_user',$petugas)->first();

        $uuid = Str::uuid();
        $registrasi = DB::table('pemeriksaan_perawat_t')->insert(
            array(
                   'norec'     =>   $uuid, 
                   'noregistrasi'     =>   $noregistrasi, 
                   'tanggal_pemeriksaan'   =>   date('Y-m-d H:i:s'),
                   'pegawaifk'  => $petugas,
                   'namaperawat' => $pg->nama,
                   'norm'  => $norm,
                   'beratbadan'  => $beratbadan,
                   'tinggibadan'  => $tinggibadan,
                   'tekanandarah'  => $tekanandarah
            )
       );

        return $registrasi;
    }
    
    public function simpanpemeriksaandokter($norm,$noregistrasi,$dokter,$keluhan,$diagnosa) {
        
        $pg = DB::table('user_m')->select('nama')->where('id_user',$dokter)->first();

        $uuid = Str::uuid();
        $registrasi = DB::table('pemeriksaan_dokter_t')->insert(
            array(
                   'norec'     =>   $uuid, 
                   'noregistrasi'     =>   $noregistrasi, 
                   'tanggal_pemeriksaan'   =>   date('Y-m-d H:i:s'),
                   'pegawaifk'  => $dokter,
                   'namadokter' => $pg->nama,
                   'norm'  => $norm,
                   'keluhan'  => $keluhan,
                   'diagnosa'  => $diagnosa
            )
       );

        return $registrasi;
    }
}
