<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    //Datos virtuales del modelo
    public function getExcerptAttribute()
    {
        return substr($this->content, 0, 120).'...';
    }

    public function getPublishedAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
