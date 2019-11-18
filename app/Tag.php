<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Transaksi;

class Tag extends Model
{
    public $timestamps = false;
    protected $table= 'tag';
    protected $fillable= [
        'nama', 'tag_id'
    ];

    public function scopeLatestFirst($query){
        return $query->orderBy('id','DESC');
    }

    public function transaksi(){
        return $this->hasMany(Transaksi::class);
    }
}
