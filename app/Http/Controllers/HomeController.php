<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use App\Models\Post;
use App\Models\Media;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::where('is_active', true)->orderBy('urutan', 'asc')->get();
        $posts = Post::where('is_published', true)->latest()->take(4)->get();
        $recentMedia = Media::latest()->take(6)->get();

        return view('home', compact('slides', 'posts', 'recentMedia'));
    }

    public function profile()
    {
        return view('pages.profile');
    }

    public function berita()
    {
        $posts = Post::where('is_published', true)->latest()->paginate(6);
        return view('pages.berita_index', compact('posts'));
    }

    public function showBerita($slug)
    {
        $post = Post::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('pages.berita_show', compact('post'));
    }

    public function galeri()
    {
        $mediaList = Media::latest()->paginate(12);
        return view('pages.galeri', compact('mediaList'));
    }
}
