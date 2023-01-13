<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;


    /* ⚡ Add cover_image to fillable to avoid image path not saved in the db! */
    protected $fillable = ['title', 'body', 'slug', 'cover_image'];

    public static function generateSlug($title)
    {
        $post_slug = Str::slug($title);
        return $post_slug;
    }
}
