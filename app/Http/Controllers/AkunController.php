<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Transformers\AkunTransformer;
use App\Akun;


class AkunController extends Controller
{
    public function akun(Akun $akun){
        $akun= $akun->all();
        return fractal()
        ->collection($akun)
        ->transformWith(new AkunTransformer)
        ->includeTransaksi()
        ->toArray();
    }
    public function akunById(Akun $akun, $id){
        $akun = $akun->find($id);

        return fractal()
        ->item($akun)
        ->transformWith(new AkunTransformer)
        ->includeTransaksi()
        ->toArray();
    }
    public function add(Request $request,Akun $akun){
        $this->validate($request, [
            'nama'          => 'required',
            'jenis'         => 'required'
        ]);

        $akun= $akun->create([
            'nama'            => $request->nama,
            'jenis'           => $request->jenis
        ]);
        
        $response= fractal()
        ->item($akun)
        ->transformWith(new AkunTransformer)
        ->toArray();

        return response()->json($response, 201);
    }
    public function update(Request $request, Akun $akun){
        // $this->authorize('update',$akun);

        $akun->nama= $request->get('nama',$akun->nama);
        $akun->jenis= $request->get('jenis',$akun->jenis);
        $akun->save();

        return fractal()
        ->item($akun)
        ->transformWith(new AkunTransformer)
        ->toArray();
    }
    public function delete(Akun $akun){
        // $this->authorize('update',$transaksi);

        $akun->delete();
        return response()->json([
            'message'       => 'akun dihapus'
        ]);
    }
}
