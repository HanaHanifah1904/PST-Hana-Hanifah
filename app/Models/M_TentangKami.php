<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class M_TentangKami extends Model
{
    use HasFactory;

    protected $table = 'tb_tentangkami';
    protected $primaryKey = 'id';
    protected $fillable = ['judul', 'deskripsi', 'foto'];
}
