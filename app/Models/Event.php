<?php

namespace App\Models;

use App\Models\EventCategory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasUuids, HasFactory;
    
    protected $guarded = [];
    
    public function category() { 
        return $this->belongsTo(EventCategory::class, 'event_category_id'); 
    }
}