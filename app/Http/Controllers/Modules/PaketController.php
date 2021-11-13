<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
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
        return view('admin.paket.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate(
            [
                'id_outlet' => 'required|integer',
                'jenis' => 'required',
                'nama_paket' => 'required|min:3|max:100',
                'harga' => 'required|integer'
            ]
        );
        Paket::create($data);
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil ditambahkan'
        ];
        return redirect()->route('admin.paket')->with($notif);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        $outlet = Outlet::lazy();
        return view('admin.paket.edit', compact('paket', 'outlet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        $data = $request->validate(
            [
                'id_outlet' => 'required|integer',
                'jenis' => 'required',
                'nama_paket' => 'required|min:3|max:100',
                'harga' => 'required|integer'
            ]
        );
        $paket->update($data);
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil diperbarui'
        ];
        return redirect()->route('admin.paket')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paket $paket)
    {
        $paket->delete();
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil dihapus'
        ];
        return redirect()->back()->with($notif);
    }
}
