@extends('templates.panel')
@section('title', 'Edit Paket')
@section('content')
    <x-card>
        <x-slot name="header">
            Edit Data Paket
        </x-slot>
        <form method="POST" id="add_paket" action="{{ route('admin.paket.update', $paket->id) }}">
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
                        <label for="id_outlet">Nama Outlet</label>
                        <select class="form-select" name="id_outlet">
                            @foreach ($outlet as $outlet)
                                <option value="{{ $outlet->id }}"
                                    {{ old('id_outlet', $paket->id_outlet) == $outlet->id ? 'selected' : '' }}>
                                    {{ $outlet->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="jenis">Jenis</label>
                        <select name="jenis" class="form-select">
                            <option value="selimut" {{ old('jenis', $paket->jenis) == 'selimut' ? 'selected' : '' }}>
                                Selimut</option>
                            <option value="kiloan" {{ old('jenis', $paket->jenis) == 'kiloan' ? 'selected' : '' }}>Kiloan
                            </option>
                            <option value="bed_cover" {{ old('jenis', $paket->jenis) == 'bed_cover' ? 'selected' : '' }}>
                                Bed Cover
                            </option>
                            <option value="kaos" {{ old('jenis', $paket->jenis) == 'kaos' ? 'selected' : '' }}>Kaos
                            </option>
                            <option value="dll" {{ old('jenis', $paket->jenis) == 'dll' ? 'selected' : '' }}>DLL</option>
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <label for="nama_paket">Nama Paket</label>
                        <input type="text" name="nama_paket" value="{{ old('nama_paket', $paket->nama_paket) }}"
                            id="nama_paket" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" value="{{ old('harga', $paket->harga) }}" id="harga"
                            class="form-control">
                    </div>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <button class="btn btn-secondary btn-sm" onclick="location.href='{{ route('admin.paket') }}'"><i
                    class="fas fa-arrow-left"></i> Kembali</button>
            <button class="btn btn-primary btn-sm" type="submit" form="add_paket"><i class="fas fa-paper-plane"></i>
                Kirim</button>
        </x-slot>
    </x-card>
@endsection
