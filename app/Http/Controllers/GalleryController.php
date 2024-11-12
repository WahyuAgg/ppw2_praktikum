<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $data = [
            'id' => "posts",
            'menu' => 'Gallery',
            'galleries' => Post::where('picture', '!=', '')
                ->whereNotNull('picture')
                ->orderBy('created_at', 'desc')
                ->paginate(30)
        ];

        return view('gallery.index')->with($data);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gallery.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);

        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();

            $basename = uniqid() . '_' . time();
            $smallFilename = "small_{$basename}.{$extension}";
            $mediumFilename = "medium_{$basename}.{$extension}";
            $largeFilename = "large_{$basename}.{$extension}";
            $filenameToStore = "{$basename}.{$extension}";

            $path = $request->file('picture')->storeAs('posts_image', $filenameToStore);
        } else {
            $filenameToStore = 'noimage.png';
        }

        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->picture = $filenameToStore;
        $post->save();

        return redirect('gallery')->with('success', 'Berhasil menambahkan data baru');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the post by ID
        $post = Post::findOrFail($id);

        // Pass the post data to the edit view
        return view('gallery.edit', compact('post'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'picture' => 'image|nullable|max:1999'
        ]);
        $post = Post::findOrFail($id);
        if ($request->hasFile('picture')) {
            $filenameWithExt = $request->file('picture')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('picture')->getClientOriginalExtension();
            $basename = uniqid() . '_' . time();
            $filenameToStore = "{$basename}.{$extension}";
            $path = $request->file('picture')->storeAs('posts_image', $filenameToStore);
            if ($post->picture != 'noimage.png') {
                Storage::delete('posts_image/' . $post->picture);
            }
            $post->picture = $filenameToStore;
        }
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->save();
        return redirect('gallery')->with('success', 'Berhasil memperbarui data');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->picture != 'noimage.png') {
            Storage::delete('posts_image/' . $post->picture);
        }
        $post->delete();
        return redirect('gallery')->with('success', 'Data berhasil dihapus');
    }

}
