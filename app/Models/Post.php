<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['judul', 'slug', 'kategori', 'konten', 'gambar_sampul', 'author_id', 'is_published'];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Relasi Polymorphic ke Media
    public function media()
    {
        return $this->morphMany(Media::class, 'mediable');
    }
}
