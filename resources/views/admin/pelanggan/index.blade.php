@extends('templates.panel')
@section('title', 'Data Pelanggan')
@section('content')
    <x-alert></x-alert>
    <x-card>
        <x-slot name="header">
            Daftar Pelanggan
        </x-slot>
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary" onclick="location.href='{{ route('admin.pelanggan.create') }}'"><i
                    class="fas fa-plus-circle"></i> Tambah
                Data</button>
        </div>
        <div class="table-responsive">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>No. Telepon</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($member as $member)
                        <tr>
                            <td>{{ !empty($i) ? ++$i : ($i = 1) }}</td>
                            <td>{{ $member->nama }}</td>
                            <td>{{ $member->alamat }}</td>
                            @if ($member->jenis_kelamin == 'l')
                                <td>Laki-Laki</td>
                            @elseif ($member->jenis_kelamin == 'p')
                                <td>Perempuan</td>
                            @elseif ($member->jenis_kelamin == 't')
                                <td>Transgender</td>
                            @else
                                <td>Wibu</td>
                            @endif
                            <td>{{ $member->tlp }}</td>
                            <td><button class="btn btn-sm btn-outline-primary"
                                    onclick="location.href='{{ route('admin.pelanggan.edit', $member->id) }}'"><i
                                        class="fas fa-pen"></i></button></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#hapusData{{ $member->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="hapusData{{ $member->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin hapus data, {{ $member->nama }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tidak</button>
                                                <form method="POST" style="display:inline;"
                                                    action="{{ route('admin.pelanggan.destroy', $member->id) }}">
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
