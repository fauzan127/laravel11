<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Slider extends Model
{
    use HasFactory;
    protected $fillable = ['post_id', 'title', 'description', 'image'];
    

    // Relasi ke Post
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    // Akses URL gambar
    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/' . $this->image) : 'https://www.algobash.com/wp-content/uploads/2023/03/Online-Coding-Test-in-Java.jpg';
    }

    // Hapus gambar saat slider dihapus
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($slider) {
            if ($slider->image) {
                Storage::delete('public/' . $slider->image);
            }
        });
    }
}
