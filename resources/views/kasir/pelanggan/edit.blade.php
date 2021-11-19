@extends('templates.panel')
@section('title', 'Edit Data Pelanggan')
@section('content')
    <x-card>
        <x-slot name="header">
            Edit Data Pengguna
        </x-slot>
        <form method="POST" id="add_pelanggan" action="{{ route('kasir.pelanggan.update', $member->id) }}">
            @csrf
            @method('PUT')
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
                        <label for="nama">Nama</label>
                        <input type="text" id="nama" value="{{ old('nama', $member->nama) }}" class="form-control"
                            name="nama">
                    </div>
                    <div class="mb-2">
                        <label for="alamat">Alamat</label>
                        <textarea name="alamat" id="alamat" class="form-control" cols="5"
                            rows="3">{{ old('alamat', $member->alamat) }}</textarea>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <label for="jenis_kelamin">Jenis Kelamin</label>
                        <select class="form-select" name="jenis_kelamin" id="jenis_kelamin">
                            <option value="l" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'l' ? 'selected' : '' }}>
                                Laki-Laki</option>
                            <option value="p" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'p' ? 'selected' : '' }}>
                                Perempuan</option>
                            <option value="w" {{ old('jenis_kelamin', $member->jenis_kelamin) == 'w' ? 'selected' : '' }}>
                                Wibu</option>
                            <option value="t {{ old('jenis_kelamin', $member->jenis_kelamin) == 't' ? 'selected' : '' }}">
                                Transgender</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="nohp">No. Telepon</label>
                        <input type="nohp" id="nohp" name="nohp" value="{{ old('nohp', $member->tlp) }}"
                            class="form-control">
                    </div>
                </div>
            </div>
        </form>
        <x-slot name="footer">
            <button class="btn btn-secondary btn-sm" onclick="location.href='{{ route('kasir.pelanggan.index') }}'"><i
                    class="fas fa-arrow-left"></i> Kembali</button>
            <button class="btn btn-primary btn-sm" type="submit" form="add_pelanggan"><i class="fas fa-paper-plane"></i>
                Kirim</button>
        </x-slot>
    </x-card>
@endsection
