<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_Dokumentasi extends Model
{
    use HasFactory;

    protected $table = 'tb_dokumentasi';
    public $timestamps = false;
    protected $fillable = ['judul', 'deskripsi', 'file_path', 'jenis', 'video_link'];
}
