<?php

namespace App\Http\Controllers;
use App\Transformers\UserTransformer;
use App\User;
use Illuminate\Http\Request;
use Auth;

class UserController extends Controller
{
    public function users(User $user){
        $users=$user->all();
        return fractal()
        ->collection($users)
        ->transformWith(new UserTransformer())
        ->includeTransaksi()
        ->toArray();
    }
    public function profile(User $user){
        $user = $user->find(Auth::user()->id);

        return fractal()
        ->item($user)
        ->transformWith(new UserTransformer)
        ->includeTransaksi()
        ->toArray();
    }
    public function profileById(User $user, $id){
        $user = $user->find($id);

        return fractal()
        ->item($user)
        ->transformWith(new UserTransformer)
        ->includeTransaksi()
        ->toArray();
    }
    public function update(Request $request, User $user){
        // $this->authorize('update',$user);

        $user->name= $request->get('name',$user->name);
        $user->email= $request->get('email',$user->email);
        $user->save();

        return fractal()
        ->item($user)
        ->transformWith(new UserTransformer)
        ->toArray();
    }
    public function delete(User $user){
        // $this->authorize('delete',$user);

        $user->delete();
        return response()->json([
            'message'       => 'users dihapus'
        ]);
    }
}
