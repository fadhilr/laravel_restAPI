<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaksi;
use App\Subkategori;

class Kategori extends Model
{
    protected $table= 'kategori';
    protected $fillable= [
        'nama'
    ];

    public function scopeLatestFirst($query){
        return $query->orderBy('id','DESC');
    }

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }
    public function subkategori(){
        return $this->hasMany(Subkategori::class);
    }
}
