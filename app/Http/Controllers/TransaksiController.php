<?php

namespace App\Http\Controllers;

use App\Transformers\TransaksiTransformer;
use Illuminate\Http\Request;
use App\Transaksi;
use Auth;

class TransaksiController extends Controller
{
    public function transaksi(Transaksi $transaksi){
        $transaksi= $transaksi->paginate(5);
        return fractal()
        ->collection($transaksi)
        ->transformWith(new TransaksiTransformer)
        ->includeUser()
        ->includeAkun()
        ->includeKategori()
        ->includeSubkategori()
        ->includeTag()
        ->toArray();
    }
    public function transaksiById(Transaksi $transaksi, $id){
        $transaksi= $transaksi->find($id);
        return fractal()
        ->item($transaksi)
        ->transformWith(new TransaksiTransformer)
        ->includeUser()
        ->includeAkun()
        ->includeKategori()
        ->includeSubkategori()
        ->includeTag()
        ->toArray();
    }  
    public function cari(Request $request, Transaksi $transaksi){
        $keyword=$request->cari;
        $transaksi=$transaksi->where('subkategori_id', 'like','%'.$keyword.'%')
                             ->orWhere('akun_id', 'like','%'.$keyword.'%')
                             ->orWhere('tag_id', 'like','%'.$keyword.'%')
                             ->orWhere('tanggal', 'like','%'.$keyword.'%')
                             ->orWhere('keterangan', 'like','%'.$keyword.'%')
                             ->paginate(5);
        return fractal()
        ->collection($transaksi)
        ->transformWith(new TransaksiTransformer())
        ->toArray();
    } 
    public function order(Request $request, Transaksi $transaksi){
        $orderBy=$request->order;
        if ($orderBy=="tanggal") {
            $transaksi=$transaksi->orderBy('tanggal', 'asc')
                                 ->get();
        } else if ($orderBy=="nominal") {
            $transaksi=$transaksi->orderBy('nominal', 'asc')
                                 ->get();
        } else {
            $transaksi=$transaksi->orderBy('id', 'asc')
                                 ->paginate(5);
        }
        
        return fractal()
        ->collection($transaksi)
        ->transformWith(new TransaksiTransformer())
        ->toArray();
    } 
    public function add(Request $request,Transaksi $transaksi){
        $this->validate($request, [
            'tanggal'       => 'required',
            'nominal'       => 'required',
            'keterangan'    => 'required'
        ]);

        $transaksi=$transaksi->create([
            'user_id'            => Auth::user()->id,
            'tanggal'            => $request->tanggal,
            'nominal'            => $request->nominal,
            'keterangan'         => $request->keterangan,
            'akun_id'            => $request->akun_id,
            'kategori_id'        => $request->kategori_id,
            'subkategori_id'     => $request->subkategori_id,
            'tag_id'             => $request->tag_id
        ]);
        
        $response= fractal()
        ->item($transaksi)
        ->transformWith(new TransaksiTransformer)
        ->toArray();

        return response()->json($response, 201);
    }
    public function update(Request $request, Transaksi $transaksi){
        $this->authorize('update',$transaksi);

        $transaksi->tanggal= $request->get('tanggal',$transaksi->tanggal);
        $transaksi->nominal= $request->get('nominal',$transaksi->nominal);
        $transaksi->keterangan= $request->get('keterangan',$transaksi->keterangan);
        $transaksi->save();

        return fractal()
        ->item($transaksi)
        ->transformWith(new TransaksiTransformer)
        ->toArray();
    }
    
    public function delete(Transaksi $transaksi){
        $this->authorize('delete',$transaksi);

        $transaksi->delete();
        return response()->json([
            'message'       => 'transaksi dihapus'
        ]);
    }
}
