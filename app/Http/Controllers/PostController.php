<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();

        if($user->role == 'admin'){
            $data = Post::all();
        }else{
            $data = Post::where('user_id', $user->id)->get();
        }
        // dd($data->first()->image);
        return view('admin.post.index', compact('data', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.post.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request->hasFile('image')) {
            return back()->with('error', 'Gambar harus diisi');
        }

        $images = $request->file('image');
        $imagePaths = [];

        foreach ($images as $image) {
            $extension = $image->extension();
            $imageName = time() . '_' . rand(1, 9) . '.' . $extension;
            $image->move(public_path('uploads'), $imageName);
            $imagePaths[] = $imageName;
        }

        $user = auth()->user();

        $input = [
            'user_id' => $user->id,
            'title' => $request->input('title'),
            'deskripsi' => $request->input('deskripsi'),
            'image' => $imagePaths,
            'url' => $request->input('url')
        ];

        Post::create($input);
        return redirect()->route('post.index')->with('success', 'Berhasil tambah data');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = Post::findOrFail($id);
        $user = auth()->user();

        // Hapus gambar-gambar lama
        if ($request->hasFile('image')) {
            foreach ($data->image as $oldImage) {
                File::delete('uploads/' . $oldImage);
            }
            
            // Upload dan simpan gambar-gambar baru
            $images = $request->file('image');
            $imagePaths = [];

            foreach ($images as $image) {
                $extension = $image->extension();
                $imageName = time() . '_' . rand(1, 9) . '.' . $extension;
                $image->move(public_path('uploads'), $imageName);
                $imagePaths[] = $imageName;
            }

            $input = [
                // 'user_id' => $user->id,
                'title' => $request->input('title'),
                'deskripsi' => $request->input('deskripsi'),
                'image' => $imagePaths,
                'url' => $request->input('url'),
            ];
        } else {
            // Jika tidak ada gambar yang diunggah, gunakan gambar yang sudah ada
            $input = [
                // 'user_id' => $user->id,
                'title' => $request->input('title'),
                'deskripsi' => $request->input('deskripsi'),
                'url' => $request->input('url'),
            ];
        }

        $data->update($input);
        return redirect()->route('post.index')->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Post::findOrFail($id);
        foreach ($data->image as $oldImage) {
            File::delete('uploads/' . $oldImage);
        }
        $data->delete();
        return back()->with('success', 'berhasil hapus data');
    }
}
