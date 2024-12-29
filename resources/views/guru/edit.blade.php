@extends('layouts.app')

@section('title', 'Edit Guru')

@section('content')
    <div class="container">
        <h1>Edit Data Guru</h1>

        <form action="{{ route('guru.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" name="name" id="name" class="form-control"
                       value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="form-group">
                <label for="username">Email</label>
                <input type="email" name="email" id="email" class="form-control"
                       value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Masukkan Password" class="form-control">
            </div>

            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" placeholder="Masukkan Ulang Password" class="form-control">
            </div>

            <button type="submit" class="btn btn-info">Simpan</button>
            <a href="{{ route('guru.index') }}" class="btn btn-secondary">Batal</a>
        </form>

    </div>
@endsection
