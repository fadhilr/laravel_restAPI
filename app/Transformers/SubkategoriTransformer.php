<?php

namespace App\Transformers;

use App\Subkategori;
use App\Transformers\TransaksiTransformer;
use League\Fractal\TransformerAbstract;

class SubkategoriTransformer extends TransformerAbstract{
    protected $availableIncludes=[
        'kategori'
    ];
    public function transform(Subkategori $subkategori){
        
        return[
            'id'                      => $subkategori->id,
            'kategori_id'             => $subkategori->kategori_id,
            'nama'                    => $subkategori->nama,
            'published'               => $subkategori->created_at->diffForHumans(),
        ];
    }
    public function includeKategori(Subkategori $subkategori){
        $kategori= $subkategori->kategori()->latestFirst()->paginate(5);

        return $this->collection($kategori, new KategoriTransformer);
    }

}