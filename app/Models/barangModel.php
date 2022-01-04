<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barangModel extends Model
{
    protected $table = 'barang';
    protected $primaryKey = 'id_barang';
    protected $fillable = [
        'nama_barang','tgl_barang','harga','deskripsi'
    ];
}
