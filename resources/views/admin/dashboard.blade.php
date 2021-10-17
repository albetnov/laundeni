@extends('templates.panel')
@section('title', 'Dashboard | Laundeni')
@section('content')
    <div class="row">
        <div class="col">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Selamat Datang, {{ Auth::user()->name }}
                </div>
                <div class="card-body">
                    Kamu login sebagai, {{ Auth::user()->role }}
                </div>
                <div class="card-footer">
                    <form style="display: inline" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-sm btn-success"><i class="fas fa-sign-out-alt"></i> Logout</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Data Laundeni
                </div>
                <div class="card-body">
                    Contoh data
                </div>
                <div class="card-footer">
                    <button class="btn btn-sm btn-primary"><i class="fas fa-info-circle"></i> Lihat
                        selengkapnya...</button>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Manage Akun
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="form-group mt-1">
                            <input type="text" class="form-control" name="username" placeholder="Ganti Username...">
                        </div>
                        <div class="form-group mt-1">
                            <input type="text" class="form-control" name="name" placeholder="Ganti nama...">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-header">
                    Daftar Transaksi Terbaru
                </div>
                <div class="card-body">
                    <p>
                        Nama: Asep<br>
                        Harga: 50000<br>
                        Status: Ngutang
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
