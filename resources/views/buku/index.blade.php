<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <title>Data Buku</title>
</head>
<body>
    <div class="container-fluid px-7 my-4 bg-light p-5">
        <h1 class="mb-4">Data Buku</h1>
        <!-- Menampilkan semua data buku -->
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Harga</th>
                    <th>Tanggal Terbit</th>
                    <th colspan="2">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($data_buku as $buku)
                    <tr>
                        <td>{{ $buku->id }}</td>
                        <td>{{ $buku->judul }}</td>
                        <td>{{ $buku->penulis }}</td>
                        <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d/m/Y') }}</td>
                        <td>
                            <form action="{{route('buku.destroy', $buku->id)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin mau dihapus?')" type="submit" class="btn btn-danger">
                                    Hapus
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('buku.edit', $buku->id) }}" class="btn btn-warning">Edit</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <a href="{{route('buku.create')}}" class="btn btn-primary float-end">Tambah Buku</a>

        <!-- Menampilkan jumlah data buku -->
        <p class="h4 mt-4">Total Buku: {{ $jumlah_buku }}</p>

        <!-- Menampilkan total harga semua buku -->
        <p class="h4">Total Harga Semua Buku: {{ "Rp. ".number_format($total_harga, 2, ',', '.') }}</p>
    </div>
</body>
</html>
