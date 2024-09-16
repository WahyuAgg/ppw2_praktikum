@extends('layouts.template')

@section('title', 'Home') <!-- Menetapkan judul untuk halaman ini menjadi 'Home' -->

@section('content')
    <!-- Menetapkan isi konten untuk bagian @yield('content') di file template  -->
    <h2>Selamat datang di Halaman Utama</h2>
    <!-- Tabel menampilkan data pengguna -->
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Nama</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Wahyu</td>
                <td>wahyu@example.com</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Agung</td>
                <td>agung@example.com</td>
            </tr>
        </tbody>
    </table>
@endsection
