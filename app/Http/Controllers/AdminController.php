<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data = [
            'j_pelanggan' => Member::count(),
            'j_outlet' => Outlet::count(),
            'transaksi_terbaru' => Transaksi::with('user')->where('status', 'baru')->latest()->first()
        ];
        return view('admin.dashboard', $data);
    }

    public function pengguna()
    {
        $data = [
            'pengguna' => User::with('outlet')->lazy()
        ];
        return view('admin.pengguna.index', $data);
    }
}
