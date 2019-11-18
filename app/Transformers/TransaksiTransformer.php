<?php

namespace App\Transformers;

use App\Transaksi;
use App\Transformers\UserTransformer;
use App\Transformers\AkunTransformer;
use App\Transformers\KategoriTransformer;
use App\Transformers\SubkategoriTransformer;
use App\Transformers\TagTransformer;
use League\Fractal\TransformerAbstract;

class TransaksiTransformer extends TransformerAbstract{
    protected $availableIncludes=[
        'user',
        'akun',
        'kategori',
        'subkategori',
        'tag'
    ];
    public function transform(Transaksi $transaksi){
        
        return[
            'id'                 => $transaksi->id,
            'akun_id'            => $transaksi->akun_id,
            'kategori_id'        => $transaksi->kategori_id,
            'subkategori_id'     => $transaksi->subkategori_id,
            'tag_id'             => $transaksi->tag_id,
            'user_id'            => $transaksi->user_id,
            'tanggal'            => $transaksi->tanggal,
            'nominal'            => $transaksi->nominal,
            'keterangan'         => $transaksi->keterangan,
            'published'          => $transaksi->created_at->diffForHumans(),
        ];
    }
    public function includeUser(Transaksi $transaksi){
        $user= $transaksi->user()->latestFirst()->paginate(5);

        return $this->collection($user, new UserTransformer);
    }
    public function includeAkun(Transaksi $transaksi){
        $akun= $transaksi->akun()->latestFirst()->paginate(5);

        return $this->collection($akun, new AkunTransformer);
    }
    public function includeKategori(Transaksi $transaksi){
        $kategori= $transaksi->kategori()->latestFirst()->paginate(5);

        return $this->collection($kategori, new KategoriTransformer);
    }
    public function includeSubkategori(Transaksi $transaksi){
        $subkategori= $transaksi->subkategori()->latestFirst()->paginate(5);

        return $this->collection($subkategori, new SubkategoriTransformer);
    }
    public function includeTag(Transaksi $transaksi){
        $tag= $transaksi->tag()->latestFirst()->paginate(5);

        return $this->collection($tag, new TagTransformer);
    }

}