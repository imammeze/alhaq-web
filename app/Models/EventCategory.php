<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventCategory extends Model
{
    use HasUuids, HasFactory;

    protected $guarded = [];
    
    public function events() { 
        return $this->hasMany(Event::class); 
    }
}