<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request; // Use Illuminate\Http\Request instead of GuzzleHttp\Psr7\Request

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Membatasi semua metode hanya untuk pengguna yang sudah login
    }

    public function index(){
        // Mengambil semua data buku
        $data_buku = Buku::all()->sortByDesc('id');

        // Menghitung jumlah data buku
        $jumlah_buku = $data_buku->count();

        // Menghitung total harga semua buku
        $total_harga = $data_buku->sum('harga');

        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga'));
    }

    public function create(){
        return view('buku.create');
    }

    public function store(Request $request){
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        return redirect('/buku');
    }

    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }

    public function edit($id) {
        // Mengambil buku berdasarkan ID
        $buku = Buku::findOrFail($id);

        // Mengirimkan data buku ke view
        return view('buku.edit', compact('buku'));
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::findOrFail($id);

        // Update atribut hanya jika data request ada dan tidak null
        if ($request->filled('judul')) {
            $buku->judul = $request->input('judul');
        }
        if ($request->filled('penulis')) {
            $buku->penulis = $request->input('penulis');
        }
        if ($request->filled('harga')) {
            $buku->harga = $request->input('harga');
        }
        if ($request->filled('tgl_terbit')) {
            $buku->tgl_terbit = $request->input('tgl_terbit');
        }

        // Simpan perubahan ke database
        $buku->save();

        // Redirect ke halaman buku
        return redirect('/buku');
    }



}
