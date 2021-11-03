@extends('templates.panel')
@section('title', 'Tambah Pengguna')
@section('content')
    <x-card>
        <x-slot name="header">
            Tambah Data Pengguna
        </x-slot>
        <form method="POST" id="add_pengguna" action="{{ route('admin.pengguna.store') }}">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    Validasi gagal!
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="mb-2">
                        <label for="outlet">Outlet</label>
                        <select class="form-select" id="outlet" name="outlet">
                            @foreach ($outlet as $outlet)
                                <option {{ old('outlet') == $outlet->nama ? 'selected' : '' }}
                                    value="{{ $outlet->id }}">{{ $outlet->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" value="{{ old('nama') }}" class="form-control" name="name">
                    </div>
                    <div class="mb-2">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="{{ old('username') }}" id="username"
                            class="form-control">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <label for="role">Role</label>
                        <select class="form-select" name="role" id="role">
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="kasir" {{ old('role') == 'kasir' ? 'selected' : '' }}>Kasir</option>
                            <option value="owner" {{ old('role') == 'owner' ? 'selected' : '' }}>Owner</option>
                            <option value="disabled {{ old('role') == 'disabled' ? 'selected' : '' }}">Disabled</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" class="form-control">
                    </div>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <button class="btn btn-secondary btn-sm" onclick="location.href='{{ route('admin.pengguna') }}'"><i
                    class="fas fa-arrow-left"></i> Kembali</button>
            <button class="btn btn-primary btn-sm" type="submit" form="add_pengguna"><i class="fas fa-paper-plane"></i>
                Kirim</button>
        </x-slot>
    </x-card>
@endsection
