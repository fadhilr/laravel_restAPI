<?php 
    namespace App\Transformers;

    use App\User;
    use App\Transformers\TransaksiTransformer;
    use League\Fractal\TransformerAbstract;

    class UserTransformer extends TransformerAbstract{
        protected $availableIncludes=[
            'transaksi'
        ];

        public function transform(User $user){
            return[
                'id'        => $user->id,
                'name'      => $user->name,
                'email'     => $user->email,
                'registered'=> $user->created_at->diffForHumans(),
            ];
        }
        public function includeTransaksi(User $user){
            $transaksi= $user->transaksi()->latestFirst()->paginate(5);

            return $this->collection($transaksi, new TransaksiTransformer);
        }
    }

?>