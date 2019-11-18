<?php

namespace App\Policies;

use App\User;
use App\Transaksi;
use Illuminate\Auth\Access\HandlesAuthorization;

class TransaksiPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Transaksi $transaksi){
        return $user->ownTransaksi($transaksi);
    }
    public function delete(User $user, Transaksi $transaksi){
        return $user->ownTransaksi($transaksi);
    }
}
