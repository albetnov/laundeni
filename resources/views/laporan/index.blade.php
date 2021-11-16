@extends('templates.panel')
@section('title', 'Laporan')
@section('content')
    <div class="row">
        <div class="col">
            <x-card>
                <x-slot name="header">
                    Laporan {{ config('app.name') }}
                </x-slot>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Jumlah User:</th>
                            <td>{{ $c_user }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Outlet: </th>
                            <td>{{ $c_outlet }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Paket: </th>
                            <td>{{ $c_paket }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Pelanggan: </th>
                            <td>{{ $c_pelanggan }}</td>
                        </tr>
                        <tr>
                            <th>Jumlah Transaksi</th>
                            <td>{{ $c_transaksi }}</td>
                        </tr>
                    </table>
                </div>
            </x-card>
        </div>
        <div class="col">
            <x-card>
                <x-slot name="header">
                    Daftar Transaksi Terbaru
                </x-slot>
                @foreach ($l_transaksi as $lt)
                    Nama: {{ $lt->user->name }}<br>
                    Kode Invoice: {{ $lt->kode_invoice }}<br>
                    Status Pembayaran: {{ $lt->dibayar }}<br>
                    Batas Waktu: {{ $lt->batas_waktu }}
                    <hr>
                @endforeach
            </x-card>
        </div>
    </div>
@endsection
