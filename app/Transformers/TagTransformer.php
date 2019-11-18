<?php

namespace App\Transformers;

use App\Tag;
use App\Transformers\TransaksiTransformer;
use League\Fractal\TransformerAbstract;

class TagTransformer extends TransformerAbstract{
    protected $availableIncludes=[
        'transaksi'
    ];
    public function transform(Tag $tag){
        
        return[
            'id'                      => $tag->id,
            'nama'                    => $tag->nama
        ];
    }
    public function includeTransaksi(Tag $tag){
        $transaksi= $tag->transaksi()->latestFirst()->paginate(5);

        return $this->collection($transaksi, new TransaksiTransformer);
    }

}