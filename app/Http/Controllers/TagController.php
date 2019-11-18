<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\TagTransformer;
use App\Tag;

class TagController extends Controller
{
    public function tag(Tag $tag){
        $tag= $tag->all();
        return fractal()
        ->collection($tag)
        ->transformWith(new TagTransformer)
        ->includeTransaksi()
        ->toArray();
    }
    public function tagById(Tag $tag, $id){
        $tag = $tag->find($id);

        return fractal()
        ->item($tag)
        ->transformWith(new TagTransformer)
        ->includeTransaksi()
        ->toArray();
    }
    public function add(Request $request,Tag $tag){
        $this->validate($request, [
            'nama'          => 'required'
        ]);

        $tag= $tag->create([
            'nama'            => $request->nama
        ]);
        
        $response= fractal()
        ->item($tag)
        ->transformWith(new TagTransformer)
        ->toArray();

        return response()->json($response, 201);
    }
    public function update(Request $request, Tag $tag){
        // $this->authorize('update',$akun);

        $tag->nama= $request->get('nama',$tag->nama);
        $tag->save();

        return fractal()
        ->item($tag)
        ->transformWith(new TagTransformer)
        ->toArray();
    }
    public function delete(Tag $tag){
        // $this->authorize('update',$transaksi);

        $tag->delete();
        return response()->json([
            'message'       => 'akun dihapus'
        ]);
    }
}
