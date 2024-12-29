@extends('layouts.app')

@section('title', 'Guru')

@section('content')
    <div class="container-fluid">
        <!-- Display Error Messages -->
        @include('layouts.partials.messages')

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Guru</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambahdata">
                    <i class='bx bx-user-plus'></i>
                    Input Guru
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA</th>
                            <th>EMAIL</th>
                            <th>ROLE</th>
                            <th>AKSI</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($guru as $item)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <th>{{ $item->name }}</th>
                                    <th>{{ $item->email }}</th>
                                    <th>{{ $item->role->nama_role }}</th>
                                    <td>
                                        <a href="{{ route('guru.edit', $item->id) }}" class="btn btn-warning">
                                            <i class='bx bxs-edit'></i>
                                        </a>

                                        <form action="{{ route('guru.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">
                                                <i class='bx bxs-trash'></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Modal Tambah -->
        <div class="modal fade" id="tambahdata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Guru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('guru.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" placeholder="Masukkan Username" name="name" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="email" placeholder="Masukkan Email" name="email" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password" placeholder="Masukkan Password" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="password" name="password_confirmation" placeholder="Masukkan Ulang Password" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-info"><i class='bx bx-plus'></i> Tambah Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
