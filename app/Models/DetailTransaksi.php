<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Paket;

class DetailTransaksi extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = ['id'];
    public function paket()
    {
        return $this->belongsTo(Paket::class, 'id_paket');
    }
}
