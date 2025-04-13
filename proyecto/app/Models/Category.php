<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'test_id',
    ];

    // Establece una relación entre Category y Test
    public function category() {
        return $this->hasMany(Test::class);
        
    }
}
