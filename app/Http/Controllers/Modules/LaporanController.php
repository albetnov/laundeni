<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Paket;
use App\Models\Transaksi;
use App\Models\User;

class LaporanController extends Controller
{
    public function index()
    {
        $data = [
            'c_user' => User::count(),
            'c_outlet' => Outlet::count(),
            'c_paket' => Paket::count(),
            'c_pelanggan' => Member::count(),
            'c_transaksi' => Transaksi::count(),
            'l_transaksi' => Transaksi::with('user')->where('status', 'baru')->latest()->limit(3)->get()
        ];
        return view('laporan.index', $data);
    }
}
