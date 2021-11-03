@extends('templates.panel')
@section('title', 'Daftar Outlet')
@section('content')
    <x-alert></x-alert>
    <x-card>
        <x-slot name="header">
            Daftar Outlet
        </x-slot>
        <div class="d-flex justify-content-end">
            <button class="btn btn-sm btn-primary" onclick="location.href='{{ route('admin.outlet.create') }}'"><i
                    class="fas fa-plus-circle"></i> Tambah
                Outlet</button>
        </div>
        <div class="table-responsive">
            <table class="table" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telepon</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($outlet as $outlet)
                        <tr>
                            <td>{{ !empty($i) ? ++$i : ($i = 1) }}</td>
                            <td>{{ $outlet->nama }}</td>
                            <td>{{ $outlet->alamat }}</td>
                            <td>{{ $outlet->tlp }}</td>
                            <td><button class="btn btn-sm btn-outline-primary"
                                    onclick="location.href='{{ route('admin.outlet.edit', $outlet->id) }}'"><i
                                        class="fas fa-pen"></i></button></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteUser{{ $outlet->id }}">
                                    <i class="fas fa-trash"></i>
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="deleteUser{{ $outlet->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modelTitleId" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Hapus Data Outlet</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                Yakin hapus data, {{ $outlet->name }}?
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Tidak</button>
                                                <form style="display:inline;" method="POST"
                                                    action="{{ route('admin.outlet.destroy', $outlet->id) }}">
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
