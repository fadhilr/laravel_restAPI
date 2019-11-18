<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kategori;

class Subkategori extends Model
{
    protected $table= 'subkategori';
    protected $fillable= [
        'nama',
        'kategori_id'
    ];

    public function scopeLatestFirst($query){
        return $query->orderBy('id','DESC');
    }
    public function kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
