<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request; // Use Illuminate\Http\Request instead of GuzzleHttp\Psr7\Request

class BukuController extends Controller
{
    // Konstruktor dengan middleware untuk membatasi semua metode hanya untuk pengguna yang sudah login
    public function __construct()
    {
        $this->middleware('auth'); // Membatasi semua metode hanya untuk pengguna yang sudah login
    }

    // fungsi untuk menampilkan halaman index uku
    public function index(){
        // Mengambil semua data buku
        $data_buku = Buku::all()->sortByDesc('id');

        // Menghitung jumlah data buku
        $jumlah_buku = $data_buku->count();

        // Menghitung total harga semua buku
        $total_harga = $data_buku->sum('harga');

        return view('buku.index', compact('data_buku', 'jumlah_buku', 'total_harga'));
    }

    // fungsi untuk menampilkan halaman tambah buku
    public function create(){
        return view('buku.create');
    }

    // fungsi untuk membuat buku baru
    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'judul' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'harga' => 'required|numeric',
            'tgl_terbit' => 'required|date',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:8192',
        ]);

        // menyimpan dan membuat url gambar
        if ($request->hasFile('cover')) {
            $filenameWithExt = $request->file('cover')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('cover')->storeAs('covers', $filenameSimpan);
        }

        // membuat buku baru dna mngisi propertinya
        $buku = new Buku();
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->cover = $path;
        $buku->save();

        // redirect
        return redirect()->route('buku.index')->with('success', 'Buku berhasil ditambahkan.');
    }

    // fungsi untuk menghapus buku
    public function destroy($id){
        $buku = Buku::find($id);
        $buku->delete();

        return redirect('/buku');
    }

    // fungsi untuk menampilkan halaman edit buku
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

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($buku->cover && Storage::exists($buku->cover)) {
                Storage::delete($buku->cover);
            }

            // Simpan cover baru
            $filenameWithExt = $request->file('cover')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('cover')->getClientOriginalExtension();
            $filenameSimpan = $filename . '_' . time() . '.' . $extension;
            $path = $request->file('cover')->storeAs('covers', $filenameSimpan);
            $buku->cover = $path;
        }

        // Simpan perubahan ke database
        $buku->save();

        // Redirect ke halaman buku
        return redirect('/buku');
    }



}
