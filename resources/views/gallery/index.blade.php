@extends('auth.layouts')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Gallery</div>
            <div class="card-body">
                <div class="mb-3"></div>
                <div class="row">
                    @if(count($galleries) > 0)
                    @foreach ($galleries as $gallery)
                    <div class="col-sm-2 position-relative">
                        <div class="image-container">
                            {{-- Images --}}
                            <a class="example-image-link" href="{{ asset('storage/posts_image/'.$gallery->picture) }}"
                                data-lightbox="roadtrip" data-title="{{ $gallery->title }}">
                                <img class="example-image img-fluid mb-2"
                                    src="{{ asset('storage/posts_image/'.$gallery->picture) }}" alt="image-1" />
                            </a>
                            {{-- Edit & delete Button container --}}
                            <div class="btn-group d-flex justify-content-between w-100">
                                {{-- Edit Button --}}
                                <div class="btn btn-warning btn-sm">
                                    <a href="{{ route('gallery.edit', $gallery->id) }}"
                                        class="btn btn-warning btn-sm">Edit</a>
                                </div>
                                {{-- Delete Button --}}
                                <form action="{{ route('gallery.destroy', $gallery->id) }}" method="POST"
                                    class="btn btn-danger btn-sm">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus item ini?');">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <h3>Tidak ada data.</h3>
                    @endif
                </div>
                <div class="d-flex">
                    {{ $galleries->links() }}
                </div>
            </div>
            <a href="{{ route('gallery.create') }}" class="btn btn-outline-primary"> Tambahkan Gambar</a>
        </div>
    </div>
</div>
<style>
    .image-container {
        position: relative;
    }
</style>
@endsection
