<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gambar extends Model
{
    use HasFactory;
    protected $table = 'gambar';
    protected $fillable=[
        'gambar',
        'produk_id',
    ];

    public function data(){
        return $this->belongsTo(Produk::class);
    }
}
