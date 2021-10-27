@extends('templates.panel')
@section('title', 'Daftar Pengguna')
@section('content')
    <x-alert></x-alert>
    <x-card>
        <x-slot name="header">
            Daftar Pengguna
        </x-slot>
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary" onclick="location.href='{{ route('admin.pengguna.create') }}'"><i
                    class="fas fa-plus-circle"></i> Tambah
                Data</button>
        </div>
        <div class="table-responsive">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Outlet</th>
                        <th>Role</th>
                        <th>Dibuat</th>
                        <th>Diperbarui</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengguna as $pengguna)
                        <tr>
                            <td>{{ !empty($i) ? ++$i : ($i = 1) }}</td>
                            <td>{{ $pengguna->name }}</td>
                            <td>{{ $pengguna->username }}</td>
                            @empty(!$pengguna->id_outlet)
                                <td>{{ $pengguna->outlet->nama }}</td>
                            @else
                                <td>Tiada Outlet</td>
                            @endempty
                            <td>{{ $pengguna->role }}</td>
                            <td>{{ $pengguna->created_at }}</td>
                            <td>{{ $pengguna->updated_at }}</td>
                            <td><button class="btn btn-sm btn-outline-primary"
                                    onclick="location.href='{{ route('admin.pengguna.edit', $pengguna->id) }}'"><i
                                        class="fas fa-pen"></i></button></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteUser{{ $pengguna->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteUser{{ $pengguna->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Data Pengguna</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin hapus data, {{ $pengguna->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tidak</button>
                                                <form style="display:inline;" method="POST"
                                                    action="{{ route('admin.pengguna.destroy', $pengguna->id) }}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit" class="btn btn-primary">Ya
                                                        Hapus!</button>
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
