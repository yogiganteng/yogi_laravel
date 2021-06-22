<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tbl_produk extends Model
{
  //  use HasFactory;
    protected $table = "tbl_produk";
    // public $timestamps = false;
    protected $fillable = [
        'nama_produk', 'harga', 'image'
    ];
 
    
    public $timestamps = false;
}

