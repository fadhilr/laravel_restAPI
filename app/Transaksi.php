<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Akun;
use App\Kategori;
use App\Subkategori;
use App\Tag;

class Transaksi extends Model
{
    protected $table= 'transaksi';
    protected $fillable= [
        'user_id', 'akun_id','kategori_id','subkategori_id','tag_id','tanggal','nominal','keterangan' 
    ];

    public function scopeLatestFirst($query){
        return $query->orderBy('id','DESC');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function akun(){
        return $this->belongsTo(Akun::class);
    }
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
    public function subkategori(){
        return $this->belongsTo(Subkategori::class);
    }
    public function tag(){
        return $this->belongsTo(Tag::class);
    }
}
