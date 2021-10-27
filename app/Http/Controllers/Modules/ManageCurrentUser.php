<?php

namespace App\Http\Controllers\Modules;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ManageCurrentUser extends Controller
{
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
