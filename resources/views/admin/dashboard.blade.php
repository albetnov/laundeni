@extends('templates.panel')
@section('title', 'Dashboard | Laundeni')
@section('content')
    <div class="row">
        <div class="col">
            <x-card>
                <x-slot name="header">Selamat Datang, {{ Auth::user()->name }}</x-slot>
                Kamu login sebagai, {{ Auth::user()->role }}
                <x-slot name="footer">
                    <form style="display: inline" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-success"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </x-slot>
            </x-card>
        </div>
        <div class="col">
            <x-card>
                <x-slot name="header">
                    Data Laundeni
                </x-slot>
                Contoh Data
                <x-slot name="footer"><button class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i> Lihat
                        selengkapnya...</button></x-slot>
            </x-card>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <x-card>
                <x-slot name="header">
                    Manage Akun
                </x-slot>
                <form action="#">
                    <div class="form-group mt-1">
                        <input type="text" class="form-control" name="username" placeholder="Ganti Username...">
                    </div>
                    <div class="form-group mt-1">
                        <input type="text" class="form-control" name="name" placeholder="Ganti nama...">
                    </div>
                </form>
            </x-card>
        </div>
        <div class="col">
            <x-card>
                <x-slot name="header">Daftar Transaksi Terbaru</x-slot>
                <p>
                    Nama: Asep<br>
                    Harga: 50000<br>
                    Status: Ngutang
                </p>
            </x-card>
        </div>
    </div>
@endsection
