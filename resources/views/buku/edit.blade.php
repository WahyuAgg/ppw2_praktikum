@extends('layouts.template')

@section('title', 'Edit Buku')
@section('name_page','Edit Buku')
@section('content')
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <div class="container mt-5">
        <h4 class="mb-4">Edit Buku</h4>
        <form method="post" action="{{ route('buku.update', $buku->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="judul" class="form-label">Judul</label>
                <input class="form-control" type="text" name="judul" id="judul" value="{{ old('judul', $buku->judul) }}" >
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input class="form-control" type="text" name="penulis" id="penulis" value="{{ old('penulis', $buku->penulis) }}">
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input class="form-control" type="text" name="harga" id="harga" value="{{ old('harga', $buku->harga) }}">
            </div>
            <div class="mb-3">
                <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                <input class="form-control" type="date" name="tgl_terbit" id="tgl_terbit" value="{{ old('tgl_terbit', $buku->tgl_terbit->format('Y-m-d')) }}">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Simpan</button>
                <a href="/buku" class="btn btn-secondary">Batal</a>
            </div>
        </form>
    </div>
@endsection



