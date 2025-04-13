<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'test_id',
    ];

    // Establece una relación entre Language y Test
    public function language() {
        return $this->hasMany(Test::class);
        
    }
}
