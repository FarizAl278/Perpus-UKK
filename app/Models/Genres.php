<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
    protected $fillable = ['name', 'slug'];

    protected $table = 'genres';

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}