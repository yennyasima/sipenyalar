<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $news = News::when($search, function ($query, $search) {
            return $query->where(function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%')->orWhere('deskripsi', 'like', '%' . $search . '%');
            });
        })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('pages.admin.news.index', compact('news', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       
        // Handle the banner upload
        $bannerPath = null;
        if ($request->hasFile('banner')) {
            $banner = $request->file('banner');
            $banner->storeAs('public/banner_news/', $banner->hashName());
            $bannerPath = $banner->hashName();
        }

        

        News::create([
            'banner' => $bannerPath,
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('pages.admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $news = News::findOrFail($id);

        // Handle the banner upload
        if ($request->hasFile('banner')) {
            // Delete the old banner if it exists
            if ($news->banner) {
                Storage::delete('public/banner_news/' . $news->banner);
            }

            $banner = $request->file('banner');
            $banner->storeAs('public/banner_news/' . $banner->hashName());
            $news->banner = $banner->hashName();
        }

        $news->update([
            'title' => $request->input('title'),
            'category' => $request->input('category'),
            'deskripsi' => $request->input('deskripsi'),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $News = News::findOrFail($id);
        if ($News->banner) {
            Storage::delete('public/banner_news/' . $News->banner);
        }

        $News->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus.');
    }
}
