@extends('auth.layouts')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Gallery</div>
            <div class="card-body">
                <div class="mb-3"></div>
                <div class="row" id="gallery-container">
                    <!-- "gallery-container" akan diisi dengan gambar oleh kode JavaScript dibawah -->
                </div>
            </div>
            <a href="{{ route('gallery.create') }}" class="btn btn-outline-primary"> Tambahkan Gambar</a>
        </div>
    </div>
</div>
<script>
    // Fungsi untuk mengambil data dari API
    function fetchGalleryData() {
        fetch('/api/galleries')
            .then(response => response.json())
            .then(data => {
                // Menampilkan gambar-gambar
                const galleryContainer = document.getElementById('gallery-container');
                // Mengisi gallery-container dengan item

                galleryContainer.innerHTML = '';  // Kosongkan dulu gallery container
                data.galleries.forEach(gallery => { // Iterasi data gallery
                    const galleryItem = document.createElement('div');
                    galleryItem.classList.add('col-sm-2', 'position-relative');
                    galleryItem.innerHTML = `
                        <div class="image-container">
                            <a class="example-image-link" href="{{ asset('storage/posts_image/') }}/${gallery.picture}"
                               data-lightbox="roadtrip" data-title="${gallery.title}">
                                <img class="example-image img-fluid mb-2"
                                     src="{{ asset('storage/posts_image/') }}/${gallery.picture}" alt="image-1" />
                            </a>
                            <div class="btn-group d-flex justify-content-between w-100">


                                <div class="btn btn-warning btn-sm">
                                    <a href="/gallery/${gallery.id}/edit" class="btn btn-warning btn-sm">Edit</a>
                                </div>

                                <form action="/gallery/${gallery.id}" method="POST" class="btn btn-danger btn-sm">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus item ini?');">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    `;
                    galleryContainer.appendChild(galleryItem);
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    // Memanggil fungsi fetchGalleryData saat halaman dimuat
    document.addEventListener('DOMContentLoaded', fetchGalleryData);
</script>

<style>
    .image-container {
        position: relative;
    }
</style>
@endsection
