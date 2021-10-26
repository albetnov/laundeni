<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaksi extends Model
{
    use HasFactory;
    const CREATED_AT = 'tgl';
    const UPDATED_AT = null;

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
