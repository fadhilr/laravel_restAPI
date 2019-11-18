<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\KategoriTransformer;
use App\Kategori;

class KategoriController extends Controller
{
    public function kategori(Kategori $kategori){
        $kategori= $kategori->all();
        return fractal()
        ->collection($kategori)
        ->transformWith(new KategoriTransformer)
        ->includeTransaksi()
        ->includeSubkategori()
        ->toArray();
    }
    public function kategoriById(Kategori $kategori, $id){
        $kategori = $kategori->find($id);

        return fractal()
        ->item($kategori)
        ->transformWith(new KategoriTransformer)
        ->includeTransaksi()
        ->toArray();
    }
    public function add(Request $request,Kategori $kategori){
        $this->validate($request, [
            'nama'          => 'required'
        ]);

        $kategori= $kategori->create([
            'nama'            => $request->nama
        ]);
        
        $response= fractal()
        ->item($kategori)
        ->transformWith(new KategoriTransformer)
        ->toArray();

        return response()->json($response, 201);
    }
    public function update(Request $request, Kategori $kategori){
        // $this->authorize('update',$akun);

        $kategori->nama= $request->get('nama',$kategori->nama);
        $kategori->save();

        return fractal()
        ->item($kategori)
        ->transformWith(new KategoriTransformer)
        ->toArray();
    }
    public function delete(Kategori $kategori){
        // $this->authorize('update',$transaksi);

        $kategori->delete();
        return response()->json([
            'message'       => 'kategori dihapus'
        ]);
    }
}
