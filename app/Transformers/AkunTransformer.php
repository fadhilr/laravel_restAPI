<?php

namespace App\Transformers;

use App\Akun;
use App\Transformers\TransaksiTransformer;
use League\Fractal\TransformerAbstract;

class AkunTransformer extends TransformerAbstract{
    protected $availableIncludes=[
        'transaksi'
    ];
    public function transform(Akun $akun){
        
        return[
            'id'                      => $akun->id,
            'nama'                    => $akun->nama,
            'jenis'                   => $akun->jenis,
            'published'               => $akun->created_at->diffForHumans(),
        ];
    }
    public function includeTransaksi(Akun $akun){
        $transaksi= $akun->transaksi()->latestFirst()->paginate(5);

        return $this->collection($transaksi, new TransaksiTransformer);
    }

}