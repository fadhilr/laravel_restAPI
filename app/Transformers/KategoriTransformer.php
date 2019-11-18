<?php

namespace App\Transformers;

use App\Kategori;
use App\Transformers\TransaksiTransformer;
use League\Fractal\TransformerAbstract;

class KategoriTransformer extends TransformerAbstract{
    protected $availableIncludes=[
        'transaksi',
        'subkategori'
    ];
    public function transform(Kategori $kategori){
        
        return[
            'id'                      => $kategori->id,
            'nama'                    => $kategori->nama,
            'published'               => $kategori->created_at->diffForHumans(),
        ];
    }
    public function includeTransaksi(Kategori $kategori){
        $transaksi= $kategori->transaksi()->latestFirst()->paginate(5);

        return $this->collection($transaksi, new TransaksiTransformer);
    }
    public function includeSubkategori(Kategori $kategori){
        $subkategori= $kategori->subkategori()->latestFirst()->paginate(5);

        return $this->collection($subkategori, new SubkategoriTransformer);
    }

}