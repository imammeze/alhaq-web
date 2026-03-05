<?php

namespace App\Models;

use App\Models\Article;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    use HasUuids, HasFactory;

    protected $guarded = [];
    
    public function articles() { 
        return $this->hasMany(Article::class); 
    }
}