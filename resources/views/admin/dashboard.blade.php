@extends('templates.panel')
@section('title', 'Dashboard')
@section('content')
    <x-alert></x-alert>
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
                Jumlah Pelanggan: {{ $j_pelanggan }} <br>
                Jumlah Outlet: {{ $j_outlet }}
                <x-slot name="footer"><button class="btn btn-sm btn-primary"
                        onclick="location.href='{{ route('admin.laporan') }}'"><i class="fas fa-info-circle"></i> Lihat
                        selengkapnya...</button></x-slot>
            </x-card>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <x-card>
                <x-slot name="header">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    Manage Akun
                </x-slot>
                <form action="{{ route('admin.modcuracc', Auth::user()->id) }}" method="POST">
                    @csrf
                    <input type="hidden" name="mod" value="curacc">
                    <div class="mt-1">
                        <input type="text" class="form-control" name="username"
                            value="{{ old('username', Auth::user()->username) }}" placeholder="Ganti Username...">
                    </div>
                    <div class="mt-1">
                        <input type="text" class="form-control" name="name"
                            value="{{ old('name', Auth::user()->name) }}" placeholder="Ganti nama...">
                    </div>
                    <x-slot name="footer">
                        <button class="btn btn-sm btn-primary"><i class="fas fa-pen"></i> Edit Account</button>
                </form>

                <!-- Button trigger modal -->
                <button type="button" class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#modelId">
                    <i class="fas fa-user-edit"></i> Change Password
                </button>

                <!-- Modal -->
                <div class="modal fade" id="modelId" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Change Password</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('admin.modcuracc', Auth::user()->id) }}">
                                    @csrf
                                    <input type="hidden" name="mod" value="chpass">
                                    <div class="mb-2">
                                        <input name="newpass" type="password" placeholder="New Password..."
                                            class="form-control">
                                    </div>
                                    <div class="mb-2">
                                        <input name="conpass" type="password" placeholder="Confirm New Password..."
                                            class="form-control">
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-user-edit"></i> Change
                                    Password</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                </x-slot>
            </x-card>
        </div>
        @empty(!$transaksi_terbaru)
            <div class="col">
                <x-card>
                    <x-slot name="header">Transaksi Terbaru</x-slot>
                    <p>
                        Nama: {{ $transaksi_terbaru->user->name }}<br>
                        Kode Invoice: {{ $transaksi_terbaru->kode_invoice }}<br>
                        Status Pembayaran: {{ $transaksi_terbaru->dibayar }}<br>
                        Batas Waktu: {{ $transaksi_terbaru->batas_waktu }}
                    </p>
                </x-card>
            </div>
        @endempty
    </div>
@endsection
