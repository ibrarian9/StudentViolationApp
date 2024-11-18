@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <!-- Display Error Messages -->
        @include('layouts.partials.messages')

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Data Siswa</h1>
        </div>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#tambahdata">
                    <i class='bx bx-user-plus'></i>
                    Input Siswa
                </button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>NO</th>
                            <th>NISN</th>
                            <th>KELAS</th>
                            <th>SISWA</th>
                            <th>JENIS KELAMIN</th>
                            <th>WALI</th>
                            <th>NO HP WALI</th>
                            <th>AKSI</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($siswa as $index => $siswas)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $siswas->nisn }}</td>
                                <td>{{ $siswas->kelas }}</td>
                                <td>{{ $siswas->nama_siswa }}</td>
                                <td>{{ $siswas->jk_siswa }}</td>
                                <td>{{ $siswas->nama_ayah }} / {{ $siswas->nama_ibu }}</td>
                                <td>{{ $siswas->nohp_ortu }}</td>
                                <td>
                                    <a href="{{ route('siswa.show', $siswas->id_siswa) }}" class="btn btn-primary">
                                        <i class='bx bxs-info-circle'></i>
                                    </a>

                                    <a href="{{ route('siswa.edit', $siswas->id_siswa) }}" class="btn btn-warning">
                                        <i class='bx bxs-edit'></i>
                                    </a>

                                    <form action="{{ route('siswa.destroy', $siswas->id_siswa) }}" method="POST" style="display:inline;">
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
                        <h5 class="modal-title" id="exampleModalLabel">Tambah Siswa</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('siswa.store') }}" method="POST">
                        @csrf
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" placeholder="Masukkan Nama Siswa" name="nama_siswa" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" placeholder="Masukkan NISN Siswa" name="nisn" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Pilih Kelas</label>
                                </div>
                                <select name="kelas" class="form-control" required>
                                    @php
                                        $kelas = [
                                            '7A','7B','7C','7D','7E','7F','7G',
                                            '8A','8B','8C','8D','8E','8F','8G','8H','8I','8J',
                                            '9A','9B','9C','9D','9E','9F','9G','9H'
                                        ];
                                    @endphp
                                    @foreach($kelas as $k)
                                        <option value="{{ $k }}">{{ $k }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Pilih Jenis Kelamin</label>
                                </div>
                                <select name="jk_siswa" class="form-control" required>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="tempat_lahir" placeholder="Masukkan Tempat Lahir" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <label class="input-group-text" for="inputGroupSelect01">Tanggal Lahir</label>
                                </div>
                                <input type="date" name="tgl_lahir" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="nama_ayah" placeholder="Masukkan Nama Ayah" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="nama_ibu" placeholder="Masukkan Nama Ibu" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="alamat" placeholder="Masukkan Alamat" class="form-control" required>
                            </div>

                            <div class="input-group mb-3">
                                <input type="text" name="nohp_ortu" placeholder="Masukkan No HP Wali / Orang Tua" class="form-control" required>
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
