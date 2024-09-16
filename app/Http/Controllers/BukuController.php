<?php

namespace App\Http\Controllers;

use App\Models\Buku;

class BukuController extends Controller
{
    public function index(){
        // Mengambil semua data buku
        $data_buku = Buku::all()->sortByDesc('id');

        // Menghitung jumlah data buku
        $jumlah_buku = $data_buku->count();

        // Menghitung total harga semua buku
        $total_harga = $data_buku->sum('harga');

        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga'));
    }
}
