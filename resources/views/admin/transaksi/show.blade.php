@extends('templates.panel')
@section('title', 'Detail ' . $transaksi->kode_invoice)
@section('content')
    <x-card>
        <x-slot name="header">
            Detail {{ $transaksi->kode_invoice }}
        </x-slot>

        <div class="row">
            <div class="col">
                <p>Nama Outlet: {{ $transaksi->outlet->nama }}</p>
                <p>Nama Pelanggan: {{ $transaksi->member->nama }}</p>
            </div>
            <div class="col">
                <p>Nama User: {{ $transaksi->user->name }}</p>
                <p>Tanggal: {{ $transaksi->tgl }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>Batas Waktu: {{ empty($transaksi->batas_waktu) ? '-' : $transaksi->batas_waktu }}</p>
                <p>Tanggal Pembayaran: {{ empty($transaksi->tgl_bayar) ? '-' : $transaksi->tgl_bayar }}</p>
            </div>
            <div class="col">
                <p>Biaya Tambahan: {{ empty($transaksi->biaya_tambahan) ? '-' : 'Rp.' . $transaksi->biaya_tambahan }}</p>
                <p>Diskon: {{ empty($transaksi->diskon) ? '-' : $transaksi->diskon . '%' }}</p>
                <p>Pajak: {{ empty($transaksi->pajak) ? '-' : $transaksi->pajak . '%' }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <p>Status: {{ $transaksi->status }}</p>
                <p>Status Pembayaran: {{ $transaksi->dibayar == 'dibayar' ? 'Sudah dibayar' : 'Belum dibayar' }}</p>
                <p>Kode Invoice: {{ $transaksi->kode_invoice }}</p>
            </div>
            <div class="col">
                <p>Paket: {{ $detail->paket->nama_paket }}
                    <button class="btn" onclick="location.href='{{ route('admin.paket') }}'">
                        <span class="badge bg-primary"><i class="fas fa-info-circle"></i> Detail</span>
                    </button>
                </p>
                <p>Quantity: {{ $detail->qty }}</p>
                <p>Keterangan: {{ $detail->keterangan }}</p>
            </div>
        </div>

        <x-slot name="footer">
            <button class="btn btn-sm btn-secondary" onclick="location.href='{{ route('admin.transaksi.index') }}'"><i
                    class="fas fa-arrow-left"></i></button>
            <button class="btn btn-sm btn-primary"
                onclick="location.href='{{ route('admin.transaksi.edit', $transaksi->id) }}'"><i
                    class="fas fa-pen"></i></button>
            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                data-bs-target="#hapusData{{ $transaksi->id }}">
                <i class="fas fa-trash"></i>
            </button>

            <!-- Modal -->
            <div class="modal fade" id="hapusData{{ $transaksi->id }}" tabindex="-1" role="dialog"
                aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Hapus Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Yakin hapus data, {{ $transaksi->kode_invoice }}?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tidak</button>
                            <form method="POST" style="display:inline;"
                                action="{{ route('admin.transaksi.destroy', $transaksi->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </x-slot>
    </x-card>
@endsection
