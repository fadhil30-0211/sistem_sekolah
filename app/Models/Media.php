<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['mediable_type', 'mediable_id', 'type', 'file_path', 'embed_url', 'caption'];

    public function mediable()
    {
        return $this->morphTo();
    }
}
