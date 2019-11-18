<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\SubkategoriTransformer;
use App\Subkategori;

class SubkategoriController extends Controller
{
    public function subkategori(Subkategori $subkategori){
        $subkategori= $subkategori->all();
        return fractal()
        ->collection($subkategori)
        ->transformWith(new SubkategoriTransformer)
        ->includeKategori()
        ->toArray();
    }
    public function subkategoriById(Subkategori $subkategori, $id){
        $subkategori = $subkategori->find($id);

        return fractal()
        ->item($subkategori)
        ->transformWith(new SubkategoriTransformer)
        ->includeKategori()
        ->toArray();
    }
    public function add(Request $request,Subkategori $subkategori){
        $this->validate($request, [
            'nama'          => 'required',
            'kategori_id'   => 'required'
        ]);

        $subkategori= $subkategori->create([
            'nama'                   => $request->nama,
            'kategori_id'            => $request->kategori_id
        ]);
        
        $response= fractal()
        ->item($subkategori)
        ->transformWith(new SubkategoriTransformer)
        ->toArray();

        return response()->json($response, 201);
    }
    public function update(Request $request, Subkategori $subkategori){
        // $this->authorize('update',$akun);

        $subkategori->nama          = $request->get('nama',$subkategori->nama);
        $subkategori->kategori_id   = $request->get('kategori_id',$subkategori->kategori_id);
        $subkategori->save();

        return fractal()
        ->item($subkategori)
        ->transformWith(new SubkategoriTransformer)
        ->toArray();
    }
    public function delete(Subkategori $subkategori){
        // $this->authorize('update',$transaksi);

        $subkategori->delete();
        return response()->json([
            'message'       => 'subkategori dihapus'
        ]);
    }
}
