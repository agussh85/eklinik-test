<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class LoginModel extends Model
{
    use HasFactory;
    protected $table = 'user_m';
    protected $primaryKey = 'id_user';

    public function ceklogin($username,$password) {
        $cek = DB::table('user_m')->where(['username'=>$username,'password'=>$password])->first();

        return $cek;
    }
}
