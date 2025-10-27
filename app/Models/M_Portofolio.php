<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class M_Portofolio extends Model
{
    protected $table = 'tb_portofolio';
    protected $fillable = ['judul', 'deskripsi', 'foto_path'];
    public $timestamps = false;
}
