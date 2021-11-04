@extends('templates.panel')
@section('title', 'Tambah Outlet')
@section('content')
    <x-card>
        <x-slot name="header">
            Tambah Data Outlet
        </x-slot>
        <form method="POST" id="add_outlet" action="{{ route('admin.outlet.store') }}">
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
                        <label for="outlet">Nama Outlet</label>
                        <input type="text" name="nama" id="outlet" value="{{ old('nama') }}" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" value="{{ old('alamat') }}" class="form-control" name="alamat">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <label for="tlp">No Telepon</label>
                        <input type="number" name="tlp" value="{{ old('tlp') }}" id="tlp" class="form-control">
                    </div>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <button class="btn btn-secondary btn-sm" onclick="location.href='{{ route('admin.outlet') }}'"><i
                    class="fas fa-arrow-left"></i> Kembali</button>
            <button class="btn btn-primary btn-sm" type="submit" form="add_outlet"><i class="fas fa-paper-plane"></i>
                Kirim</button>
        </x-slot>
    </x-card>
@endsection
