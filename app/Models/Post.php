<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory, Sluggable;
    protected $fillable =['title', 'author_id', 'slug', 'body', 'category_id', 'image'];

    protected $with = ['author', 'category'];

    public function author():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function category():BelongsTo{
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        $query->when($filters['search'] ?? false,
            fn($query, $search) =>
            $query->where('title', 'like', '%' . $search . '%')
        );

        //filter berdasarkan category
        $query->when($filters['category'] ?? false,
            fn($query, $category) =>
            $query->whereHas('category', fn ($query) => $query->where('slug', $category))
        );

        //filter berdasarkan penulis
        $query->when($filters['author'] ?? false,
            fn($query, $author) =>
            $query->whereHas('author', fn ($query) => $query->where('username', $author))
        );

        //filter post terbaru
        $query->when($filters['recent'] ?? false, 
            fn($query) => $query->orderBy('created_at', 'desc')->take(5) // Ambil 5 post terbaru
        );
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
