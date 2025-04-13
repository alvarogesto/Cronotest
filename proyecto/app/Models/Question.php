<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'question',
        'image',
        'test_id',
    ];

    // Establece una relación entre Question y Test
    public function test() {
        return $this->belongsTo(Test::class);    
    }

    // Establece una relación entre Question y Answer
    public function answer() {
        return $this->hasMany(Answer::class);
    }
}
