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

    public function mod_curacc(User $user, Request $request)
    {
        if ($request->mod == 'curacc') {
            $rules = [
                'username' => 'required|string|max:56|unique:users,username,' . Auth::user()->id,
                'name' => 'required|string|max:64'
            ];
            $data = [
                'username' => $request->username,
                'name' => $request->name
            ];
        } else if ($request->mod == 'chpass') {
            $rules = [
                'newpass' => 'required_with:conpass|string|max:128',
                'conpass' => 'string|same:newpass'
            ];
            $data = [
                'password' => bcrypt($request->newpass)
            ];
        }
        $request->validate($rules);
        User::where('id', $user->id)->update($data);
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil dimofikasi'
        ];
        return redirect()->back()->with($notif);
    }
}
