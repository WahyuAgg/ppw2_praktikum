<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    // Menentukan nama tabel yang sesuai dengan skema
    protected $table = 'books';

    // Menentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'judul',        // Kolom judul
        'penulis',      // Kolom penulis
        'harga',        // Kolom harga
        'tgl_terbit'    // Kolom tanggal terbit
    ];

    // Menentukan tipe data yang harus di-cast
    protected $casts = [
        'tgl_terbit' => 'date', // Memastikan tgl_terbit di-cast sebagai date
    ];
}
