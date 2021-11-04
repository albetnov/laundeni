<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\Outlet;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.outlet.tambah');
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
                'nama' => 'required|string|min:3|max:128',
                'alamat' => 'required|string|min:3|max:255',
                'tlp' => 'required|max:15'
            ]
        );
        Outlet::create($data);
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil ditambahkan'
        ];
        return redirect()->route('admin.outlet')->with($notif);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        abort_if($outlet->nama === 'super', 404);
        return view('admin.outlet.edit', compact('outlet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        abort_if($outlet->nama === 'super', 404);
        $data = $request->validate([
            'nama' => 'required|string|min:3|max:128',
            'alamat' => 'required|string|min:3|max:255',
            'tlp' => 'required|max:15'
        ]);
        Outlet::find($outlet->id)->update($data);
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil diperbarui'
        ];
        return redirect()->route('admin.outlet')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Outlet $outlet)
    {
        abort_if($outlet->nama === 'super', 404);
        Outlet::find($outlet->id)->delete();
        $notif = [
            'tipe' => 'success',
            'pesan' => 'Data berhasil dihapus'
        ];
        return redirect()->back()->with($notif);
    }
}
