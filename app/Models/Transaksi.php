<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Outlet;
use App\Models\Member;

class Transaksi extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function outlet()
    {
        return $this->belongsTo(Outlet::class, 'id_outlet');
    }

    public function member()
    {
        return $this->belongsTo(Member::class, 'id_member');
    }
}
