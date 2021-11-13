@extends('templates.panel')
@section('title', 'Data Transaksi')
@section('content')
    <x-alert></x-alert>
    <x-card>
        <x-slot name="header">
            Daftar Pengguna
        </x-slot>
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary" onclick="location.href='{{ route('admin.transaksi.create') }}'"><i
                    class="fas fa-plus-circle"></i> Tambah
                Data</button>
        </div>
        <div class="table-responsive">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Outlet</th>
                        <th>Nama Pelanggan</th>
                        <th>Status</th>
                        <th>Batas Waktu</th>
                        <th>Status Pembayaran</th>
                        <th colspan="3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksi as $transaksi)
                        <tr>
                            <td>{{ !empty($i) ? ++$i : ($i = 1) }}</td>
                            <td>{{ $transaksi->outlet->nama }}</td>
                            <td>{{ $transaksi->member->nama }}</td>
                            @if ($transaksi->status != 'selesai')
                                <td>{{ $transaksi->status }}
                                    <form method="POST" style="display: inline"
                                        action="{{ route('admin.transaksi.selesai', $transaksi->id) }}">
                                        @csrf
                                        <button type="submit" class="btn">
                                            <span class="badge bg-success">Tandai Selesai</span>
                                        </button>
                                    </form>
                                </td>
                            @else
                                <td>{{ $transaksi->status }}</td>
                            @endif
                            <td>{{ empty($transaksi->batas_waktu) ? '-' : $transaksi->batas_waktu }}</td>
                            @if ($transaksi->dibayar == 'belum_dibayar')
                                <td>
                                    <form method="POST" style="display: inline"
                                        action="{{ route('admin.transaksi.paid', $transaksi->id) }}">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success"><i class="fas fa-check"></i>
                                            Tandai sudah
                                            dibayar</button>
                                    </form>
                                </td>
                            @else
                                <td>Sudah dibayar</td>
                            @endif
                            <td><button class="btn btn-sm btn-outline-secondary"
                                    onclick="location.href='{{ route('admin.transaksi.show', $transaksi->id) }}'"><i
                                        class="fas fa-eye"></i></button></td>
                            <td><button class="btn btn-sm btn-outline-primary"
                                    onclick="location.href='{{ route('admin.transaksi.edit', $transaksi->id) }}'"><i
                                        class="fas fa-pen"></i></button></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapusData{{ $transaksi->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="hapusData{{ $transaksi->id }}" tabindex="-1"
                                    role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
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
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tidak</button>
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

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-card>
@endsection
@push('scripts')
    <script>
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    </script>
@endpush
