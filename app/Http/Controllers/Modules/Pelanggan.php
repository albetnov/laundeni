<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;

class Pelanggan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'member' => Member::lazy()
        ];
        return view('admin.pelanggan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pelanggan.tambah');
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
            'nama' => 'required|min:3|max:64',
            'alamat' => 'required|min:1|max:225',
            'jenis_kelamin' => 'required',
            'nohp' => 'required|max:15'
        ]);
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tlp' => $request->nohp
        ];
        Member::create($data);
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil ditambahkan'
        ];
        return redirect()->route('admin.pelanggan.index')->with($notif);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        return view('admin.pelanggan.edit', compact('member'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'nama' => 'required|min:3|max:64',
            'alamat' => 'required|min:1|max:225',
            'jenis_kelamin' => 'required',
            'nohp' => 'required|max:15'
        ]);
        $data = [
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'jenis_kelamin' => $request->jenis_kelamin,
            'tlp' => $request->nohp
        ];
        Member::find($member->id)->update($data);
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil diperbarui'
        ];
        return redirect()->route('admin.pelanggan.index')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy(Member $member)
    {
        Member::find($member->id)->delete();
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil dihapus'
        ];
        return redirect()->back()->with($notif);
    }
}
