<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaksi;

class Akun extends Model
{
    protected $table= 'akun';
    protected $fillable= [
        'nama', 'jenis'
    ];

    public function scopeLatestFirst($query){
        return $query->orderBy('id','DESC');
    }

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }
}
