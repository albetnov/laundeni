@extends('templates.panel')
@section('title', 'Edit Transaksi')
@section('content')
    <x-card>
        <x-slot name="header">
            Edit Data Transaksi
        </x-slot>
        <form method="POST" id="update_transaksi" action="{{ route('admin.transaksi.update', $transaksi->id) }}">
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
                        <label for="outlet">Nama Outlet:</label>
                        <select name="id_outlet" id="outlet" class="form-select">
                            @foreach ($outlet as $outlet)
                                <option value="{{ $outlet->id }}"
                                    {{ old('id_outlet', $transaksi->id_outlet) == $outlet->id ? 'selected' : '' }}>
                                    {{ $outlet->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="member">Nama Member:</label>
                        <select name="id_member" class="form-select" id="member">
                            @foreach ($member as $member)
                                <option value="{{ $member->id }}"
                                    {{ old('id_member', $transaksi->id_member) == $member->id ? 'selected' : '' }}>
                                    {{ $member->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="user">Nama User:</label>
                        <select name="id_user" id="user" class="form-select">
                            @foreach ($users as $users)
                                <option value="{{ $users->id }}"
                                    {{ old('id_user', $transaksi->id_user) == $users->id ? 'selected' : '' }}>
                                    {{ $users->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <label for="tanggal">Tanggal:</label>
                        <input type="date" id="tanggal" class="form-control" name="tgl"
                            value="{{ old('tgl', $transaksi->tgl) }}" />
                    </div>
                    <div class="mb-2">
                        <label for="batas_waktu">Batas Waktu:</label>
                        <input type="date" id="batas_waktu" class="form-control"
                            value="{{ old('batas_waktu', $transaksi->batas_waktu) }}" name="batas_waktu" />
                    </div>
                    <div class="mb-2">
                        <label for="tgl_bayar">Tanggal Bayar:</label>
                        <input type="date" id="tgl_bayar" class="form-control"
                            value="{{ old('tgl_bayar', $transaksi->tgl_bayar) }}" name="tgl_bayar">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-2">
                        <label for="biaya_tambahan">Biaya Tambahan: (Rp.)</label>
                        <input type="number" id="biaya_tambahan" class="form-control"
                            value="{{ old('biaya_tambahan', $transaksi->biaya_tambahan) }}" name="biaya_tambahan">
                    </div>
                    <div class="mb-2">
                        <label for="diskon">Diskon: (%)</label>
                        <input type="number" id="diskon" class="form-control"
                            value="{{ old('diskon', $transaksi->diskon) }}" max="100" name="diskon">
                    </div>
                    <div class="mb-2">
                        <label for="pajak">Pajak: (%)</label>
                        <input type="number" id="pajak" class="form-control"
                            value="{{ old('pajak', $transaksi->pajak) }}" max="100" name="pajak">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="baru" {{ old('status', $transaksi->status) == 'baru' ? 'selected' : '' }}>Baru
                            </option>
                            <option value="proses" {{ old('status', $transaksi->status) == 'proses' ? 'selected' : '' }}>
                                Proses</option>
                            <option value="selesai"
                                {{ old('status', $transaksi->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                            <option value="ambil" {{ old('status', $transaksi->status) == 'ambil' ? 'selected' : '' }}>
                                Ambil</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="dibayar">Status Pembayaran:</label>
                        <select name="dibayar" id="dibayar" class="form-select">
                            <option value="dibayar"
                                {{ old('dibayar', $transaksi->dibayar) == 'dibayar' ? 'selected' : '' }}>Dibayar</option>
                            <option value="belum_dibayar"
                                {{ old('belum_dibayar', $transaksi->dibayar) == 'belum_dibayar' ? 'selected' : '' }}>
                                Belum Dibayar</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="kode_invoice">Kode Invoice:</label>
                        <button class="btn" type="button" onclick="makeNew()">
                            <span class="badge bg-primary"><i class="fas fa-undo"></i> Buat baru</span>
                        </button>
                        <input type="text" id="kode_invoice" name="kode_invoice" class="form-control"
                            value="{{ old('kode_invoice', $transaksi->kode_invoice) }}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="mb-2">
                        <label for="paket">Jenis Paket:</label>
                        <select name="id_paket" id="paket" class="form-select">
                            @foreach ($paket as $paket)
                                <option value="{{ $paket->id }}"
                                    {{ old('id_paket', $detail->id_paket) == $paket->id ? 'selected' : '' }}>
                                    {{ $paket->nama_paket }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="qty">Quantitas:</label>
                        <input type="number" class="form-control" value="{{ old('number', $detail->qty) }}" name="qty"
                            id="qty">
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <label for="keterangan">Keterangan:</label>
                        <textarea name="keterangan" class="form-control" id="keterangan" cols="10"
                            rows="10">{{ old('keterangan', $detail->keterangan) }}</textarea>
                    </div>
                </div>

            </div>

        </form>
        <x-slot name="footer">
            <button class="btn btn-secondary btn-sm" onclick="location.href='{{ route('admin.transaksi.index') }}'"><i
                    class="fas fa-arrow-left"></i> Kembali</button>
            <button class="btn btn-primary btn-sm" type="submit" form="update_transaksi"><i class="fas fa-paper-plane"></i>
                Kirim</button>
        </x-slot>
    </x-card>
@endsection
@push('scripts')
    <script>
        function randomize(length) {
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() *
                    charactersLength));
            }
            return result;
        }

        function makeNew() {
            var kode = document.querySelector("#kode_invoice");
            kode.value = randomize(20);
        }
    </script>
@endpush
