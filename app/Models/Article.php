<?php

namespace App\Models;

use App\Models\ArticleCategory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasUuids, HasFactory;
    
    protected $guarded = [];
    
    public function category() { 
        return $this->belongsTo(ArticleCategory::class, 'article_category_id'); 
    }
}