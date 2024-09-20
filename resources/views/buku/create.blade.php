@extends('layouts.template')

@section('title', 'Tambahkan Buku')
@section('name_page','Tambah Buku')

@section('content')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <div class="container mt-4">
        <h4>Tambah Buku</h4>
        <form method="post" action="{{ route('buku.store') }}">
            @csrf
            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input class="form-control" type="text" name="judul" id="judul">
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input class="form-control" type="text" name="penulis" id="penulis">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input class="form-control" type="text" name="harga" id="harga">
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tgl. Terbit</label>
                <input class="form-control" type="date" name="tgl_terbit" id="tgl_terbit">
            </div>
            <div class="d-flex justify-content-between">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <a href="/buku" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>

@endsection



