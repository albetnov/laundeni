<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\Paket;
use App\Models\Outlet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    private function getTransaksi($optional = null, $transaksi = null)
    {
        if (!is_null($optional) && $optional == 'detail') {
            return DetailTransaksi::with('paket')->firstWhere('id_transaksi', $transaksi->id);
        }
        if (Auth::user()->role === 'kasir') {
            return Transaksi::with('user', 'member', 'outlet')->where('id_outlet', Auth::user()->id_outlet)->lazy();
        } else {
            return Transaksi::with('user', 'member', 'outlet')->lazy();
        }
    }

    private function ValidateUser(Transaksi $transaksi)
    {
        $transaksi = Transaksi::with('user', 'member', 'outlet')->where('id', $transaksi->id)->first();
        if (Auth::user()->role === 'kasir' && $transaksi->id_user != Auth::user()->id) {
            abort(404);
        }
    }
    /** 
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'transaksi' => $this->getTransaksi()
        ];
        return view('admin.transaksi.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'outlet' => Outlet::get(['nama', 'id']),
            'member' => Member::get(['nama', 'id']),
            'users' => User::get(['name', 'id']),
            'paket' => Paket::get(['nama_paket', 'id'])
        ];
        return view('admin.transaksi.tambah', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'id_outlet' => 'required|integer',
            'id_member' => 'required|integer',
            'id_user' => 'required|integer',
            'tgl' => 'required|date',
            'batas_waktu' => 'required|date|after:tgl',
            'tgl_bayar' => 'required|date|before:batas_waktu',
            'biaya_tambahan' => 'integer|nullable',
            'diskon' => 'integer|nullable',
            'pajak' => 'integer|nullable',
            'status' => 'required',
            'dibayar' => 'required',
            'kode_invoice' => 'required|unique:transaksis',
            'id_paket' => 'required|integer',
            'qty' => 'required|integer',
            'keterangan' => 'required|max:512'
        ]);
        $attempt = DB::transaction(function () use ($data) {
            $id_transaksi = Transaksi::create(Arr::except($data, ['id_paket', 'qty', 'keterangan']));
            $data['id_transaksi'] = $id_transaksi->id;
            DetailTransaksi::create(Arr::only($data, ['id_paket', 'qty', 'keterangan', 'id_transaksi']));
            return True;
        });
        if ($attempt) {
            $notif = [
                'pesan' => 'Data berhasil ditambahkan.',
                'tipe' => 'success'
            ];
        } else {
            $notif = [
                'pesan' => 'Data gagal ditambahkan. Sihlakan ulangi lagi.',
                'tipe' => 'danger'
            ];
        }
        return redirect()->route('admin.transaksi.index')->with($notif);
    }

    /**
     * @param \App\Models\Transaksi $transaksi
     * @return \Illuminate\Http\Response
     */
    public function paid(Transaksi $transaksi)
    {
        $this->ValidateUser($transaksi);
        $data = [
            'tgl_bayar' => date('Y-m-d'),
            'dibayar' => 'dibayar'
        ];
        $transaksi->update($data);
        $notif = [
            'pesan' => 'Data berhasil diperbarui',
            'tipe' => 'success'
        ];
        return redirect()->back()->with($notif);
    }
    /**
     * @param \App\Models\Transaksi $transaksi
     * @return \Illuminate\Http\Response
     */
    public function selesai(Transaksi $transaksi)
    {
        $this->ValidateUser($transaksi);
        $data = [
            'status' => 'selesai'
        ];
        $transaksi->update($data);
        $notif = [
            'pesan' => 'Data berhasil diperbarui',
            'tipe' => 'success'
        ];
        return redirect()->back()->with($notif);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $this->ValidateUser($transaksi);
        $detail = $this->getTransaksi($optional = 'detail', $transaksi);
        return view('admin.transaksi.show', compact('transaksi', 'detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        $this->ValidateUser($transaksi);
        $data = [
            'outlet' => Outlet::get(['nama', 'id']),
            'member' => Member::get(['nama', 'id']),
            'users' => User::get(['name', 'id']),
            'paket' => Paket::get(['nama_paket', 'id']),
            'detail' => $this->getTransaksi('detail', $transaksi),
            'transaksi' => $transaksi
        ];
        return view('admin.transaksi.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $data = $request->validate([
            'id_outlet' => 'required|integer',
            'id_member' => 'required|integer',
            'id_user' => 'required|integer',
            'tgl' => 'required|date',
            'batas_waktu' => 'required|date|after:tgl',
            'tgl_bayar' => 'required|date|before:batas_waktu',
            'biaya_tambahan' => 'integer|nullable',
            'diskon' => 'integer|nullable',
            'pajak' => 'integer|nullable',
            'status' => 'required',
            'dibayar' => 'required',
            'kode_invoice' => 'required|unique:transaksis,kode_invoice,' . $transaksi->id,
            'id_paket' => 'required|integer',
            'qty' => 'required|integer',
            'keterangan' => 'required|max:512'
        ]);
        $attempt = DB::transaction(function () use ($data, $transaksi) {
            $transaksi->update(Arr::except($data, ['id_paket', 'qty', 'keterangan']));
            DetailTransaksi::find('id_transaksi', $transaksi->id)->update(Arr::only($data, ['id_paket', 'qty', 'keterangan', 'id_transaksi']));
            return True;
        });
        if ($attempt) {
            $notif = [
                'pesan' => 'Data berhasil diperbarui.',
                'tipe' => 'success'
            ];
        } else {
            $notif = [
                'pesan' => 'Data gagal diperbarui. Sihlakan ulangi lagi.',
                'tipe' => 'danger'
            ];
        }
        return redirect()->route('admin.transaksi.index')->with($notif);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $attempt = DB::transaction(function () use ($transaksi) {
            DetailTransaksi::find('id_transaksi', $transaksi->id)->delete();
            $transaksi->delete();
            return True;
        });
        if ($attempt) {
            $notif = [
                'pesan' => 'Data berhasil dihapus.',
                'tipe' => 'success'
            ];
        } else {
            $notif = [
                'pesan' => 'Data gagal dihapus.',
                'tipe' => 'danger'
            ];
        }
        return redirect()->back()->with($notif);
    }
}
