<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Pengguna extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'outlet' => Outlet::lazy()
        ];
        return view('admin.pengguna.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'outlet' => 'required',
            'name' => 'required|min:3|max:120',
            'username' => 'required|min:3|max:120|unique:users',
            'role' => 'required',
            'password' => 'required|min:3'
        ]);
        $data = [
            'id_outlet' => $request->outlet,
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
            'password' => bcrypt($request->password)
        ];
        User::create($data);
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data pengguna berhasil ditambah'
        ];
        return redirect()->route('admin.pengguna')->with($notif);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data = [
            'outlet' => Outlet::lazy(),
            'user' => $user
        ];
        return view('admin.pengguna.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'outlet' => 'required',
            'name' => 'required|min:3|max:120',
            'username' => 'required|min:3|max:120|unique:users,username,' . $user->id,
            'role' => 'required',
            'password' => 'nullable|min:8'
        ]);
        $data = [
            'id_outlet' => $request->outlet,
            'name' => $request->name,
            'username' => $request->username,
            'role' => $request->role,
        ];
        if (!empty($request->password)) {
            $data['password']  = bcrypt($request->password);
        }
        $user->update($data);
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil diperbarui'
        ];
        return redirect()->route('admin.pengguna')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil dihapus'
        ];
        return redirect()->route('admin.pengguna')->with($notif);
    }

    public function assign_role(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'role' => 'required'
        ]);
        if ($validator->fails()) {
            $notif = [
                'tipe' => 'danger',
                'pesan' => 'Gagal memberikan role'
            ];
            return redirect()->back()->with($notif);
        }
        $user->role = $request->role;
        $user->save();
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Role berhasil diberikan'
        ];
        return redirect()->back()->with($notif);
    }
}
