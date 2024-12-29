<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'Data Siswa')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

    <link rel="shortcut icon" href="{{ asset('img/login.svg') }}"/>

    <style>
        table, th, td {
            border: 1px solid black !important;
            border-collapse: collapse !important;
        }
    </style>

    @stack('styles')
</head>
<body>

<div class="card-body">
    <h3>Riwayat Pelanggaran Siswa</h3>
    <div class="table-responsive">
        <h5 class="text-gray-800" style="margin: 0; padding: 0;">Nama: {{ $siswa->nama_siswa }}</h5>
        <h5 class="text-gray-800" style="margin: 0; padding: 0;">NISN: {{ $siswa->nisn }}</h5>
        <table style="border: 1px solid black; border-collapse: collapse; width: 100%;">
            <thead>
            <tr>
                <th style="border: 1px solid black;">NO</th>
                <th style="border: 1px solid black;">PELANGGARAN</th>
                <th style="border: 1px solid black;">POIN</th>
                <th style="border: 1px solid black;">TANGGAL</th>
            </tr>
            </thead>
            <tbody>
            @foreach($dataPelanggaran as $data)
                <tr>
                    <td style="border: 1px solid black; text-align: center">{{ $loop->iteration }}</td>
                    <td style="border: 1px solid black;">{{ $data->subkriteria->nama_subkriteria }}</td>
                    <td style="border: 1px solid black; text-align: center">{{ $data->subkriteria->bobot_subkriteria }}</td>
                    <td style="border: 1px solid black; text-align: center">{{ $data->created_at->toDateString() }}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr>
                <td colspan="2"><strong>Total Score</strong></td>
                <td colspan="2">{{ $totalScore ?? 0 }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Sanksi</strong></td>
                <td colspan="2">{{ $sanksi ?? "-" }}</td>
            </tr>
            </tfoot>
        </table>
    </div>
</div>

</body>
</html>
