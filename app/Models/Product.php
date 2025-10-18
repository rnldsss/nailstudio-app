<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    // Asumsi nama tabel Anda adalah 'product'
    protected $table = 'product'; 
    
    // Asumsi kunci utama Anda adalah 'id_product'
    protected $primaryKey = 'id_product'; 
    
    // Asumsi kolom timestamps tidak ada atau tidak digunakan
    public $timestamps = false; 
    
    // Tentukan kolom-kolom yang dapat diisi
    protected $fillable = [
        'namaproduct', 'category', 'price', 'status', 'image', 'stock'
    ];
}