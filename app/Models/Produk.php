<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $table = 'produk';



public function kategori()
{
    return $this->belongsTo(kategori::class, 'kategori_id');
}

public function gambar(){
    return $this->hasMany(gambar::class);
}

}
