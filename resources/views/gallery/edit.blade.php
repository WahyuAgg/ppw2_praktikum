@extends('auth.layouts')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8 col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header bg-warning text-dark">
                <h5 class="mb-0">Edit Item Gallery</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('gallery.update', $post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- PUT method untuk update --}}

                    {{-- Title Input --}}
                    <div class="mb-3 row">
                        <label for="title" class="col-md-4 col-form-label text-md-end text-start">Title</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Enter title"
                                value="{{ old('title', $post->title) }}">
                            @error('title')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Description Input --}}
                    <div class="mb-3 row">
                        <label for="description"
                            class="col-md-4 col-form-label text-md-end text-start">Description</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="description" rows="4" name="description"
                                placeholder="Enter description">{{ old('description', $post->description) }}</textarea>
                            @error('description')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Image Input --}}
                    <div class="mb-3 row">
                        <label for="input-file" class="col-md-4 col-form-label text-md-end text-start">Image</label>
                        <div class="col-md-8">
                            <div class="input-group">
                                <input type="file" class="form-control" id="input-file" name="picture">
                                @error('picture')
                                <div class="alert alert-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                    {{-- Submit Button --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-warning w-50">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
