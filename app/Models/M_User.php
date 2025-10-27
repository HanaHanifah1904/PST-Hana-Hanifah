<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class M_User extends Authenticatable
{
    use Notifiable;

    protected $table = 'tb_user'; // sesuaikan dengan nama tabel sebenarnya
    protected $primaryKey = 'id'; // atau sesuai primary key di tabel
    protected $fillable = ['nama','username','email','password'];

    protected $hidden = ['password','remember_token'];
}
